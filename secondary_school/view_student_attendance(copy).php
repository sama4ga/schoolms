<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "class_teacher" && $priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

$atd_id = $_REQUEST['atd_id'];

// get other data from atd_id
$data  = explode("_",$atd_id);
$session_formatted = $data[2]."_".$data[3];
$session = str_replace("_","/",$session_formatted);
$term = $data[4];
$class = $data[5];
$arm = $data[6];


// check if attendance has been created
if (!$con->query("DESCRIBE `$atd_id`")) {
  echo "<div style='color:red;'>
          Attendance sheet not yet created.<br/>
          Create attendance sheet and try again.<br/>
          <a href='javascript:history.back()' class='btn btn-warning btn-lg'>Click here to go back</a>
        </div>";
      exit();

}


//import all class members
$result = $con->query("SELECT * FROM `student` s LEFT JOIN `student_class` sc 
                            ON sc.`std_id`=s.`std_id` 
                            WHERE sc.`class`='$class' AND sc.`arm`='$arm'");


if($result){
  $no_of_std = $result->num_rows;
  //echo $no_of_std;
  if ($no_of_std > 0) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      $std_id[$x] = $row['std_id']; 
      $surname[$x] = $row['surname']; 
      $othernames[$x] = $row['othernames']; 
      $gender[$x] = $row['gender']; 
      $full_name[$x] = $surname[$x].", ".$othernames[$x]; 

      $x++;
    }
  }else{
    echo "<div>No student found in the specified class (".strtoupper($class).strtoupper($arm).")</div>";
    echo "<div><a href='javascript:history.back();' class='btn-warning btn-lg'>Back</a></div>";
    exit();
  }
}else {
  echo "Error fetching student data ".$con->error;
}


// get attendance details
$result = $con->query("SELECT * FROM `$atd_id` order by `dd`");


if($result){
  if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_array()) {
      $date[$i] = $row['dd']; 
      for ($x=0; $x < count($std_id); $x++) {

        // check if the student is in the attendance sheet
        if (!array_key_exists($std_id[$x],$row)) {

          // not found, add student          
          $_result=$con->query("ALTER TABLE `$atd_id` ADD `$std_id[$x]` VARCHAR(2) NOT NULL DEFAULT '0'");
          
          if (!$_result) {
            $msg[]="could not add record of $surname[$x], $othernames[$x] to the attendance sheet ".$con->error;
          }else {
            $present[$std_id[$x]][$i] = "0";
          }


        }else { 
          // found, continue         
          $present[$std_id[$x]][$i] = $row[$std_id[$x]]; 
        }        
      }
      $i++;
    }
  }else{
    //throw new Exception("Error Processing Request");
    
    echo "<div>Attendance not yet marked for the specified class (".strtoupper($class).strtoupper($arm).")</div>";
    echo "<div><a href='javascript:history.back();' class='btn-warning btn-lg'>Back</a></div>";
    exit();
  }
}else {
  echo "<div>Error getting attendance record ".$con->error."</div>";
}


// get school resumption date
$result = $con->query("SELECT * FROM `session_info`");


if($result){
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $term_began = $row['term_began']; 
     $term_ends = $row['term_ends'];
    }
  }else{
    echo "No record found";
  }
}else{
  echo "Error ".$con->error;
}



// calculate no. of weeks and range
$no_of_weeks = NumberOfWeeksCalculator($date,$term_began);
$week_range = GetWeekRange($date,$term_began);
$day_of_week = DayOfWeek($date);


//var_dump($present);exit(); 


// get day of the week and attendance status
for ($i=0; $i < count($std_id); $i++) {  // students id

  $start_date = strtotime($term_began);
  $atd_date[$std_id[$i]] = $date;

  for ($j=0; $j < $no_of_weeks; $j++) {  // weeks
    for ($k=0; $k < 5; $k++) {           // days of the week
      $day = date("D",$start_date); 

      if (!in_array(date("Y-m-d",$start_date),$date)) {
        array_push($atd_date[$std_id[$i]],date("Y-m-d",$start_date));
        array_push($present[$std_id[$i]],"");
      }
     
      $start_date = strtotime("+1 day",$start_date);
    }


    $start_date = strtotime("+2 day",$start_date); 
  }
  
}


// sort attendance value based on the sorted date
for ($x=0; $x < count($std_id); $x++) {
  asort($atd_date[$std_id[$x]]);
  $present[$std_id[$x]] = array_replace(array_flip(array_keys($atd_date[$std_id[$x]])),$present[$std_id[$x]]);
  $present[$std_id[$x]] = array_values($present[$std_id[$x]]);
}


// MTB = Mid-Term Break
// PHD = Public HoliDay
$no_of_times_present = array(); 
$no_of_times_absent = array(); 
$no_of_breaks = array();
$no_of_times_not_marked = array();

for ($x=0; $x < count($std_id); $x++) {  
  for ($j=0; $j < count($present[$std_id[$x]]); $j++) {


    // calculate number of times student is present
    if ($present[$std_id[$x]][$j] == "1") {
      if (isset($no_of_times_present) & array_key_exists($x,$no_of_times_present)) {
        $no_of_times_present[$x]++;
      }else {
        $no_of_times_present[$x] = 1;
        
      }
      


    // calculate number of days school is on break
    }elseif ($present[$std_id[$x]][$j] == "MTB" || $present[$std_id[$x]][$j] == "PHD") {
      if (isset($no_of_breaks) & array_key_exists($x,$no_of_breaks)) {
        $no_of_breaks[$x]++;        
      }else {        
        $no_of_breaks[$x] = 1;
      }


    // calculate number of time attendance is not marked
    }elseif ($present[$std_id[$x]][$j] == "") {
      if (isset($no_of_times_not_marked) & array_key_exists($x,$no_of_times_not_marked)) {
        $no_of_times_not_marked[$x]++;        
      }else {
        $no_of_times_not_marked[$x] = 1;        
      }

    
    // calculate number of time student is absent
    }else {
      if (isset($no_of_times_absent) & array_key_exists($x,$no_of_times_absent)) {        
        $no_of_times_absent[$x]++;
      }else {        
        $no_of_times_absent[$x] = 1;
      }

    }


  }

  $percent_present[$x] = ($no_of_times_present[$x]/count($present[$std_id[$x]]))*100;
  $percent_absent[$x] = 100 - $percent_present[$x];
}



function NumberOfWeeksCalculator($date,$term_began){
  $interval = strtotime(end($date)) - strtotime($term_began);
  $week = floor($interval/(60*60*24*7))+1;
  return $week;
}


function DayOfWeek($date){
  for ($i=0; $i < count($date); $i++) { 
    $day_of_week[$i] = cal_day_of_week($date[$i]);
  }
  return $day_of_week;
}


function GetWeekRange($date,$term_began){
  $start_date = strtotime($term_began);
  $end_date = strtotime(end($date));

  $x=0;
  for ($i=$start_date; $i < $end_date; $i+=(60*60*24*7)) { 
     
    $week_start = date("Y-m-d",$i);
    $week_end = date("Y-m-d",$i+(60*60*24*4));
//echo $week_start;
    $range[$x] = $week_start." - ".$week_end;
    $x++;
  }


  return $range;

}




function cal_day_of_week($day_of_week){
  $week_day = "";
  switch ($day_of_week) {
    case 'Mon':
      $week_day = "M";
      break;
    case 'Tue':
      $week_day= "T";
      break;
    case 'Wed':
      $week_day = "W";
      break;
    case 'Thu':
      $week_day = "T";
      break;
    case 'Fri':
      $week_day = "F";
      break;
    
    default:
      
      break;
  }
  return $week_day;
} 





// display the record for the class concerned
?>


<!--div class="container" -->
<h2 style="text-align:center;">Displaying  Student Attendance Record for <?php echo strtoupper($class).strtoupper($arm)." for ".ucwords($term)." term ".$session." academic session."; ?></h2>
<div style="margin-top:50px;">
  <table class="data" border="1">
    <tr>
      <th rowspan="3">S/N</th>
      <th rowspan="3" style="min-width:200px;">Student Name</th>
      <th rowspan="3">Gender</th>
      <?php
        for ($i=0; $i < $no_of_weeks; $i++) { 
          $count = $i+1;
          echo "<th style='border-right:2px solid black' colspan='5'>Week ".$count."</th>";
        }

      ?>
    <th rowspan="3">No. of Times Present</th>
    <th rowspan="3">No. of Times Absent</th>
    <th rowspan="3">Percentage Present</th>
    </tr>

    <tr>
      <?php
      if (isset($week_range)) {        
        for ($i=0; $i < count($week_range); $i++) { 
          echo "<th colspan='5' style='border-right:2px solid black'>".$week_range[$i]."</th>";
        }
      }
      ?>
    </tr>

    <tr>
      <?php
        for ($i=0; $i < count($week_range); $i++) { 
          echo "<th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th style='border-right:2px solid black'>F</th>";
        }
        
      ?>
    </tr>

    


    <?php     
    
      $sn = 0;
      for ($x=0; $x < count($std_id); $x++) {

        $count = 0;
        $sn++;

        echo "<tr>
                <td>".$sn."</td>
                <td>".$full_name[$x]."</td>
                <td>".$gender[$x]."</td>";

        for ($y=0; $y < $no_of_weeks; $y++) { 
          for ($z=0; $z < 5; $z++) { 
            if ($z == 4) {
              if ($present[$std_id[$x]][$count] == "1") {
                echo "<td style='border-right:2px solid black;'><img src='../images/atd_present.png' width='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "0") {
                echo "<td style='border-right:2px solid black;'><img src='../images/atd_absent.png' width='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "") {
                echo "<td style='border-right:2px solid black;'></td>";
              }elseif ($present[$std_id[$x]][$count] == "MTB") {
                echo "<td style='border-right:2px solid black;'><img src='../images/atd_mtb.png' width='20px' height='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "PHD") {
                echo "<td style='border-right:2px solid black;'><img src='../images/atd_phd.png' width='20px' height='20px'/></td>";
              }
            }else {
              if ($present[$std_id[$x]][$count] == "1") {
                echo "<td ><img src='../images/atd_present.png' width='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "0") {
                echo "<td><img src='../images/atd_absent.png' width='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "") {
                echo "<td></td>";
              }elseif ($present[$std_id[$x]][$count] == "MTB") {
                echo "<td><img src='../images/atd_mtb.png' width='20px' height='20px'/></td>";
              }elseif ($present[$std_id[$x]][$count] == "PHD") {
                echo "<td><img src='../images/atd_phd.png' width='20px' height='20px'/></td>";
              }
            }
            $count++;
          }
        }


        // correction for no of times absent if student has never been absent
        if (!isset($no_of_times_absent[$x])) {
          $no_of_times_absent[$x] = 0;
        }


        echo "  <td style='font-weight:bold;'>".$no_of_times_present[$x]."</td>
                <td style='font-weight:bold;'>".$no_of_times_absent[$x]."</td>
                <td style='font-weight:bold;'>".number_format($percent_present[$x],1)."%</td>        
              </tr>";
      } 

        
      // calculate daily attendance for class
      $daily_present = array();
      for ($x=0; $x < count($std_id); $x++) {  
        for ($i=0; $i < count($atd_date[$std_id[$x]]); $i++) { 

          if ($present[$std_id[$x]][$i] == "1"){
            if (isset($daily_present) & array_key_exists($i,$daily_present)) {        
              $daily_present[$i]++;
            }else {        
              $daily_present[$i] = 1;
            }
          }else {
            if (isset($daily_present) & array_key_exists($i,$daily_present)) {        
              $daily_present[$i] += 0;
            }else {        
              $daily_present[$i] = 0;
            }
          }

        }
      }


      // calculate weekly attendance
      $weekly_present = array();
      $count = 0;
      for ($i=0; $i < count($daily_present); $i+=5) {
        for ($j=0; $j < 5; $j++) {
          if(isset($weekly_present) & array_key_exists($count,$weekly_present)){
            $weekly_present[$count] += $daily_present[$i+$j];
          } else {      
            $weekly_present[$count] = $daily_present[$i+$j];
          }    
        } 


        // calculate weekly percentage
        $weekly_percent[$count] = number_format($weekly_present[$count]/(count($std_id)*5)*100,1);
        
        
        $count++;

      }

     // var_dump($daily_present);

     
        // daily total row
        echo "<tr>
                <td></td>
                <td></td>
                <td style='font-weight:bold;'>Daily Total</td>";
                for ($i=0; $i < $no_of_weeks*5; $i++) { 
                  echo "<td style='font-weight:bold;'>".$daily_present[$i]."</td>";
                }
        echo  " <td></td>
                <td></td>
                <td></td>
              </tr>";


        // weekly total row
        echo "<tr>
                <td></td>
                <td></td>
                <td style='font-weight:bold;'>Weekly Total</td>";
                for ($i=0; $i < $no_of_weeks; $i++) { 
                  echo "<td colspan='5' style='border-right:2px solid black;font-weight:bold;'>".$weekly_present[$i]."&nbsp&nbsp&nbsp - &nbsp&nbsp&nbsp ".$weekly_percent[$i]."%</td>";
                }
        echo  " <td></td>
                <td></td>
                <td></td>
              </tr>";

              
    ?>
    
    
  </table>
</div>
<!-- /div -->


<div style="margin:50px 0 30px 100px;width:200px">
  <table class="table table-bordered">
    <tr>
      <th>Key</th>
      <th>Value</th>
    </tr>

    <tr>
      <td>MTB</td>
      <td>Mid-Term Break</td>
    </tr>

    <tr>
      <td>PHD</td>
      <td>Public Holiday</td>
    </tr>

  </table>

  
  <a href="javascript:history.back();" class="btn-warning">Back</a>
  
</div>
<marquee behavior='scroll' direction='right'>Designed by Sama4ga</marquee>
 
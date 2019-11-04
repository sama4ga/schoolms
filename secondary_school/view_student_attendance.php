<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "admin") {
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
          <a href='javascript:history.back()' class='btn btn-warning'>Click here to go back</a>
        </div>";
      exit();

}


//import all class members
$result = $con->query("SELECT * FROM `student` s LEFT JOIN `student_class` sc 
                            ON sc.`std_id`=s.`std_id` 
                            WHERE sc.`class`='$class' AND sc.`arm`='$arm'");


if($result){
  if ($result->num_rows > 0) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      $std_id[$x] = $row['std_id']; 
      $surname[$x] = $row['surname']; 
      $othernames[$x] = $row['othernames']; 
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
  exit();
}


// get attendance details
$result = $con->query("SELECT * FROM `$atd_id`");


if($result){
  if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
      $date[$i] = $row['dd']; 
      for ($x=0; $x < count($std_id); $x++) {        
        $present[$std_id[$x]][$i] = $row[$std_id[$x]]; 
      }
      $i++;
    }
  }else{
    echo "<div>Attendance not yet marked for the specified class (".strtoupper($class).strtoupper($arm).")</div>";
    echo "<div><a href='javascript:history.back();' class='btn-warning'>Back</a></div>";
    exit();
  }
}



// display the record for the class concerned
?>


<div class="container">
<h2>Displaying  Student Attendance Record for <?php echo strtoupper($class).strtoupper($arm)." for ".$session." academic session."; ?></h2>
<div style="margin-top:50px;">
  <table class="data" border="1">
    <tr>
      <th rowspan="2">S/N</th>
      <th rowspan="2" style='min-width:200px;'>Student Name</th>
      <th colspan="<?php echo count($date); ?>">Date</th>
    </tr>

    <tr>
      <?php
      if (isset($date)) {        
        for ($i=0; $i < count($date); $i++) { 
          echo "<th>".$date[$i]."</th>";
        }
      }
      ?>
    </tr>

    
    <?php
    $count = 0;
      for ($x=0; $x < count($std_id); $x++) { 
        $count = $x + 1;
        echo "<tr>
                <td>".$count."</td>
                <td>".$full_name[$x]."</td>";
                if (isset($date)) {
                  for ($i=0; $i < count($date); $i++) { 
                    if ($present[$std_id[$x]][$i] == "1") {
                      echo "<td>present</td>";
                    }else {
                      echo "<td>absent</td>";
                    }
                  }
                }
                
          echo "</tr>";
      }


    ?>
    
  </table>
</div>
</div>

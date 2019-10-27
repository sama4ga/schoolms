<?php
include_once("auth.php");

// attendance by marking
if ($priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
ini_set("TIME_ZONE","AFRICA/LAGOS");
include_once("connect.php");
include_once("head.php");
include_once("sanitize.php");

$msg=array();

$session=strtolower($_SESSION['session']);
$term=strtolower($_SESSION['term']);

$atd_id=$_GET['atd_id'];

if (isset($_POST['submit'])) {
  
  $present=$_POST['present'];
  $time=$_POST['time']; 
  
  if (isset($_POST['atd_date']) && $_POST['atd_date'] != "") {
    $today_raw = date('Y-m-d',strtotime($_POST['atd_date']));
  }else {    
    $today_raw = date('Y-m-d');
  }

  $result=$con->query("SELECT * FROM `$atd_id` WHERE `date`='$today_raw'");
  if ($result) {
    if ($result->num_rows == 0) {
    
      if(!$con->query("INSERT INTO `$atd_id`(`date`) VALUES('$today_raw')")){
        $msg[]="Could not insert new date ".$con->error;
      };
    
    }
  }else {
    $msg[]="Error with new date ".$con->error;
  }
  
  //var_dump($present);echo $atd_id;
  //var_dump($time);exit();

 /*  
 DELETE FROM `atd_staff_2018_2019_first` WHERE `atd_staff_2018_2019_first`.`date` = \'2018-11-26\'"
 */

  for ($i=0; $i < count($present); $i++) { 
    $time_formatted = $today_raw." ".$time[$present[$i]];
    if(!$con->query("UPDATE `$atd_id` SET `$present[$i]`='".$time_formatted."' WHERE `date`='$today_raw'")){
      $msg[]="Could not mark attendance for staff".$present[$i]." because ".$con->error;
    }
    
  }

  if(empty($msg)){
    $msg[]="Attendance successfully marked";
            //<br/><a href='javascript:history.back()'>Click here to go back</a>";

    //exit();
  }
  
}


$get_results = $con->query("SELECT * FROM `staff` where `staff_id` <> '1'");

$z=0;
$today = date('D, M d, Y');

$no_of_results=0; 

if($get_results){

  $no_of_results = $get_results->num_rows;
  while($row = $get_results->fetch_assoc()){
    
    $surname_this[$z] = strtoupper($row['surname']);
    $other_names_this[$z] = strtoupper($row['othernames']);		
    $staff_id[$z] = $row['staff_id'];

    $z++;

  }


}else {
  echo "An error occured ".$con->error;
}


  $today = date('D, M d, Y');

  



  echo "<div class='container'><form method='POST' action='staff_attendance(copy).php?atd_id=$atd_id' class='form-control'>
          <ul style='color:red;'>";
            for ($i=0; $i < count($msg); $i++) { 
            echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }
  echo   "</ul>
        
          <h2> Staff Attendance for ".strtoupper($term)." term ".$session." academic session</h2>
          <div>Date: <b>".$today."</b>

          <div class='form-control'>Or choose date
          <div>Date: <input type='date' name='atd_date' class='form-control' style='width:200px;'></div>
          </div>

          <p></p>
          <div style='color:red'>Tick the box beside if the Staff is present. <br/>
            <b>Note: Not ticking the box means the staff is absent.</b>
          </div>
          <table cellpadding='15' cellspacing='60'>
            <tr>
              <th>Staff's Name</th>
              <th>Present <input type='checkbox' onchange=\"mark_all('present[]')\" title='mark all' class='checkbox'></th>
              <th>Time In</th>
            </tr>";


          for ($z=0; $z < count($staff_id); $z++) {
      echo "<tr>
              <td>".$surname_this[$z].", ".$other_names_this[$z]."</td>
              <td><input type='checkbox' name='present[]' value='".$staff_id[$z]."' class='form-control'></td>
              <td><input type='time' name='time[$staff_id[$z]]' class='form-control'></td>
            </tr>";
          }
    echo "  <tr>
              <td></td>
              <td><input type='submit' name='submit' class='btn btn-success form-control' value='Submit'></td>
              <td><input type='submit' name='submit' class='btn btn-warning form-control' value='Back' formaction='admin_portal.php'></td>
            </tr>
          </table>
        </form></div>";

?>

<script>

count = 0;
function mark_all(div){
  count++;
  var box = document.getElementsByName(div);
  if (count%2 == 1) {
    box.forEach(val => {
      val.checked = true;
    });
  }else{
    box.forEach(val => {
      val.checked = false;
    });
  }
  
}

</script>
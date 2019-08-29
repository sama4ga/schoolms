<?php
session_start();
include_once("connect.php");
include_once("head.php");
include_once("sanitize.php");

$msg=array();

$session=strtolower($_SESSION['session']);
$term=strtolower($_SESSION['term']);

$atd_id=$_GET['atd_id'];
$today_raw = date('Y-m-d');




// check if attendance sheet has been created
if (!$con->query("DESCRIBE `$atd_id`")) {
  echo "<div style='color:red;'>
          Staff attendance sheet not created.<br/>
          Create the attendance sheet to continue.
        </div>";
  echo "<a href='manage_staff.php'>Back</a>";
  exit();
}





if (isset($_POST['btn_atd'])) { 


  $username=sanitize($_POST['username']);
  $passcode=sanitize($_POST['password']);

  // get details of logged-in staff
  $result=$con->query("SELECT * FROM `staff` WHERE `staff_reg_no`='$username'");
  if ($result->num_rows > 0) {
    while ($row=$result->fetch_assoc()) {
      $password=$row['staff_password'];
      $id=$row['staff_id'];
    }
    
    if (password_verify($passcode,$password)) {

      
//check if date has been inserted
      $result=$con->query("SELECT * FROM `$atd_id` WHERE `date`='$today_raw'");
      if ($result->num_rows == 0) {
      $con->query("INSERT INTO `$atd_id`(`date`) VALUES('$today_raw')");
      }

      // mark attendance for logged-in staff
        $con->query("UPDATE `$atd_id` SET `$id`=CURRENT_TIMESTAMP WHERE `date`='$today_raw'");
      
/* 
      echo "Attendance successfully marked.
            <a href='javascript:history.back()'>Click here to go back</a>";

      //var_dump($present); */
      
    
    }else{
      //password mismatch
      $msg[]="Invalid username and/or passcode ".$con->error;;
    }
  }else{
    // no record returned
    $msg[]="Invalid username and/or passcode ".$con->error;
  }







  $result=$con->query("SELECT * FROM `staff` WHERE `staff_id` <> '1'");
  if ($result->num_rows > 0) {

    $x=0;
    while ($row=$result->fetch_assoc()) {

      $staff_id[$x]=$row['staff_id'];
      $staff_name[$x]=ucwords($row['surname']).", ".ucwords($row['othernames']);

      $x++;
    }
  }else{echo "error ".$con->error;}

    
    $result=$con->query("SELECT * FROM `$atd_id` WHERE `date`='$today_raw'");
    if ($result->num_rows > 0) {

      //$x=0;
      while ($row=$result->fetch_assoc()) {

        for ($i=0; $i < count($staff_id); $i++) { 

          $time_in[$i]=$row[$staff_id[$i]];

        }
        

        //$x++;
      }
    }else{echo "error time in ".$con->error;}
   

  
}
  $today = date('D, M d, Y');

    // echo "<div class='container'>";
    echo "<h2 align='center'> Staff Attendance for ".strtoupper($term)." term ".$session." academic session</h2>
          <div>Date: <b>".$today."</b>";



    echo "<ul style='color:red;'>";
            for ($i=0; $i < count($msg); $i++) { 
            echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }
    echo "</ul>

          <div style='display:flex;'>
            <div style='width:30%;'>
              <form method='POST' action='staff_attendance.php?atd_id=$atd_id' class='form-control'>
                <div class='form-group'>
                  <label>Username</label>
                  <input type='text' name='username' class='form-control' autocomplete='false'>
                </div>

                <div class='form-group'>
                  <label>Passcode</label>
                  <input type='password' name='password' class='form-control' autocomplete='false'>
                </div>

                <div class='btn-group'>
                  <input type='submit' name='btn_atd' value='Sign In' class='btn btn-success form-control'>
                  <a class='btn btn-warning form-control' href='manage_staff.php' target='_parent'>Exit Attendance</a>
                </div>

              </form>             

            </div>


            <div style='padding:0 50px 0 10px; width:70%;' align='right'>
              <table cellpadding='15' cellspacing='60' border='1' width='100%'>
                <th width='70%'>Staff Name</th>
                <th width='30%'>Time in</th>";
      if (isset($staff_id)) {
        for ($i=0; $i < count($staff_id); $i++) { 

          echo "  <tr>
                    <td>".$staff_name[$i]."</td>
                    <td>".$time_in[$i]."</td>";

        }
      }
      

      echo "  </table>
            </div>
          </div>";

?>
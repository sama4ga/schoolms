<?php
require_once("connect.php");
include_once("head.php");
include_once("sanitize.php");


if (isset($_POST['submit'])) {
  $username = sanitize($_POST['username']);
  $email = sanitize($_POST['email']);
  $phoneNo = sanitize($_POST['phoneNo']);

  $result = $con->query("SELECT * FROM `staff` WHERE 
                        `staff_reg_no`='$username'
                        and `phone 1` = '$phoneNo'
                        and `email`='$email'");

  if ($result) {
    if ($result->num_rows == 1) {
      while ($row = $result->fetch_assoc()) {
        $staff_id = $row['staff_id'];
        $password = $row['staff_password'];
      }

      $user_password = password_get_info($password);
//passthru("matlab.exe",$res);
//exec();
//system();

      //echo $staff_id;
      //var_dump($user_password);

      echo "<a href='login.php' class='btn-warning btn-lg'>Back</a>";
      
      exit();

    }else {
      echo "Invalid detail supplied ".$con->error;
    }
  }else {
    echo "An error was encountered while executing query ".$con->error;
  }
}




?>

<div class="container">
  <div style="margin-bottom:30px;">
    <h1 style="text-align:center;">Password Recover Portal</h1>
  </div>

  <form action="recover_passcode.php" method="POST">
    
    <div class="form-group">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required />
    </div>
    
    <div class="form-group">
      <label class="form-label">Phone No.</label>
      <input type="tel" name="phoneNo" class="form-control" required />
    </div>

    <div class="form-group">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required />
    </div>

    <div class="input-group">
      <input type="submit" name="submit" class="btn-success form-control" value="Submit"/>
      <a href="login.php" class="btn-warning form-control">Back</a>
    </div>

  </form>
</div>
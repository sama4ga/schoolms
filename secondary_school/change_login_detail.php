<?php
require_once("connect.php");
include_once("head.php");
include_once("sanitize.php");

$msg = array();

if (isset($_POST['change'])) {

  $passcode = sanitize($_POST['passcode']);
  $staff_id = intval(sanitize($_GET['id']));
  
  $result = $con->query("UPDATE `staff` SET `staff_password`='$passcode' WHERE `staff_id`='$staff_id'");
  if ($result) {
    echo "<div style='color:red;'>Passcode successfully updated</div>
          <a href='javascript:history.back(2);'>Back</a>";
    exit();

  }else {
    echo "A technical error occured and record could not be successfully updated. ".$con->error;
  }


}elseif (isset($_POST['submit'])) {

  $username = sanitize($_POST['username']);
  $passcode = sanitize($_POST['passcode']);

  $result = $con->query("SELECT * FROM `staff` WHERE `staff_reg_no`='$username'");
  if ($result) {
    if ($result->num_rows == 1) {
      while ($row = $result->fetch_assoc()) {
        $password = $row['staff_password'];
        $staff_id = $row['staff_id'];
      }

      
      if (password_verify($passcode,$password)) {
        
?>
        <div class="container">
          <div>
            <h1>Change Login Details Page</h1>
          </div>

          <div style="color:red;margin:40px 0;text-align:center;">
            Enter New Login Details.
          </div>

          <div align='center' class="form-control" style="width:500px;">
            <form action="change_login_detail.php?id=$staff_id" method="POST">
              
              <div class="form-group">
                <label class="form-label">New Passcode</label>
                <input type="password" name="passcode" id="passcode" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label class="form-label">Confirm New Passcode</label>
                <input type="password" name="cpasscode" id="cpasscode" class="form-control" required>
              </div>
              
              <div class="input-group" style="">
                <input type="submit" name="change" class="btn-success form-control" value='Submit' onsubmit="return confirm_passcode();">
                <a class="btn-warning form-control" href="javascript:history.back(2);">Back</a>
              </div>
            </form>
          </div>

        </div>
      

        <script>
          function confirm_passcode() {
            passcode = document.getElementById("passcode");
            cpasscode = document.getElementById("cpasscode");
          
            if (passcode != cpasscode) {
              alert("Passcode mismatch");
              return false;
            }else{
              return true;
            }

          }
        </script>

<?php
        exit();

      }else {
        $msg[] = "Invalid username and/or passcode";
      }


    }else {
      $msg[] = "Invalid username and/or passcode";
    }
  }else {
    $msg[] = "There was a technical error. Please try again.".$con->error;
  }

}




?>

<div class="container">
  <div>
    <h1>Change Login Details Page</h1>
  </div>

  <div style="color:red;text-align:center;">
    You must login with your current details to proceed.<br/>
    Use the form below to login.
    <?php
      echo "<ul>";
      for ($i=0; $i < count($msg); $i++) { 
        echo "<li>".$msg[$i]."</li>";
      }
      
    ?>
  </div>

  <div align='center' class="form-control" style="width:500px;">
    <form action="change_login_detail.php" method="POST">
      
      <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      
      <div class="form-group">
        <label class="form-label">Passcode</label>
        <input type="password" name="passcode" class="form-control" required>
      </div>
      
      <div class="input-group">
        <input type="submit" name="submit" class="btn-success form-control" value="Submit">
        <a class="btn-warning form-control" href="javascript:history.back();">Back</a>
      </div>
    </form>
  </div>

</div>  
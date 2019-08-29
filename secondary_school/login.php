<?php
ob_start();
session_start();
require_once("connect.php");
include_once("head.php");
include("sanitize.php");
include("config.php");

$msg=array();

if (isset($_POST['submit'])) {
  $username=sanitize($_POST['username']);
  $passcode=sanitize($_POST['passcode']);

/*   $result=$con->query("SELECT concat('s.`surname`',', ','s.`othernames`') AS 'name',s.`staff_id`,
                        s.`staff_status`,c.`class`,c.`subject` FROM `staff` s LEFT JOIN 
                        `staff_class` c ON s.`staff_id`=c.`staff_id` WHERE 
                        s.`staff_reg_no`='$username' ORDER BY `class` 
                        GROUP BY `class`"); */

  $result=$con->query("SELECT * FROM `staff` WHERE `staff_reg_no`='$username'");
  if ($result->num_rows > 0) {
    while ($row=$result->fetch_assoc()) {
      $password=$row['staff_password'];
      $staff_id=$row['staff_id'];
      $priviledge=$row['priviledge'];
      $class=$row['class'];
      $full_name=$row['surname'].", ".$row['othernames'];
    }
    
    if (password_verify($passcode,$password)) {
     
     /*  //if the cookie is set, we need to delete it first
      if (isset($_COOKIE["user"]))
      {
        
        setcookie("user", " ", time()-3600, "/");
      
      }

      //create cookie												      
      $expire = time()+3600;
      setcookie("user", $staff_id, $expire, "/");
 */

      $result=$con->query("SELECT * FROM `session_info`");
      if (!$result->errorno && $result->num_rows > 0) {
        $row=$result->fetch_assoc();
        $session=$row['session'];
        $term=$row['term'];

        $_SESSION['user_id']=$staff_id;
        $_SESSION['session']=$session;
        $_SESSION['term']=$term;
        $_SESSION['staff_id']=$staff_id;
        $_SESSION['priviledge']=$priviledge;
        $_SESSION['name']=$full_name;

        if ($class !="") {
          $_SESSION['class_handled']=$class;
        }
        

                
        $result = $con->query("SELECT * FROM `school_info`");
        if ($result) {
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $school_name = $row['school_name'];
              $code_name = $row['code_name'];
              $motto = $row['motto'];
              $password = $row['password'];
              $school_address = $row['school_address'];
              $no_of_std_per_class = $row['no_of_std_per_class'];
              $no_of_ca = $row['no_of_ca'];
              $ca_score = $row['ca_score'];
              $exam_score = $row['exam_score'];

            }

            $_SESSION['school_name'] = $school_name;
            $_SESSION['school_address'] = $school_address;
            $_SESSION['motto'] = $motto;

          }else{
            $msg[]="No data found in school info ".$con->error;;
          }
        }else{
          $msg[]="Error could not get school_info ".$con->error;;
        }

        

        session_commit();
      }
      
      header("Location:".$URL_ROOT."/index.php");
      ob_end_flush();
    }else{
      $msg[]="Invalid username and/or passcode ".$con->error;;
    }
  }else{
    $msg[]="Invalid username and/or passcode".$con->error;
  }
}




?>

<div class="container" style="text-align:center; width:500px;margin-top:50px;" align='center'>
  <h1 style='font-weight:bold;'>Login Page</h1>
  <div>
    <img src="../images/logo.png">
  </div>
  <div>
    <form action="login.php" method="POST">
    <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="passcode">Pass Code</label>
        <input type="password" name="passcode" class="form-control" required>
      </div>

      <div  class="form-group">
        <input type="submit" name="submit" class="btn-success form-control" value="Login">
      </div>
    </form>
    <!-- <div style="margin-top:20px;">Forgot passcode? <a href="recover_passcode.php">Click here</a></div> -->
  </div>
</div>
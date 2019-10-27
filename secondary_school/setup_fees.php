<?php
include_once("auth.php");
if ($priviledge !== "bursar" || $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
include_once("head.php");
require_once("connect.php");


if (!$con->query("DESCRIBE `fees`")) {
    $result=$con->query("CREATE TABLE IF NOT EXISTS `fees`(
                        `fees_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `ss 1` INT(7) NOT NULL,
                        `ss 2` INT(7) NOT NULL,
                        `ss 3` INT(7) NOT NULL,
                        `jss 1` INT(7) NOT NULL,
                        `jss 2` INT(7) NOT NULL,
                        `jss 3` INT(7) NOT NULL,
                        `term` VARCHAR(10) NOT NULL,
                        `session` VARCHAR(10) NOT NULL
                         ) ENGINE = MyISAM;");

      if ($result === TRUE) {
        echo "<div style='color:red;'>fees table successfully created</div>";
      }else {
        echo "<div style='color:red;'>error creating fees table ".$con->error."</div>";
      }
  }

  
if (isset($_POST['submit'])) {
  include_once("sanitize.php");
  
  $ss1=sanitize($_POST['ss1']);
  $ss2=sanitize($_POST['ss2']);
  $ss3=sanitize($_POST['ss3']);
  $jss1=sanitize($_POST['jss1']);
  $jss2=sanitize($_POST['jss2']);
  $jss3=sanitize($_POST['jss3']);
  $term=sanitize($_POST['term']);
  $session=sanitize($_POST['session']);

  

  $result=$con->query("SELECT * FROM `fees` WHERE `session`='$session' AND `term`='$term'");
  if ($result) {

    if ($result->num_rows > 0) {

    while ($row=$result->fetch_assoc()) {

      $fees_id=$row['fees_id'];

    }

    $result=$con->query("UPDATE `fees` SET 
                        `ss 1`='$ss1',
                        `ss 2`='$ss2',
                        `ss 3`='$ss3',
                        `jss 1`='$jss1',
                        `jss 2`='$jss2',
                        `jss 3`='$jss3',
                        `term`='$term',
                        `session`='$session'
                        WHERE `fees_id`='$fees_id'");

    if ($result === TRUE) {
      echo "<div style='color:red;'>fees record successfully updated</div>";
    }else {
      echo "error updating fees record ".$con->error;
    }    
  
    
    }else {
      
      $result=$con->query("INSERT INTO `fees`(`ss 1`,`ss 2`,`ss 3`,`jss 1`,`jss 2`,`jss 3`,`term`,`session`)
                      VALUES('$ss1','$ss2','$ss3','$jss1','$jss2','$jss3','$term','$session')");

      if ($result === TRUE) {
        echo "<div style='color:red;'>fees record successfully inserted</div>";
      }else {
        echo "<div style='color:red;'>error inserting fees record ".$con->error."</div>";
      }

    }

    
  }else {
    echo "<div style='color:red;'>error encountered reading fees table ".$con->error."</div>";
  }
  
}



$result=$con->query("SELECT * FROM `fees` ");
if ($result) {

  if ($result->num_rows > 0) {

    while ($rows = $result->fetch_assoc()) {
      
      $ss1=$rows['ss 1'];
      $ss2=$rows['ss 2'];
      $ss3=$rows['ss 3'];
      $jss1=$rows['jss 1'];
      $jss2 =$rows['jss 2'];
      $jss3=$rows['jss 3'];
      $term=$rows['term'];
      $session=$rows['session'];

    }
  }
}



?>




<div>
  <h2>SET UP FEES AMOUNT PORTAL</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="session">Session</label>
      <select name="session" class="form-control" required>
        <option value="2014/2015">2014/2015</option>
        <option value="2015/2016">2015/2016</option>
        <option value="2016/2017">2016/2017</option>
        <option value="2017/2018">2017/2018</option>
        <option value="2018/2019">2018/2019</option>
        <option value="2019/2020" selected>2019/2020</option>
        <option value="2020/2021">2020/2021</option>
        <option value="2021/2022">2021/2022</option>
        <option value="2022/2023">2022/2023</option>
        <option value="2023/2024">2023/2024</option>
        <option value="2024/2025">2024/2025</option>
        <option value="2025/2026">2025/2026</option>
      </select>
    </div>

      <div class="form-group">
        <label for="term">Term</label>
        <select name='term' class="form-control" required>
          <option value="first">FIRST</option>
          <option value="second">SECOND</option>
          <option value="third">THIRD</option>
        </select>
      </div>

      <div class="form-group">
        <label for="ss1">SSS 1</label>
        <input type="number" name="ss1" class="form-control" value="<?php echo $ss1; ?>"/>
      </div>

      <div class="form-group">
        <label for="ss1">SSS 2</label>
        <input type="number" name="ss2" class="form-control" value="<?php echo $ss2; ?>"/>
      </div>

      <div class="form-group">
        <label for="ss1">SSS 3</label>
        <input type="number" name="ss3" class="form-control" value="<?php echo $ss3; ?>"/>
      </div>

      <div class="form-group">
        <label for="ss1">JSS 1</label>
        <input type="number" name="jss1" class="form-control" value="<?php echo $jss1; ?>" />
      </div>

      <div class="form-group">
        <label for="ss1">JSS 2</label>
        <input type="number" name="jss2" class="form-control" value="<?php echo $jss2; ?>" />
      </div>

      <div class="form-group">
        <label for="jss1">JSS 3</label>
        <input type="number" name="jss3" class="form-control" value="<?php echo $jss3; ?>"/>
      </div>

      <div class="input-group">
        <input type="submit" name="submit" class="btn btn-success form-control" Value="Submit" />
        <a class="btn btn-warning form-control" Value="Back" href="javascript:history.back();">Back </a>
      </div>

  </form>


</div>
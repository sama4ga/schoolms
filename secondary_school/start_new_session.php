<?php
session_start();
include_once("connect.php");
include_once("head.php");

$msg=array();

if (isset($_POST['submit'])) {
  $term=$_POST['term'];
  $session=$_POST['session'];


 
/*  echo $session;
  echo $term;exit(); */

  if (!$con->query("DESCRIBE `session_info`")) {
    $res=system("mysql -u root managementsystem < c:/xampp/htdocs/schoolms/secondary_school/session_info.sql");
  }




  $result=$con->query("UPDATE `session_info` SET `session`='$session',`term`='$term'");
  if ($result) {

    $result=$con->query("UPDATE `student_class` SET `session`='$session',`term`='$term'");
    if ($result) {
      
      $_SESSION['session']=$session;
      $_SESSION['term']=$term;
      session_write_close();
      
      $msg[]="Session successfully set";
      //echo "<a href='javascript: history.back();'>Click here to go back</a>";
    }else {
      $msg[]="Could not set session info in student table because ".$con->error;
    }
  }else {
    $msg[]="Could not set session info in session table because ".$con->error;
  }
}




$result=$con->query("SELECT * FROM `session_info`");

if ($result->num_rows > 0) {
  echo "<div>Current Session Information</div>";
  
  while ($row=$result->fetch_assoc()) {
    echo "<div style='font-weight:bold;'>
            <div>Current session: ".$row['session']."</div>
            <div>Current Term: ".strtoupper($row['term'])."</div>
          </div>";
  }
}

?>



<form method='POST' action='start_new_session.php'>
            <ul style='color:red;'>
              <?php for ($i=0; $i < count($msg); $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
              } ?>
            </ul>

<div class="form-group">
  <label>Session</label>
  <select name="session" class="form-control">
    <option value="2014/2015">2019/2020</option>
    <option value="2015/2016">2019/2020</option>
    <option value="2016/2017">2019/2020</option>
    <option value="2017/2018">2019/2020</option>
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
  <label>Term</label>
  <select name='term' class="form-control">
		<option value="first">FIRST</option>
		<option value="second">SECOND</option>
		<option value="third">THIRD</option>
	</select>
</div>

<div class="form-group">
  <input type="submit" name="submit" value="submit" class="btn btn-success form-control btn-lg" >
</div>

</form>
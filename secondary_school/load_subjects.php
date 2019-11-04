<?php
session_start();
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

$class=strtolower($_GET['class']);
//echo $class;
$result=$con->query("SELECT * FROM `$class`");
if ($result) {  
  if ($result->num_rows > 0) {
    echo "<label>Subject</label>
          <select name='subjects' class='form-control' onchange='javascript:show()'>
          <option value='default' selected>Choose subject</option>";
    
    while ($subjects=$result->fetch_array()) {
      echo "<option value='".$subjects['subjects']."'>".$subjects['subjects']."</option>";
    }
      echo "</select>";
  }
}

?>
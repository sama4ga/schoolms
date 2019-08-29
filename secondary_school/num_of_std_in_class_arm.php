<?php
require_once("connect.php");
require_once("sanitize.php");

$class = sanitize($_REQUEST['class']);
$arm = sanitize($_REQUEST['arm']);

echo "Number of students currently in  ".strtoupper($class).strtoupper($arm)." is ";
$result = $con->query("SELECT count(`std_id`) FROM `student_class` WHERE `class`='$class' and `arm`='$arm'");
if ($result) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $num_of_std = $row["count(`std_id`)"];
    }

    echo $num_of_std;
  }else {
    echo "0";
  }
}else {
  echo "Error getting record ".$con->error;
}

?>
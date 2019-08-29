<?php
session_start();
include_once("head.php");
require_once("connect.php");

$session=strtolower($_SESSION['session']);
$term=strtolower($_SESSION['term']);
$class=strtolower($_GET['class']);
$arm=strtolower($_GET['arm']);

$session_format=str_replace("/","_",$session);

$atd_id="atd_student_".$session_format."_".$term."_"."".$class."_".$arm;



if ($con->query("DESCRIBE `$atd_id`")) {

  echo "<div style='color:red;'>
          Attendance sheet already created.<br/>
          <a href='javascript:history.back();' class='btn btn-warning'>Back</a>
        </div>";
        exit();
}


$result=$con->query("CREATE TABLE IF NOT EXISTS `$atd_id`(
                    `dd` date NOT NULL, UNIQUE (`dd`)) ENGINE=InnoDB");


if ($result) {
  //import all class members
  $get_results = $con->query("SELECT * FROM `student` s 
                              LEFT JOIN `student_class` sc 
                              ON sc.`std_id`=s.`std_id` 
                              WHERE sc.`class`='$class' 
                              AND sc.`arm`='$arm'
                              AND sc.`session`='$session'");

  $z=0;
  if($get_results){

      $no_of_results = $get_results->num_rows;
      
    while($row = $get_results->fetch_assoc()){				
        $z++;
      //  $surname_this[$z] = strtoupper($row['surname']);
      //  $other_names_this[$z] = strtoupper($row['othernames']);		
        $std_id[$z] = $row['std_id'];
    }

    //echo "success";
  }else {
    echo "Could not get students data ".$con->error."
    <br/><a href='javascript:history.back();' class='btn btn-warning'>Back</a>";
  }

    for($z=1; $z<=$no_of_results; $z++){
                
    $con->query("ALTER TABLE `$atd_id` ADD `$std_id[$z]` VARCHAR(3) NOT NULL DEFAULT '0'");
              
    }

    echo "<div style='color:red;'>
            Attendance sheet successfully created.<br/>
            <a href='javascript:history.back();' class='btn btn-warning'>Back</a>
          </div>";

}else {
  echo "Error: Could not create attendance record ".$con->error."
        <br/><a href='javascript:history.back();' class='btn btn-warning'>Back</a>";
}



?>
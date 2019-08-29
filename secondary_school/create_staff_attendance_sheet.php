<?php
session_start();
require_once("connect.php");

$session=strtolower($_SESSION['session']);
$term=strtolower($_SESSION['term']);

$session_format=str_replace("/","_",$session);

$atd_id="atd_staff_".$session_format."_".$term;

if ($con->query("DESCRIBE `$atd_id`")) {
 echo "Staff attendance sheet already created";
 exit();
}
$result=$con->query("CREATE TABLE IF NOT EXISTS `$atd_id`(
                    `date` date NOT NULL, UNIQUE (`date`)) ENGINE=InnoDB");

if ($result) {
  //import all staff members
  $get_results = $con->query("SELECT * FROM `staff` WHERE `staff_id` <> '1'");

  $z=0;
  if($get_results){
      $no_of_results = $get_results->num_rows;
      
    while($row = $get_results->fetch_assoc()){				
        $z++;
      //  $surname_this[$z] = strtoupper($row['surname']);
      //  $other_names_this[$z] = strtoupper($row['othernames']);		
        $staff_id[$z] = $row['staff_id'];
    }

    echo "Staff attendance sheet successfully created";

  }else {
    echo "An error occurred ".$con->error;
  }


    for($z=1; $z<=$no_of_results; $z++){
                
    $con->query("ALTER TABLE `$atd_id` ADD `$staff_id[$z]` timestamp NOT NULL");
              
    }
}else {
  echo "Error: Could not create attendance sheet ".$con->error;
}



?>
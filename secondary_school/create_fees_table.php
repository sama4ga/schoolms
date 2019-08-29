<?php
session_start();
require_once("connect.php");

$session=$_REQUEST['session'];
$session_formatted = str_replace("_","/",$session);
$term=strtolower($_SESSION['term']);

// create fees table
$fees_id="fees_".$session;

$con->query( "CREATE TABLE IF NOT EXISTS `$fees_id`(
              `fees_id` INT(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`fees_id`),
              `std_id` INT(10) NOT NULL ,
              `surname` varchar(250) NOT NULL,
              `othernames` varchar(400) NOT NULL,
              `class` varchar(6) NOT NULL,
              `arm` varchar(2) NOT NULL,
              `term` varchar(10) NOT NULL,
              `fees` varchar(6) NOT NULL,
              `amount_due` varchar(6) NOT NULL,
              `amount_paid` varchar(6) NOT NULL,
              `balance` varchar(6) NOT NULL,
              `teller_no` varchar(20) NOT NULL,
              `bank` varchar(100) NOT NULL,
              `date` date NOT NULL,
              `date_added` timestamp NOT NULL default CURRENT_TIMESTAMP
              ) ENGINE = MyISAM;");



// create fees debtors table
$fees_debtors_id="fees_debtors_".$session;

$con->query( "CREATE TABLE IF NOT EXISTS `$fees_debtors_id`(
              `fees_id` INT(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`fees_id`),
              `std_id` INT(10) NOT NULL ,
              `surname` varchar(250) NOT NULL,
              `othernames` varchar(400) NOT NULL,
              `class` varchar(6) NOT NULL,
              `arm` varchar(2) NOT NULL,
              `term` varchar(10) NOT NULL,
              `fees` varchar(6) NOT NULL,
              `amount_due` varchar(6) NOT NULL,
              `balance` varchar(6) NOT NULL  
              ) ENGINE = MyISAM;");



  // get students record
  $result = $con->query("SELECT * FROM `student` s LEFT JOIN `student_class` sc on s.`std_id`=sc.`std_id`");
  if ($result) {

    $num_students=$result->num_rows;

    if ($num_students > 0) {

      $x=0;
      while ($row = $result->fetch_assoc()) {

        $std_id[$x]=$row['std_id'];
        $surname[$x]=$row['surname'];
        $othernames[$x]=$row['othernames'];
        $class[$x]=$row['class'];
        $arm[$x]=$row['arm'];

        $x++;
      }
    }
  }
//var_dump($std_id);exit();

//echo "session: ".$session."  term: ".$term;


// get fees data
$result=$con->query("SELECT * FROM `fees` WHERE `session`='$session_formatted' AND `term`='$term'");
if ($result && $result->num_rows > 0) {

  while ($row=$result->fetch_assoc()) {

    $ss_1_fees=$row['ss 1'];
    $ss_2_fees=$row['ss 2'];
    $ss_3_fees=$row['ss 3'];
    $jss_1_fees=$row['jss 1'];
    $jss_2_fees=$row['jss 2'];
    $jss_3_fees=$row['jss 3'];
//echo $jss_1_fees." ".$jss_2_fees." ".$jss_3_fees." ".$ss_1_fees." ".$ss_2_fees." ".$ss_3_fees;
  }
}else {
  echo "Error fetching fees record: ".$con->error;
}
//var_dump($class);
//exit();


// populate fees debtors table with student data
  
  $sql="INSERT INTO `$fees_debtors_id`(
                  `std_id`,`surname`,`othernames`,`class`,`arm`,`fees`,`balance`,`amount_due`,`term`
                  )VALUES";
  for ($i=0; $i < $num_students; $i++) { 

    if ($class[$i] == "jss 1") {
      $fees = $jss_1_fees;
    }elseif ($class[$i] == "jss 2") {
      $fees = $jss_2_fees;
    }elseif ($class[$i] == "jss 3") {
      $fees = $jss_3_fees;
    }elseif ($class[$i] == "ss 1") {
      $fees = $ss_1_fees;
    }elseif ($class[$i] == "ss 2") {
      $fees = $ss_2_fees;
    }elseif ($class[$i] == "ss 3") {
      $fees = $ss_3_fees;
    }
    
    if ($i == $num_students-1) {
      
      $sql.="('$std_id[$i]','$surname[$i]','$othernames[$i]','$class[$i]','$arm[$i]','$fees','$fees','$fees','$term');";
    
    }else{

      $sql.="('$std_id[$i]','$surname[$i]','$othernames[$i]','$class[$i]','$arm[$i]','$fees','$fees','$fees','$term'),";
    
    }

    
  }
//echo $sql;exit();
  $result=$con->multi_query($sql);
  if ($result) {

    echo "fees table successfully created <br/>";
    
  }else{

    echo "Error encountered inserting student record ".$con->error;
  
  }
  //$done="done";



?>
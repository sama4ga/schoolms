<?php
include_once "header.php";
require_once "connect.php";

$class=strtolower($_GET['class']);
$arm=strtolower($_GET['arm']);
//$subject=strtolower(str_replace(" ","_",$_GET['subject']));
$session=strtolower($_SESSION['session']);
$session_format=str_replace("/","_",$session);
$term=strtolower($_SESSION['term']);

$res_id = "res_id_".$session_format."_".$term."_".$class."_".$arm;

$result=$con->query("SELECT * FROM `student` s 
                    LEFT JOIN `student_class` sc 
                    ON s.`std_id`=sc.`std_id` 
                    WHERE sc.`class`='$class' 
                    AND sc.`arm`='$arm'
                    AND sc.`session`='$session'
                    ORDER BY s.`std_id`");

if ($result) {
  $num_record=$result->num_rows;
  
  echo "<table cellspacing='2' cellpadding='10'>";
  $x=0;
  while ($row=$result->fetch_assoc()) {

    $surname[$x]=$row['surname'];
    $othernames[$x]=$row['othernames'];
    $std_id[$x]=$row['std_id'];
    $full_name=$surname[$x].", ".$othernames[$x];
    

    echo "<tr>
            <td>".$full_name."</td>
            <td><a href='psychomotor.php?stdid=$std_id[$x]&resid=$res_id&name=$full_name' class='btn btn-success btn-sm'>Compute</a></td>
          </tr>";

    $x++;
  }

  echo "</table>
        <a href='javascript:history.back();' class='btn btn-warning btn-sm'>Back</a>";
    
}else{
  echo "Error occured ".$con->error;
}



?>
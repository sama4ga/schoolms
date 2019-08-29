<?php
include_once("header.php");
require_once("connect.php");

$msg=array();

$class=strtolower($_GET['class']);
$arm=strtolower($_GET['arm']);
$subject_orig=$_GET['subject'];
$subject=strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $subject_orig));
$session=strtolower($_SESSION['session']);
$session_format=str_replace("/","_",$session);
$term=strtolower($_SESSION['term']);
$staff_id=strtolower($_SESSION['staff_id']);


$subject_ca_1 = $subject."_ca_1";
$subject_ca_2 = $subject."_ca_2";
$subject_ca_3 = $subject."_ca_3";
$subject_ca_4 = $subject."_ca_4";
$subject_exam = $subject."_exam";

$res_id = "res_id_".$session_format."_".$term."_".$class."_".$arm;


if (isset($_POST['submit'])) {


  $ca_1=$_POST['ca_1'];
  $ca_2=$_POST['ca_2'];
  $ca_3=$_POST['ca_3'];
  $ca_4=$_POST['ca_4'];
  $exams=$_POST['exams'];
  $std_id=$_POST['std_id'];


  for ($i=0; $i < count($std_id); $i++) { 
    if ($ca_1[$i] > 10 || $ca_2[$i] > 10 || $ca_3[$i] > 10 || $ca_4[$i] > 10) {
      echo "ca score cannot be greater than 10";    
    }elseif ($exams[$i] > 60) {
      echo "Maximum score for exams is 60";
    }elseif ($exams[$i] + $ca_1[$i] + $ca_2[$i] + $ca_3[$i] + $ca_4[$i] > 100) {
      echo "Total score cannot be greater than 100";
    }else {
      $result=$con->query("UPDATE `$res_id` SET `$subject`='$subject',`$subject_ca_1`='$ca_1[$i]',
                          `$subject_ca_2`='$ca_2[$i]',`$subject_ca_3`='$ca_3[$i]',
                          `$subject_ca_4`='$ca_4[$i]',`$subject_exam`='$exams[$i]'
                          WHERE `std_id`='$std_id[$i]'");
/* 
      if (!$result) {
        echo "Could not record scores ".$con->error;;
      }else {
        echo "Record successfully update 
              <p> <a href='result.php?class=$class&arm=$arm&sid=1&subject=$subject' class='btn btn-success'>Continue</a>
                  <a href='class_portal.php?sid=1' class='btn btn-warning'>Back</a>";
      
      } */
    }

    
  }
  echo "Record successfully updated: 
          <div class='btn-group'> <a href='result.php?class=$class&arm=$arm&sid=$staff_id&subject=$subject' class='btn btn-success'>Continue</a>
              <a href='javascript:history.back(3);' class='btn btn-warning'>Back</a></div>";
      
  exit();
  

}

$result=$con->query("SELECT * FROM `student` s 
                    LEFT JOIN `student_class` sc 
                    ON s.`std_id`=sc.`std_id` 
                    WHERE sc.`class`='$class' 
                    AND sc.`arm`='$arm'
                    AND sc.`session`='$session'
                    ORDER BY s.`std_id`");

if ($result) {
  $num_record=$result->num_rows;
  
  $x=0;
  while ($row=$result->fetch_assoc()) {

    $surname[$x]=$row['surname'];
    $othernames[$x]=$row['othernames'];
    $std_id[$x]=$row['std_id'];
    $x++;
  }
    
}else{
  echo "Error occured ".$con->error;
}



$res_id = "res_id_".$session_format."_".$term."_".$class."_".$arm;

if (!$con->query("DESCRIBE `$res_id`")) {

  echo "<div style='color:red;'>Result sheet not yet created.<br/>Inform the class teacher to create the result sheet and then try again.<br/>
        <a href='javascript:history.back(2);' class='btn btn-warning'>Click here to go back</a></div>";
  
}else {

  $result=$con->query("SELECT * FROM `$res_id` ORDER BY `std_id`");
  if ($result) {

    $x=0;
    while ($row=$result->fetch_assoc()) {

      $sid[$x]=$row['std_id'];
      $subjects_ca_1[$x]=$row[$subject_ca_1];
      $subjects_ca_2[$x]=$row[$subject_ca_2];
      $subjects_ca_3[$x]=$row[$subject_ca_3];
      $subjects_ca_4[$x]=$row[$subject_ca_4];
      $subjects_exam[$x]=$row[$subject_exam];
      $x++;
    }
  }else{
    echo "Error: ".$con->error;
  }

  echo "<b>Compute ".$subject_orig." result for ".strtoupper($class)." ".strtoupper($arm).", ".strtoupper($term)." term $session academic session</b>
          <div style='display:flex;'>
            <div>
              <form method='post' action='result.php?class=$class&arm=$arm&sid=1&subject=$subject'>
                <ul style='color:red;'>"; 
                  for ($i=0; $i < count($msg) ; $i++) { 
                    echo "<li style='list-style:none;'>".$msg[$i]."</li>";
                  }  
  echo          "</ul>
              
                <table cellpadding='5'>
                  <th>Student's Name</th>
                  <th>Test 1 (10%)</th>
                  <th>Test 2 (10%)</th>
                  <th>Test 3 (10%)</th>
                  <th>Test 4 (10%)</th>
                  <th>Exams (60%)</th>
                  "; 
  //var_dump($std_id);echo "<div/>"; var_dump($sid); 
  for ($i=0; $i < $num_record ; $i++) {
    if ($std_id[$i] == $sid[$i]) {
      $value_ca_1[$i]=$subjects_ca_1[$i];
      $value_ca_2[$i]=$subjects_ca_2[$i];
      $value_ca_3[$i]=$subjects_ca_3[$i];
      $value_ca_4[$i]=$subjects_ca_4[$i];
      $value_exam[$i]=$subjects_exam[$i];
    }else {
      $value_ca_1[$i]='';
      $value_ca_2[$i]='';
      $value_ca_3[$i]='';
      $value_ca_4[$i]='';
      $value_exam[$i]='';
    }

    echo "<tr>
            <td style='width:300px;'>".$surname[$i].", ".$othernames[$i]."</td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca_1[]' style='width:80px;' value='".
            $value_ca_1[$i]."'></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca_2[]' style='width:80px;' value='".
            $value_ca_2[$i]."'></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca_3[]' style='width:80px;' value='".
            $value_ca_3[$i]."'></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca_4[]' style='width:80px;' value='".
            $value_ca_4[$i]."'></td>
            <td><input type='number' min='0' max='60' class='form-control' name='exams[]' style='width:80px;' value='".
            $value_exam[$i]."'></td>
            <input type='hidden' name='std_id[]' value='".$std_id[$i]."'>
          </tr>";  

  }
    echo "      <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <input type='submit' name='submit' value='submit' class='btn-success form-control' >
                    </td>
                    <td>                      
                      <a href='javascript:history.back(2);' class='btn-warning form-control' >Back</a>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>";
}


?>	

<!-- <div align='right' style='padding-left:100px;'>
  <iframe src='' name='result'>
</div> -->
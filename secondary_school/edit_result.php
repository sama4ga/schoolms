<?php
require_once("connect.php");
include_once("head.php");

$msg=array();

$res_id=$_GET['resid'];
$std_id=$_GET['stdid'];
$class=$_GET['class'];
$student_name=$_GET['name'];




// get term data
$get_term_data = $con->query("SELECT * FROM `existing_result_sheets` WHERE result_id='$res_id'");
	
if($get_term_data)
  {
  
    while($row = $get_term_data->fetch_array())
      {
      
        $term = strtoupper(str_replace("_", " ", $row['term']));
        $session =  strtoupper(str_replace("_", " / ", $row['session']));
        $arm = strtoupper( $row['arm']);
        $class = strtoupper( $row['class']);
        
        //$ntf = $row['ntf'];

        //$max_atd = $row['max_atd'];
        //$atd_max = $row['max_atd'];

        //$show_pos = $row['show_pos'];
        //$show_pos_sub = $row['show_pos_sub'];
        
      }
  
  }





// get subjects	
$get_subs = $con->query("SELECT * FROM `$class` ORDER BY `subjects` ASC");
	
if($get_subs) {
  $no_of_subs = $get_subs->num_rows;
  
  $x=0;
  while($row = $get_subs->fetch_array()) {

    $subject_orig[$x] = $row['subjects'];
    $subjects[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['subjects']));
    $subjects_ca1[$x] = $subjects[$x]."_ca_1";
    $subjects_ca2[$x] = $subjects[$x]."_ca_2";
    $subjects_ca3[$x] = $subjects[$x]."_ca_3";
    $subjects_ca4[$x] = $subjects[$x]."_ca_4";
    $subjects_exams[$x] = $subjects[$x]."_exam";
    $subject_orig[$x] = strtoupper($subject_orig[$x]);
      

    //	$subjects_chs[$x] = $subjects[$x]."_chs";
    //	$subjects_cls[$x] = $subjects[$x]."_cls";
      
      //$subjects_cas[$x] = $subjects[$x]."_cas";
      
      
    //	$subjects_cum[$x] = $subjects[$x]."_cum";					
      
    //	$subjects_ca_first_term[$x] = $subjects[$x]."_ca_first_term";
    //	$subjects_ca_second_term[$x] = $subjects[$x]."_ca_second_term";
    //	$subjects_ca_third_term[$x] = $subjects[$x]."_ca_third_term";
    
    $x++;

  }
      
  }






if (isset($_POST['submit'])) {
  
  $ca1=$_POST['ca1'];
  $ca2=$_POST['ca2'];
  $ca3=$_POST['ca3'];
  $ca4=$_POST['ca4'];
  $exams=$_POST['exams'];

  foreach ($ca1 as $key => $value) {
    
    $con->query("UPDATE `$res_id` SET `$subjects_ca1[$key]`='$ca1[$key]',
                `$subjects_ca2[$key]`='$ca2[$key]',
                `$subjects_ca3[$key]`='$ca3[$key]',
                `$subjects_ca4[$key]`='$ca4[$key]',
                `$subjects_exams[$key]`='$exams[$key]'
                WHERE `std_id`='$std_id' ");
                
  }

  $msg[]="Result successfully edited";
  //var_dump($ca1);

}






$result=$con->query("SELECT * FROM `$res_id` WHERE `std_id`='$std_id'");

if ($result) {

  if ($result->num_rows > 0) {

    while ($row=$result->fetch_assoc()) {

      $surname = $row['surname'];
      $othernames = $row['othernames'];
      $full_name = $surname.", ".$othernames;


      for ($x=0; $x < $no_of_subs; $x++) { 

        if ($row[$subjects[$x]] != "N/A") {
          
          $ca1[$x] = $row[$subjects_ca1[$x]];
          $ca2[$x] = $row[$subjects_ca2[$x]];
          $ca3[$x] = $row[$subjects_ca3[$x]];
          $ca4[$x] = $row[$subjects_ca4[$x]];
          $exams[$x] = $row[$subjects_exams[$x]];

        }else {
         
          $ca1[$x] = "N/A";
          $ca2[$x] = "N/A";
          $ca3[$x] = "N/A";
          $ca4[$x] = "N/A";
          $exams[$x] = "N/A";

        }
        
      }

    }
  }
}


//var_dump($exams);

echo "<div align='center'><b>EDIT STUDENT RESULT PORTAL</b></div>
      
      <p><div>Session: <b style='color:red;'>$session</b></div>
      <div>Term: <b style='color:red;'>$term</b></div></p>

      <p><div>Student Name: <b style='color:red;'>$student_name</b></div>
      <div>Student Class: <b style='color:red;'>".$class." ".$arm."</b></div></p>";

echo "<form action='edit_result.php?resid=$res_id&stdid=$std_id&class=$class&name=$student_name' method='POST'>
        
        <ul style='color:red;'>"; 
          for ($i=0; $i < count($msg) ; $i++) { 
            echo "<li style='list-style:none;'>".$msg[$i]."</li>";
          }  
echo    "</ul>


        <table class='data'>
          <tr>
            <th>S/N</th>
            <th>Subject</th>
            <th>Test 1 (10%) </th>
            <th>Test 2 (10%) </th>
            <th>Test 3 (10%) </th>
            <th>Test 4 (10%) </th>
            <th>Exams (60%) </th>
          </tr>";

$count=0;
for ($i=0; $i < $no_of_subs; $i++) { 

  if ($ca1[$i] !== "N/A") {
    
    $count=$count+1;
    echo "<tr>
            <td>$count</td>
            <td width='200'>".$subject_orig[$i]."</td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca1[$i]' value='".$ca1[$i]."' /></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca2[$i]' value='".$ca2[$i]."' /></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca3[$i]' value='".$ca3[$i]."' /></td>
            <td><input type='number' min='0' max='10' class='form-control' name='ca4[$i]' value='".$ca4[$i]."' /></td>
            <td><input type='number' min='0' max='60' class='form-control' name='exams[$i]' value='".$exams[$i]."' /></td>
          </tr>";

  }
  

}

echo "</table>
      <div class='input-group' style='width:70%;margin-top:30px;'>
        <input type='submit' name='submit' value='Submit' class='btn btn-success form-control' />
        <input type='submit' name='back' value='Back' class='btn btn-warning form-control' formaction='javascript:history.back(2);' />
      </div>
    </form>";

?>
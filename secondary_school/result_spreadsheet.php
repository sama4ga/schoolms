<?php
require_once("connect.php");
include_once("header.php");

$res_id=$_GET['resid'];
$class=$_GET['class'];


// get term data
$get_term_data = $con->query("SELECT * FROM `existing_result_sheets` WHERE result_id='$res_id'");
	
if($get_term_data)
  {
  
    while($row = $get_term_data->fetch_array())
      {
      
        $term = strtoupper(str_replace("_", " ", $row['term']));
        $session =  strtoupper(str_replace("_", " / ", $row['session']));
        //$ntf = $row['ntf'];

        //$max_atd = $row['max_atd'];
        //$atd_max = $row['max_atd'];

        //$show_pos = $row['show_pos'];
        //$show_pos_sub = $row['show_pos_sub'];
        
      }
  
  }


// get subjects	
$get_subs = $con->query("SELECT * FROM `$class` ORDER BY `subjects` ASC");
	
if($get_subs)
  {
    $no_of_subs = $get_subs->num_rows;
    
    $x=0;
    while($row = $get_subs->fetch_array()) {

        $subject_orig[$x] = $row['subjects'];
        $subjects[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['subjects']));
        $subjects_ca_1[$x] = $subjects[$x]."_ca_1";
        $subjects_ca_2[$x] = $subjects[$x]."_ca_2";
        $subjects_ca_3[$x] = $subjects[$x]."_ca_3";
        $subjects_ca_4[$x] = $subjects[$x]."_ca_4";
        $subjects_exams[$x] = $subjects[$x]."_exam";
        $subjects_total[$x] = $subjects[$x]."_total";
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


$result=$con->query("SELECT * FROM `$res_id`");

if ($result) {

  $no_on_rolls=$result->num_rows;

  $y=0;
  if ($no_on_rolls > 0) {

    while ($row=$result->fetch_assoc()) {

      $surname[$y] = $row['surname'];
      $std_id[$y] = $row['std_id'];
      $othernames[$y] = $row['othernames'];
      $full_name[$y] = $surname[$y].", ".$othernames[$y];


      for ($x=0; $x < $no_of_subs; $x++) { 

        $score_ca_1[$y][$x] = $row[$subjects_ca_1[$x]];
        $score_ca_2[$y][$x] = $row[$subjects_ca_2[$x]];
        $score_ca_3[$y][$x] = $row[$subjects_ca_3[$x]];
        $score_ca_4[$y][$x] = $row[$subjects_ca_4[$x]];
        $score_exams[$y][$x] = $row[$subjects_exams[$x]];
        $score[$y][$x] = $row[$subjects_total[$x]];
        
      }

      $total_score[$y] = $row['total_score'];
      $average[$y] = $row['average'];
      $position[$y] = $row['position'];

      $class_average=$row['class_average'];

      $y++;

    }
  }
}


echo "<h1 align='center' style='font-family:times new roman; font-size:1.1rem;'>RESULT SUMMARY CLASS: <b>".strtoupper($class)."</b>
        SESSION: <b>".$session."</b> TERM: <b>".$term."</b>
        <br/>
        <br/>
        CLASS AVERAGE: <b>".$class_average."</b>
      </h1>
      

      
     <table  cellspacing='2' cellpadding='2' border='0' class='data'>
     <tr>
      <th align='center' style='border: 2px solid #e0e0e0' rowspan='2'>S/N</th>
      <th align='center' width='1000' style='border:2px solid #e0e0e0;text-align:center;min-width:200px;' rowspan='2'>NAMES OF STUDENTS</th>";
        
for ($x=0; $x < $no_of_subs; $x++) { 
  
  echo "<th valign='bottom' width='600' style='border-right: 2px solid #e0e0e0' colspan='6'>".$subject_orig[$x]."</th>";

}

  echo "<th valign='bottom' width='100' style='border: 2px solid #e0e0e0' rowspan='2'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>TOTAL</div></th>
        <th valign='bottom' width='100' style='border: 2px solid #e0e0e0' rowspan='2' z><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>AVERAGE</div></th>
        <th valign='bottom' width='100' style='border: 2px solid #e0e0e0' rowspan='2'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>POSITION</div></th>
        <th valign='bottom' width='100' style='border-right: 2px solid #e0e0e0; text-align:center;' rowspan='2'><div  style='width:1px; height:1px; transform:rotate(270deg);'>REMARKS</div></th>
      </tr>
      <tr>";

        for ($x=0; $x < $no_of_subs; $x++) { 
  
          echo "<th height='60' valign='bottom' width='100' style='border: 1px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Ca_1</div></th>
                <th height='60' valign='bottom' width='100' style='border: 1px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Ca_2</div></th>
                <th height='60' valign='bottom' width='100' style='border: 1px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Ca_3</div></th>
                <th height='60' valign='bottom' width='100' style='border: 1px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Ca_4</div></th>
                <th height='60' valign='bottom' width='100' style='border: 1px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Exams</div></th>
                <th height='60' valign='bottom' width='100' style='border-right: 2px solid #e0e0e0'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Total</div></th>";
        
        }
  echo "<th></th>
        <th></th>
        <th></th>
        <th></th>      
      </tr>";


$count=0;
for ($i=0; $i < $no_on_rolls; $i++) {

  $count++;

 /*  if ($count % 2 == 1) {
    
    $color="rgb(233,155,155)";

  }else {
    
    $color="rgb(226,89,89)";

  } */
  echo "<tr>
          <td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$count."</td>
          <td width='500' style='border: 1px solid #e0e0e0; text-align:center;'><div width='500' text-align:center;'>".$full_name[$i]."</div></td>";

          for ($x=0; $x < $no_of_subs; $x++) { 

            echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$score_ca_1[$i][$x]."</td>";
            echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$score_ca_2[$i][$x]."</td>";
            echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$score_ca_3[$i][$x]."</td>";
            echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$score_ca_4[$i][$x]."</td>";
            echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$score_exams[$i][$x]."</td>";
            echo "<td width='100' style='border-right: 2px solid #e0e0e0; text-align:center;'>".$score[$i][$x]."</td>";

          }

  echo "<td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$total_score[$i]."</td>
        <td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$average[$i]."</td>
        <td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$position[$i]."</td>";
        
  if ($average[$i] > $class_average) {
    
    $remark[$i]="Passed";

  }else {

    $remark[$i]="Failed";

  }
        
  echo  " <td width='100' style='border: 1px solid #e0e0e0; text-align:center;'>".$remark[$i]."</td>
        </tr>";

}


echo "</table>

<div style='margin-top:40px;'><a href='javascript:history.back();' class='btn btn-warning form-control'>Back</a></div>";
?>


<!-- <body bgcolor="#ffffff" style="color:rgb(226, 89, 89)">

</body> -->
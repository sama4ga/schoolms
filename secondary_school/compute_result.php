<?php
include_once("header.php");
require_once("connect.php");

$class=strtolower($_GET['class']);
$arm=strtolower($_GET['arm']);

if (isset($_GET['session'])) {
  $session=$_GET['session'];
}else{
  $session=strtolower($_SESSION['session']);
}

if (isset($_GET['term'])) {
  $term=strtolower($_GET['term']);
}else{
  $term=strtolower($_SESSION['term']);
}
$session_format=str_replace("/","_",$session);

$result=$con->query("SELECT * FROM `$class`");

if ($result) {
  if ($result->num_rows > 0) {
    $num_subjects=$result->num_rows;
    while ($rows=$result->fetch_assoc()) {
      $subjects[]=strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_",$rows['subjects']));
    }
  }
}

$res_id = "res_id_".$session_format."_".$term."_".$class."_".$arm;
$result=$con->query("SELECT * FROM `$res_id`");

if ($result) {
  $num_students=$result->num_rows;
  if ($num_students > 0) {
    $x=0;
    while ($rows=$result->fetch_assoc()) {
      $surname[$x]=$rows['surname'];
      $othernames[$x]=$rows['othernames'];
      $std_id[$x]=$rows['std_id'];
      $uid[$x]=$rows['uid'];

      for ($i=0; $i < count($subjects); $i++) { 
        //if ($subjects[$i] == "N/A") {
          
        //}else {
          
        //}
        $subject_orig[$i]=$subjects[$i];
        $subject_ca_1[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_1");
        $subject_ca_2[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_2");
        $subject_ca_3[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_3");
        $subject_ca_4[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_4");
        $subject_exams[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_exam");
        $subject_total[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_total");        
        $subject_average[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_average");        
        $subject_pos[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_position");

      
        $sub_ca_1[$i]=$rows[$subject_ca_1[$i]];
        $sub_ca_2[$i]=$rows[$subject_ca_2[$i]];
        $sub_ca_3[$i]=$rows[$subject_ca_3[$i]];
        $sub_ca_4[$i]=$rows[$subject_ca_4[$i]];
        $sub_exams[$i]=$rows[$subject_exams[$i]];

        $sub_total[$i] = $sub_ca_1[$i] + $sub_ca_2[$i] + $sub_ca_3[$i] + $sub_ca_4[$i] + $sub_exams[$i] ;
        $sub_avg[$i]=$sub_total[$i]/$num_students;

        $con->query("UPDATE `$res_id` SET `$subject_total[$i]`='$sub_total[$i]',
                    `$subject_average[$i]`='$sub_avg[$i]' WHERE `std_id`='$std_id[$x]'");
      }

      $s_total[$x]=$sub_total;
      //var_dump($sub_total);
      $student_total[$x]=0;
      for ($y=0; $y < count($sub_total); $y++) { 
        $student_total[$x] += $sub_total[$y];
      } 
      $student_avg[$x]=$student_total[$x]/$num_subjects;
      $student_avg[$x]=number_format($student_avg[$x],1,".","");

      $con->query("UPDATE `$res_id` SET `total_score`='$student_total[$x]',
                  `average`='$student_avg[$x]' WHERE `std_id`='$std_id[$x]'");
                  
      //echo "<br/>STUDENT TOTAL = ".$student_total[$x];
      //echo "<br/>STUDENT AVERAGE = ".$student_avg[$x];
      $x++;
    }
    
    // determine subject position
    $suf="";
    for ($i=0; $i < $num_subjects; $i++) {

      $subject_orig[$i]=$subjects[$i];       
      $subject_pos[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_position");


      foreach ($s_total as $key => $value) {
        $p[]=$s_total[$key][$i];
      }
      //echo "<pre>".print_r($p)."</pre>";
      asort($p);
      //echo "<pre>".print_r($p)."</pre>";
      $count=count($p);
      foreach ($p as $key => $value) {
        $last=substr($count,strlen($count)-1,1);
        if ($last =="1" && $count != 11) {
          $suf="st";
        }elseif ($last =="2" && $count != 12) {
          $suf="nd";
        }elseif ($last =="3" && $count != 13) {
          $suf="rd";
        }else {
          $suf="th";
        }
        
        $position[$std_id[$key]]=$count.$suf;
        $count--;
//echo $subject_pos[$i];
        $con->query("UPDATE `$res_id` SET `$subject_pos[$i]`='".$position[$std_id[$key]]."' WHERE `std_id`='$std_id[$key]'");
      
      }//echo "<pre>".print_r($position)."</pre>";
      $p=null;
      
    }


    $class_total=0;
    for ($x=0; $x < $num_students; $x++) { 
      //echo $x;
      $class_total +=$student_total[$x];
      
    }
    
    $class_avg = $class_total / ($num_students*$num_subjects);
    $class_avg=number_format($class_avg,1,".","");


    //determine position in class
    asort($student_total);
    for ($i=0; $i < $num_students; $i++) { 


      $count=count($student_total);
      foreach ($student_total as $key => $value) {

        $last=substr($count,strlen($count)-1,1);
        if ($last =="1" && $count != 11) {
          $suf="st";
        }elseif ($last =="2" && $count != 12) {
          $suf="nd";
        }elseif ($last =="3" && $count != 13) {
          $suf="rd";
        }else {
          $suf="th";
        }
        

        $position[$std_id[$key]]=$count.$suf;
        $count--;

        $con->query("UPDATE `$res_id` SET `position`='".$position[$std_id[$key]]."',`class_average` ='$class_avg' WHERE `std_id`='$std_id[$key]'");
      
      }
    }

    
  }



  //compute attendance
  $atd_id="atd_student_".$session_format."_".$term."_".$class."_".$arm;
  
  for ($x=0; $x < $num_students; $x++) { 

    $this_atd=0;
		
		//get state of atd
    $get_state = mysqli_query($con,"SELECT `$std_id[$x]` FROM `$atd_id` ");
    
    $no_of_atd = mysqli_num_rows($get_state);
    
    while ($row=mysqli_fetch_array($get_state))
      {
        if($row[$std_id[$x]] ==1){$this_atd++;}										
      }
    
    $con->query("UPDATE `$res_id` SET `atd`= '$this_atd' WHERE `std_id`='$std_id[$x]'");
        
    /* $result=$con->query("SELECT count(`$std_id[$x]`) FROM `$atd_id` WHERE `$std_id[$x]`='1'");
    
    if ($result) {

      $atd_no=$result->num_rows;
      $con->query("UPDATE `$res_id` SET `atd`= '$atd_no' WHERE `std_id`='$std_id[$x]'");
   
    } */
  
  }



  // get other details and update
  for ($x=0; $x < $num_students; $x++) { 

    $result=$con->query("SELECT `dob`,`student_reg_no`,`phone 1`,`passport` FROM `student` WHERE `std_id`='$std_id[$x]'");
    
    if ($result) {

      while ($row=$result->fetch_assoc()) {

        $dob=$row['dob'];
        $reg_no=$row['student_reg_no'];
        $phone_no=$row['phone 1'];
        $passport=$row['passport'];

      }


      $start=strtotime($dob);
      $today=time(); 
      $age=floor(($today-$start)/(60*60*24*365));


      $con->query("UPDATE `$res_id` SET 
                  `age`= '$age',
                  `phone_no`= '$phone_no',
                  `passport`= '$passport',
                  `reg_no`= '$reg_no'
                   WHERE `std_id`='$std_id[$x]'");


    }
  
  }

  //$con->query("UPDATE `$res_id` SET `class_average`='$class_avg' WHERE `std_id`='$std_id[$x]'");
  //echo "<br/>class TOTAL = ".$class_total;
  //echo "<br/>class average = ".$class_avg;
}else {
  echo "Error ".$con->error;
} 



//include "":




echo "<div align='center'><b>Results for ".strtoupper($class)." ".strtoupper($arm)." for the $session academic session</b></div>
      <p>
      <table border='0' cellpadding='0'>";
for ($i=0; $i < $num_students; $i++) {

  if($i % 2 == 0)	{

    $color='#BBFFBB';
      //$color='#E1E1FF';
      
      //$color='#F9FBC6';
      //$color='#FFC2AE';
    //$color='#FFDFDF';
      
    
  }else{
    
    $color='white';

  }
  echo "  <tr bgcolor='$color'>
            <td>".$surname[$i].", ".$othernames[$i]."</td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              <a href='view_detailed_result(copy).php?uid=$uid[$i]&class=$class&arm=$arm&result_id=$res_id' class='btn btn-success' target='_blank'>View Detailed Result</a></td>
          </tr>";

}

echo "<a href='javascript:history.back();' class='btn btn-warning'>Back</a>
      </table>";

$con->close();
?>
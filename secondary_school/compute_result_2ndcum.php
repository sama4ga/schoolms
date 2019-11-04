<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "class_teacher" && $priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

$class=strtolower($_GET['class']);
$arm=strtolower($_GET['arm']);


if (isset($_GET['session'])) {
  $session=$_GET['session'];
}else{
  $session=strtolower($_SESSION['session']);
}
$session_format=str_replace("/","_",$session);


if (isset($_GET['term'])) {
  $term=strtolower($_GET['term']);
}else{
  $term=strtolower($_SESSION['term']);
}

$res_id = "res_id_".$session_format."_".$term."_".$class."_".$arm;
if (!$con->query("DESCRIBE `$res_id`")) {
  echo "<div style='color:red;'>Result sheet has not been created.<br/>
          Create result sheet and try again
        </div>";
  echo "<a href='javascript:history.back()' class='btn-warning btn-md'>Back</a>";
  exit();
}


// get no of ca, ca score and exam score
$result = $con->query("SELECT * FROM `school_info`;");
if ($result) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $no_of_ca = $row['no_of_ca'];
      $ca_score = $row['ca_score'];
      $exam_score = $row['exam_score'];
    }
  }
}



$result=$con->query("SELECT * FROM `$class`");

if ($result) {

  if ($result->num_rows > 0) {

    $num_subjects=$result->num_rows;

    while ($rows=$result->fetch_assoc()) {

      $subjects[]=strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_",$rows['subjects']));
    }


    for ($i=0; $i < count($subjects); $i++) { 

      $subject_orig[$i]=$subjects[$i];
      for ($x=1; $x <= $no_of_ca; $x++) { 
        $subject_ca[$i][$x]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_".$x);
      }
      /* $subject_ca_1[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_1");
      $subject_ca_2[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_2");
      $subject_ca_3[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_3");
      $subject_ca_4[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_ca_4"); 
      */
      $subject_exams[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_exam");
      $subject_total[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_total");        
      $subject_average[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_average");        
      $subject_pos[$i]=strtolower(str_replace(" ","_",$subjects[$i])."_position");      
			$subjects_first_term[$i] = strtolower(str_replace(" ","_",$subjects[$i])."_first_term");
			$subjects_second_term[$i] = strtolower(str_replace(" ","_",$subjects[$i])."_second_term");
			$subjects_cumulative[$i] = strtolower(str_replace(" ","_",$subjects[$i])."_cumulative");

    }
    

  }
}



//var_dump($subjects);

$result=$con->query("SELECT * FROM `$res_id`");

if ($result) {

  $num_students=$result->num_rows;

  if ($num_students > 0) {

    $x=0;    
    $no_of_students_sub=array();      // number of subjects offered by the student
    while ($rows=$result->fetch_assoc()) {
      $surname[$x]=$rows['surname'];
      $othernames[$x]=$rows['othernames'];
      $std_id[$x]=$rows['std_id'];
      $uid[$x]=$rows['uid'];
      
      $no_of_subjects_std[$x]=0;        // number of students offering a subject
      for ($i=0; $i < $num_subjects; $i++) { 
        
        if ($rows[$subjects[$i]] != "N/A") {

          for ($z=1; $z <= $no_of_ca; $z++) { 
            $sub_ca[$i][$z]=$rows[$subject_ca[$i][$z]];
          }
          /* $sub_ca_1[$i]=$rows[$subject_ca_1[$i]];
          $sub_ca_2[$i]=$rows[$subject_ca_2[$i]];
          $sub_ca_3[$i]=$rows[$subject_ca_3[$i]];
          $sub_ca_4[$i]=$rows[$subject_ca_4[$i]];
           */
          $sub_exams[$i]=$rows[$subject_exams[$i]];

          $no_of_subjects_std[$x]=$no_of_subjects_std[$x]+1;

          if (array_key_exists($i, $no_of_students_sub)) {

            $no_of_students_sub[$i]=$no_of_students_sub[$i]+1;    
            
          }else {

            $no_of_students_sub[$i]=1;
            
          }

        }else{

          for ($z=1; $z <= $no_of_ca; $z++) { 
            $sub_ca[$i][$z]=0;
          }
          $sub_exams[$i]=0;

        }

        $sub_total[$i] = 0;
        for ($z=1; $z <= $no_of_ca; $z++) {           
          $sub_total[$i] += $sub_ca[$i][$z];
        }
        $sub_total[$i] += $sub_exams[$i];
        
        
      }
      
      $s_total[$x]=$sub_total;                  
      
      $x++;

      //echo "<pre>".print_r($sub_total)."</pre>";
    }





    $suf="";
    for ($x=0; $x < $num_students; $x++) {
      
      
    // echo "<pre>".print_r($s_total[$x])."</pre>";
      
      $student_total[$x]=0;
      for ($i=0; $i < $num_subjects; $i++) {

        $sub_total[$i]=$s_total[$x][$i];
        /* $sub_avg[$i]=$sub_total[$i]/$no_of_students_sub[$i];
        $sub_avg[$i]=number_format($sub_avg[$i],1,".",""); */



        $con->query("UPDATE `$res_id` SET `$subject_total[$i]`='$sub_total[$i]'
        WHERE `std_id`='$std_id[$x]'");     
    

      }

    }

      // determine subject position
      for ($i=0; $i < $num_subjects; $i++) {

        
        foreach ($s_total as $key => $value) {
            $p[]=$s_total[$key][$i];
          }


        $sub_avg[$i]=array_sum($p)/$no_of_students_sub[$i];
        $sub_avg[$i]=number_format($sub_avg[$i],1,".","");

        asort($p);
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
          $con->query("UPDATE `$res_id` SET `$subject_pos[$i]`='".$position[$std_id[$key]]."',`$subject_average[$i]`='$sub_avg[$i]' WHERE `std_id`='$std_id[$key]'");
        
        }//echo "<pre>".print_r($position)."</pre>";
 
        
        $p=null;

      }




    for ($x=0; $x < $num_students; $x++) {
      $student_total[$x]=array_sum($s_total[$x]);
      $student_avg[$x]=$student_total[$x]/$no_of_subjects_std[$x];
      $student_avg[$x]=number_format($student_avg[$x],1,".","");

  //if ($student_avg[$x] >= $class_avg) {
        if ($student_avg[$x] >= 40) {
          $student_status[$x]="pass";
        }else {
          $student_status[$x]="fail";
        }


      $con->query("UPDATE `$res_id` SET `total_score`='$student_total[$x]',
                  `average`='$student_avg[$x]',
                  `status`='$student_status[$x]'
                  WHERE `std_id`='$std_id[$x]'");

    }






    
      
 
      $class_total=0;
      $class_total=array_sum($student_total);


      //determine position in class
      asort($student_total);
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


      $class_avg= $class_total / ($num_students*$no_of_subjects_std[$key]);
      $class_avg=number_format($class_avg,1,".","");



        $con->query("UPDATE `$res_id` SET `position`='".$position[$std_id[$key]]."', 
        `class_average`='$class_avg' WHERE `std_id`='$std_id[$key]'");
      
      }     
                  
       
  }


    //echo "<pre>".print_r($sub_avg)."</pre>";
    //echo "<pre>".print_r($student_total)."</pre>";   





  //compute attendance
  $atd_id="atd_student_".$session_format."_".$term."_".$class."_".$arm;
  if ($con->query("DESCRIBE `$atd_id`")) {
    
    for ($x=0; $x < $num_students; $x++) { 
  
      $this_atd=0;
      
      //get state of atd
      $get_atd = $con->query("SELECT `$std_id[$x]` FROM `$atd_id` ");
      if ($get_atd) {
        
        $no_of_atd = $get_atd->num_rows;
        
        while ($row=$get_atd->fetch_array())
          {
            if($row[$std_id[$x]] ==1){$this_atd++;}										
          }
        
        $con->query("UPDATE `$res_id` SET `atd`= '$this_atd' WHERE `std_id`='$std_id[$x]'");
        
      }
    
    }
    
    $con->query("UPDATE `existing_result_sheets` SET `max_atd`='$no_of_atd' WHERE `result_id`= '$res_id'");  
  
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




   // add details for second term cumulative
   if (preg_match("/second/",$res_id)) {

    for ($x=0; $x < $num_students; $x++) {
     

      $res_id=str_replace("second","first",$res_id);
      $result=$con->query("SELECT * FROM `$res_id` WHERE `std_id`='$std_id[$x]'");
      if ($result) {
        if ($result->num_rows > 0) {

          while ($row=$result->fetch_assoc()) {

            for($i=0; $i < $num_subjects; $i++){

              $subjects_first_term_score[$i]=$row[$subject_total[$i]];

              //$con->query("UPDATE `$res_id` SET `$subjects_first_term[$x]`='' ");


            }
          }
        }
      }



      
      for ($i=0; $i < $num_subjects; $i++) { 
        $sub_total[$i]=$s_total[$x][$i];
      }
      

      for ($i=0; $i < $num_subjects; $i++) { 
        
        $cumulative[$i]=($subjects_first_term_score[$i] + $sub_total[$i])/2;


        $res_id=str_replace("first","second",$res_id);
        $con->query("UPDATE `$res_id` SET `$subjects_first_term[$i]`='$subjects_first_term_score[$i]',
                    `$subjects_second_term[$i]`='$subjects_second_term_score[$i]',
                    `$subjects_cumulative[$i]`='$cumulative[$i]'
                    WHERE `std_id`='$std_id[$x]'");



      }

    }
    
  }



   // add details for third term cumulative
   if (preg_match("/third/",$res_id)) {

    for ($x=0; $x < $num_students; $x++) {
     

      $res_id=str_replace("third","first",$res_id);
      $result=$con->query("SELECT * FROM `$res_id` WHERE `std_id`='$std_id[$x]'");
      if ($result) {
        if ($result->num_rows > 0) {

          while ($row=$result->fetch_assoc()) {

            for($i=0; $i < $num_subjects; $i++){

              $subjects_first_term_score[$i]=$row[$subject_total[$i]];

              //$con->query("UPDATE `$res_id` SET `$subjects_first_term[$x]`='' ");


            }
          }
        }
      }



      $res_id=str_replace("first","second",$res_id);
      $result=$con->query("SELECT * FROM `$res_id` WHERE `std_id`='$std_id[$x]'");
      if ($result) {
        if ($result->num_rows > 0) {

          while ($row=$result->fetch_assoc()) {

            for($i=0; $i < $num_subjects; $i++){

              $subjects_second_term_score[$i]=$row[$subject_total[$i]];

              
            }
          }
        }
      }


      for ($i=0; $i < $num_subjects; $i++) { 
        $sub_total[$i]=$s_total[$x][$i];
      }
      

      for ($i=0; $i < $num_subjects; $i++) { 
        
        $cumulative[$i]=($subjects_first_term_score[$i] + $subjects_second_term_score[$i] + $sub_total[$i])/3;


        $res_id=str_replace("second","third",$res_id);
        $con->query("UPDATE `$res_id` SET `$subjects_first_term[$i]`='$subjects_first_term_score[$i]',
                    `$subjects_second_term[$i]`='$subjects_second_term_score[$i]',
                    `$subjects_cumulative[$i]`='$cumulative[$i]'
                    WHERE `std_id`='$std_id[$x]'");



      }

    }
    
  }




} else {
  echo "Error ".$con->error;
} 

echo "<div>Result computation completed successfully</div>";

echo "<div align='center'><b>Results for ".strtoupper($class)." ".strtoupper($arm)." for ".strtoupper($term)." term $session academic session</b></div>
      <p>
      <table border='0' cellpadding='0' class='data'>";
for ($i=0; $i < $num_students; $i++) {


  echo "  <tr>
            <td>".$surname[$i].", ".$othernames[$i]."</td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              <a href='view_detailed_result(copy).php?uid=$uid[$i]&class=$class&arm=$arm&result_id=$res_id' class='btn btn-success' target='_blank'>View Detailed Result</a></td>
          </tr>";

}

echo "</table>
      <div style='margin-top:30px;'>
        <a href='javascript:history.back();' class='btn btn-warning'>Back</a>
      </div> 
      ";

$con->close();
?>
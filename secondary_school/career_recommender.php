<?php

/* $result = $con->query("SHOW TABLES IN `dmc` LIKE ='res_id_%'");
if ($result) {
  $num_of_results = $result->num_rows;
  if ($num_of_results > 0) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      
    }
  }
} */

require_once("connect.php");
include_once("head.php");
//include_once("sanitize.php");


$msg=array();

if (isset($_POST['submit'])) {
  
  $std_id=$_REQUEST['std_id'];
  $std_name=$_REQUEST['full_name'];

  
 // $std_id=(int)($_SESSION['std_id']);
// intval()

  // get student details
  $result = $con->query("SELECT * FROM `student`s JOIN `student_class`sc
                         ON sc.`std_id`=s.`std_id` WHERE s.`std_id`='$std_id'");
    
    if($result){
        while($row = $result->fetch_array()){

           /*  $surname = $row['surname'];
            $othernames =  $row['othernames'];
            $full_name = $surname.", ".$othernames; */
            $reg_no = $row['student_reg_no'];			
            $std_class = $row['class'];			
            $std_arm = $row['arm'];			
            $std_specialization = $row['specialization'];			
        }
          
    }

    echo "<div class='container'>
          <h2>Student Career Recommendation page</h2>
          <div class='panel panel-default' style='margin:40px 0;'>
            <div class='panel-heading'><b>Student Details</b></div>
            <div class='panel-body'>
              <div style='font-weight:bold;'>Name: <b style='color:red;'>".$std_name."</b></div>
              <div style='font-weight:bold;'>Reg. No.: <b style='color:red;'>".$reg_no."</b></div>
              <div style='font-weight:bold;'>Current Class: <b style='color:red;'>".strtoupper($std_class)." ".strtoupper($std_arm)."</b></div>
            </div>
          </div>";

  // prepare subjects
  $class_list_junior = ["jss 1","jss 2","jss 3"];
  $class_list_senior = ["ss 1","ss 2","ss 3"];

  // compute for junior class  
  if ($std_class == "jss 1" || $std_class == "jss 2" || $std_class == "jss 3") {
    
    for ($i=0; $i < count($class_list_junior); $i++) { 
      
      $get_subs = $con->query("SELECT * FROM `$class_list_junior[$i]` ORDER BY `subjects` ASC");
      
      if($get_subs){
          $no_of_subs = $get_subs->num_rows;
          $x=0;
          while($row = $get_subs->fetch_array()){
            $subjects = $row['subjects'];
            
            if (!$x == 0){
              if(!array_search($subjects,$subjects_junior_orig)) {
              $subjects_junior_orig[$x] = $row['subjects'];
              $subjects_junior[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $subjects_junior_orig[$x]));
              $subjects_junior_total[$x] = $subjects_junior[$x]."_total";
              $subjects_junior_orig[$x] = ucwords(strtolower($subjects_junior_orig[$x]));			
              
              $x++;
              }
            }else{
              $subjects_junior_orig[$x] = $row['subjects'];
              $subjects_junior[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $subjects_junior_orig[$x]));
              $subjects_junior_total[$x] = $subjects_junior[$x]."_total";
              $subjects_junior_orig[$x] = ucwords(strtolower($subjects_junior_orig[$x]));			
              
              $x++;
            }
            
  
          }
        }
        
      }

      // get available result sheets
      $result=$con->query("SELECT * FROM `existing_result_sheets`");
      if ($result) {
        $no_of_results=$result->num_rows;
        if ($no_of_results > 0) {
          while ($row=$result->fetch_assoc()) {
            $avail_results[]=$row['result_id'];
          }
        }
      }
      
      // get term and session details
      $total_score=array();
      $result_found = 0;  // used to hold the number of results student name was found on
      for ($i=0; $i < $no_of_results; $i++) {     

        // get student record from available result sheets    
        $result=$con->query("SELECT * FROM `$avail_results[$i]` WHERE `std_id`='$std_id'");
        if ($result) {
          if ($result->num_rows > 0) {
            $result_found ++;
            while ($row = $result->fetch_assoc()) {

              for ($x=0; $x < $no_of_subs; $x++) {

                if (array_key_exists($subjects_junior_orig[$x],$total_score)) {              
                  $total_score[$subjects_junior_orig[$x]]+=$row[$subjects_junior_total[$x]];
                }else{
                  $total_score[$subjects_junior_orig[$x]]=$row[$subjects_junior_total[$x]];
                }
              }
            }
          }
        }
      
      }

      // standardise the scores to 100
      $arts = array();
      $science = array();
      $commercial = array();
      foreach ($total_score as $key => $value) {
        $total_score[$key] = $value/$result_found;

        // compare the subjects with the ones in the pre-defined lists
        if (in_array(strtolower($key),['mathematics','maths'])) {
          $maths = $total_score[$key];
          $science['maths'] = $maths;
        }elseif (in_array(strtolower($key),['ict','computer','data management','information & comm. tech.'])) {
          $computer = $total_score[$key];
          $science['computer'] = $computer;
        }elseif (in_array(strtolower($key),['christian rel. knowledge','crk','crs','irs'])) {
          $crs = $total_score[$key];
          $arts['crs'] = $crs;
        }elseif (in_array(strtolower($key),['creative arts','fine arts'])) {
          $creative_arts = $total_score[$key];
          $arts['creative_arts'] = $creative_arts;
        }elseif (in_array(strtolower($key),['agric','agric science','agricultural science'])) {
          $agric = $total_score[$key];
          $science['agric'] = $agric;
        }elseif (in_array(strtolower($key),['lit. in english','literature','literature in english'])) {
          $literature = $total_score[$key];
          $arts['literature'] = $literature;
        }elseif (in_array(strtolower($key),['english','english language'])) {
          $english = $total_score[$key];
          $arts['english'] = $english;
        }elseif (in_array(strtolower($key),['basic science'])) {
          $basic_science = $total_score[$key];
          $science['basic_science'] = $basic_science;
        }elseif (in_array(strtolower($key),['basic technology'])) {
          $basic_tech = $total_score[$key];
          $science['basic_tech'] = $basic_tech;
        }elseif (in_array(strtolower($key),['phe','physical and health education','physical & health education','physical & health edu.','phy. & health edu.'])) {
          $phe = $total_score[$key];
          $arts['phe'] = $phe;
        }elseif (in_array(strtolower($key),['economics'])) {
          $economics = $total_score[$key];
          $commercial['economics'] = $economics;
        }elseif (in_array(strtolower($key),['home economics'])) {
          $home_economics = $total_score[$key];
          $commercial['home_economics'] = $home_economics;
        }elseif (in_array(strtolower($key),['business studies','business stud.'])) {
          $business_studies = $total_score[$key];
          $commercial['business_studies'] = $business_studies;
        }elseif (in_array(strtolower($key),['social studies'])) {
          $social_studies = $total_score[$key];
          $arts['social_studies'] = $social_studies;
        }elseif (in_array(strtolower($key),['french'])) {
          $french = $total_score[$key];
          $arts['french'] = $french;
        }elseif (in_array(strtolower($key),['civic education','civic'])) {
          $civic = $total_score[$key];
          $arts['civic'] = $civic;
        }
      }

      

      // recommend career
      $science = array_sum($science)/count($science); 
      $commercial = array_sum($commercial)/count($commercial);
      $arts = array_sum($arts)/count($arts);

      //echo "science ".$science."commercial ".$commercial."arts ".$arts;
      if ($science > $commercial && $science > $arts) {
        echo "<div style='color:red;font-weight:bolder;'>We recommend you take a course in science </div>";
      }elseif ($arts > $commercial && $arts > $science) {
        echo "<div style='color:red;font-weight:bolder;'>We recommend you take a course in the arts </div>";
      }elseif ($commercial > $arts && $commercial > $science) {
        echo "<div style='color:red;font-weight:bolder;'>We recommend you take a course in the commercial </div>";
      }


      //echo "<pre>".print_r($total_score)."</pre>";
      $x=['Science','Arts','Commercial'];
      $y=[$science,$arts,$commercial];
      $x=json_encode($x);
      $y=json_encode($y);
      $title="Student Career Recommender Chart";
      echo("<div style='margin-top:50px;'><img src='show_graph.php?x=$x&y=$y&title=$title' /></div>");
  
  }









  // compute for senior class
  if ($std_class == "ss 1" || $std_class == "ss 2" || $std_class == "ss 3") {
    
    for ($i=0; $i < count($class_list_senior); $i++) { 
      
      $get_subs = $con->query("SELECT * FROM `$class_list_senior[$i]` ORDER BY `subjects` ASC");
      
      if($get_subs){
        $no_of_subs = $get_subs->num_rows;
        $x=0;
        while($row = $get_subs->fetch_array()){
          $subjects = $row['subjects'];
          
          if (!$x == 0){
            if(!array_search($subjects,$subjects_senior_orig)) {
            $subjects_senior_orig[$x] = $row['subjects'];
            $subjects_senior[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $subjects_senior_orig[$x]));
            $subjects_senior_total[$x] = $subjects_senior[$x]."_total";
            $subjects_senior_orig[$x] = ucwords(strtolower($subjects_senior_orig[$x]));			
            
            $x++;
            }
          }else{
            $subjects_senior_orig[$x] = $row['subjects'];
            $subjects_senior[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $subjects_senior_orig[$x]));
            $subjects_senior_total[$x] = $subjects_senior[$x]."_total";
            $subjects_senior_orig[$x] = ucwords(strtolower($subjects_senior_orig[$x]));			
            
            $x++;
          }
          

        }
      }
        
    }

      // get available result sheets
      $result=$con->query("SELECT * FROM `existing_result_sheets`");
      if ($result) {
        $no_of_results=$result->num_rows;
        if ($no_of_results > 0) {
          while ($row=$result->fetch_assoc()) {
            $avail_results[]=$row['result_id'];
          }
        }
      }
      
      // get term and session details
      $total_score=array();
      $result_found = 0;
      for ($i=0; $i < $no_of_results; $i++) {     
          // used to hold the number of results student name was found on

        // get student record from available result sheets    
        $result=$con->query("SELECT * FROM `$avail_results[$i]` WHERE `std_id`='$std_id'");
        if ($result) {
          if ($result->num_rows > 0) {
            $result_found ++;
            while ($row = $result->fetch_assoc()) {

              for ($x=0; $x < $no_of_subs; $x++) {

                if (array_key_exists($subjects_senior_orig[$x],$total_score)) {              
                  $total_score[$subjects_senior_orig[$x]]+=$row[$subjects_senior_total[$x]];
                }else{
                  $total_score[$subjects_senior_orig[$x]]=$row[$subjects_senior_total[$x]];
                }
              }
            }
          }
        }
      
      }

      // standardise the scores to 100
      $arts = array();
      $science = array();
      $commercial = array();
      foreach ($total_score as $key => $value) {
        $total_score[$key] = $value/$result_found;

        // compare the subjects with the ones in the pre-defined lists
          // science
        if ($std_specialization == "science") {
          if (in_array(strtolower($key),['mathematics','maths'])) {
            $maths = $total_score[$key];
            $science['maths'] = $maths;
          }elseif (in_array(strtolower($key),['further mathematics','further maths','f. maths','advanced mathematics'])) {
            $further_mathematics = $total_score[$key];
            $science['further_mathematics'] = $further_mathematics;
          }elseif (in_array(strtolower($key),['ict','computer','data management','information & comm. tech.','data processing'])) {
            $computer = $total_score[$key];
            $science['computer'] = $computer;
          }elseif (in_array(strtolower($key),['agric','agric science','agricultural science'])) {
            $agric = $total_score[$key];
            $science['agric'] = $agric;
          }elseif (in_array(strtolower($key),['physics'])) {
            $physics = $total_score[$key];
            $science['physics'] = $physics;
          }elseif (in_array(strtolower($key),['chemistry'])) {
            $chemistry = $total_score[$key];
            $science['chemistry'] = $chemistry;
          }elseif (in_array(strtolower($key),['biology'])) {
            $biology = $total_score[$key];
            $science['biology'] = $biology;
          }
          // arts
        }elseif($std_specialization == "arts"){
          if (in_array(strtolower($key),['christian rel. knowledge','crk','crs','irs'])) {
            $crs = $total_score[$key];
            $arts['crs'] = $crs;
          }elseif (in_array(strtolower($key),['creative arts','fine arts'])) {
            $creative_arts = $total_score[$key];
            $arts['creative_arts'] = $creative_arts;
          }elseif (in_array(strtolower($key),['lit. in english','literature','literature in english'])) {
            $literature = $total_score[$key];
            $arts['literature'] = $literature;
          }elseif (in_array(strtolower($key),['english','english language'])) {
            $english = $total_score[$key];
            $arts['english'] = $english;
          }elseif (in_array(strtolower($key),['phe','physical and health education','physical & health education','physical & health edu.','phy. & health edu.'])) {
            $phe = $total_score[$key];
            $arts['phe'] = $phe;
          }elseif (in_array(strtolower($key),['government'])) {
            $government = $total_score[$key];
            $arts['government'] = $government;
          }elseif (in_array(strtolower($key),['french'])) {
            $french = $total_score[$key];
            $arts['french'] = $french;
          }elseif (in_array(strtolower($key),['civic education','civic'])) {
            $civic = $total_score[$key];
            $arts['civic'] = $civic;
          }
          // commercial
        }elseif ($std_specialization == "commercial") {
          if (in_array(strtolower($key),['economics'])) {
            $economics = $total_score[$key];
            $commercial['economics'] = $economics;
          }elseif (in_array(strtolower($key),['home economics'])) {
            $home_economics = $total_score[$key];
            $commercial['home_economics'] = $home_economics;
          }elseif (in_array(strtolower($key),['commerce'])) {
            $commerce = $total_score[$key];
            $commercial['commerce'] = $commerce;
          }elseif (in_array(strtolower($key),['accounting','account'])) {
            $accounting = $total_score[$key];
            $arts['accounting'] = $accounting;
          }
        }
        
      }

      

      // recommend career
        // science
        if ($std_specialization == "science") {
          
          asort($science);
          // engineering
          if(in_array("further_mathematics",$science) && in_array("mathematics",$science)){
            $eng = ($science['further_mathematics'] + $science['maths'])/2;
          }elseif($science['further_mathematics']) {
            $eng = $science['further_mathematics'];
          }elseif($science['maths']) {
            $eng = $science['maths'];
          }
          $engineering = ($eng + $science['physics'] + $science['chemistry'] + $science['computer'] + $science['agric'])/5;
          if ($engineering >= 80 ) {
            $course['Engineering'] = $engineering;
          }
          /* $elect_eng = ($eng + $science['physics'])/2;
          $pet_eng = ($eng + $science['physics'])/2;
          $civil_eng = ($eng + $science['physics'])/2;
          $mech_eng = ($eng + $science['physics'])/2;
          $chem_eng = ($eng + $science['chemistry'])/2;
          $computer_eng = ($eng + $science['computer'])/2;
          $agric_eng = ($eng + $science['agric'])/2;
          $food_eng = ($eng + $science['agric'])/2; */
    
          // pure and applied sciences
          $medical_sciences = ($science['biology'] + $science['chemistry'])/2;
          if ($medical_sciences >= 80) {        
            $course['Medical Sciences'] = $medical_sciences;              
          }
    
          // physical and applied sciences
          if ($eng >= 80 ) {
            $course['Maths and Statistics'] = $eng;
          }
          if ($science['physics'] >= 80 ) {
            $course['Physics'] = $science['physics'];
          }
          if ($science['chemistry'] >= 80 ) {
            $course['Chemistry'] = $science['chemistry'];
          }
          if ($science['biology'] >= 80 ) {
            $course['Biology'] = $science['biology'];
          }

          // arts
        }elseif ($std_specialization == "arts") {

          asort($arts);
          $art = ($arts['english'] + $arts['literature'])/2;

        // commercial
        }elseif ($std_specialization == "commercial") {         
          
          asort($commercial);
          $art = ($commercial['commerce'] + $commercial['accounting'] + $commercial['economics'])/3;
          if ($commercial['accounting'] >= 80) {            
            $course["Accounting"] = $art;
          }
          if ($commercial['accounting'] >= 70) {            
            $course["Banking and Finance"] = $commercial['accounting'];
          }
          
        }

        if (!empty($course)) {
          echo "<div style='color:red;font-weight:bolder;'>Based on your academic performance, we recommend you take a course in: ";
          for ($i=0; $i < count($course); $i++) { 
            echo "<pre>".$course[$i]."</pre>";
          }
          echo "</div>";
        }else {
          echo "<div style='color:red;font-weight:bolder;'>Based on your academic performance, we are sorry to inform you that your performance is low. Hence, we cannot at this time recommend a career for you.
                <br/>Put in more effort in your academics to improve. </div>";
        }
        

      // send to plotter
      /* $x=['Electrical','Petroleum',
          'Civil','Agricultural',
          'Chemical','Computer',
          'Food','Mechanical'];
      $y=[$elect_eng,$pet_eng,$civil_eng,$agric_eng,$chem_eng,$computer_eng,$food_eng,$mech_eng];
      $x=json_encode($x);
      $y=json_encode($y);
      $title="Student Career Recommender Chart";
      echo("<img src='show_graph.php?x=$x&y=$y&title=$title' />");
   */
  

      //echo "<pre< ".print_r($science)."</pre> ";
      /* $science = array_sum($science)/count($science); 
      $commercial = array_sum($commercial)/count($commercial);
      $arts = array_sum($arts)/count($arts);
      

      
      if ($science > $commercial && $science > $arts) {
        echo "We recommend you take a course in science ";
      }elseif ($arts > $commercial && $arts > $science) {
        echo "We recommend you take a course in the arts";
      }elseif ($commercial > $arts && $commercial > $science) {
        echo "We recommend you take a course in the commercial";
      }*/


      //echo "<pre>".print_r($total_score)."</pre>";
  }

  echo "<div style='margin:100px 0;'>
        <div style='font-weight:bold;'>Notice:</div>
          <div style='text-align:justify;'>
            <p>
              Our recommendation is based on your academic performance and is in no way a decision you are bound to accept.
            </p>
            <p>
              You are free to discard our recommendation and pursue a careeer of your choice (that is if you have one already).<br/>However, following our recommendation is not bad since it reflects your current and future ability in various courses.
            </p>
            <p style='font-weight:bolder;'>
              By this notice, we disclaim any liability that may be caused by following our recommendation.
            </p> 
            <p>
              Thanks.
            </p>
          </div>
        </div>";


  echo "</div>";
  exit();
  
}


?>


<div class='container'>
  <h2 align='center'>Student Career Recommender</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <!-- <form method='POST' action=''> -->
    <div class='form-control' style="margin-bottom:50px;">Search database for student
      <div class='btn-group' style='width:100%;'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="Enter student name" oninput="javascript:
          get_data('search_student.php?name='+this.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div>
  


  <div class='panel panel-default'>
    <div class="panel-heading" style="margin-bottom:50px;">Or search by student reg. no.</div>
    <div class='panel-body'>
      <div class="form-group">Search database for student
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="Enter student reg. no." oninput="javascript:
        get_data('search_student_with_regno.php?regno='+this.value,'display_result');">
      </div>
    </div>
  </div>
      
    

  <div id='display_result'></div>
  

  <a href='back.php' class='btn btn-warning form-control'>Back</a>
   
</div>


<?php

include_once("foot.php");

?>

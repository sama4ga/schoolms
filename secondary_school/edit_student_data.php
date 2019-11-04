<?php
session_start();
require_once("connect.php");
include("head.php");

include_once("auth.php");
if ($priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

include("sanitize.php");

$msg=array();

$std_id=$_GET['id'];



if (isset($_POST['submit'])) {

  $former_class=$_REQUEST['former_class'];
  $former_arm=$_REQUEST['former_arm'];
  $student_reg_no=$_REQUEST['std_reg_no'];

  $surname=sanitize($_POST['surname']);
  $othernames=sanitize($_POST['othernames']);
  $gender=sanitize($_POST['gender']);
  $dob=sanitize($_POST['dob']);
  $nationality=sanitize($_POST['nationality']);
  $stateOfOrigin=sanitize($_POST['stateOfOrigin']);
  $lgaOfOrigin=sanitize($_POST['lgaOfOrigin']);
  $health_issue_descr=sanitize($_POST['health_issue_descr']);
  $phone1=sanitize($_POST['phone1']);
  $phone2=sanitize($_POST['phone2']);
  $email=sanitize($_POST['email']);
  $residential_address=sanitize($_POST['residential_address']);
  $home_address=sanitize($_POST['home_address']);
  $disability=sanitize($_POST['disability']);
  $health_issue=sanitize($_POST['health_issue']);
  $genotype=sanitize($_POST['genotype']);
  $blood_group=sanitize($_POST['blood_group']);
  $family_doctor=sanitize($_POST['family_doctor']);
  $family_hospital=sanitize($_POST['family_hospital']);
  $family_hospital_address=sanitize($_POST['family_hospital_address']);
  $family_doctor_no=sanitize($_POST['family_doctor_no']);
  $class=sanitize($_POST['class']);
  //$session=sanitize($_POST['session']);
  $arm=sanitize($_POST['arm']);
  $specialization=sanitize($_POST['specialization']);
  $previous_school=sanitize($_POST['previous_school']);
  $sport_group=sanitize($_POST['sport_group']);
  $pg=sanitize($_POST['parent/guardian']);




  $allowedExtensions = array("jpg","jpeg");
  $documents=['birth_certificate','medical_fitness','medical_report','certificate_of_origin','passport'];
  
  for ($i=0; $i < count($documents); $i++) { 
    
    $file=$_FILES[$documents[$i]]['name'];
    $file_alt=$_POST[$documents[$i]."_alt"];
    $path=preg_replace("/[^A-Za-z]/"," ",$documents[$i]);

    if ($_FILES[$documents[$i]]['tmp_name'] =="" && $file_alt ==""){
      
      $doc[$documents[$i]]="";

    }elseif($_FILES[$documents[$i]]['tmp_name'] =="" && $file_alt !=""){
      $doc[$documents[$i]]=$file_alt;

    }else{

      if (!in_array(pathinfo(basename($file),PATHINFO_EXTENSION),$allowedExtensions)) {
            
          $msg[]=$documents[$i]." file type is not accepted.";
        
        }else {

          if (file_exists($file_alt)) {
            unlink($file_alt);
          }

          $target_path = "data/".$path."/";
          
          $target_path = $target_path."student ".basename($file); 

          move_uploaded_file($_FILES[$documents[$i]]['tmp_name'], $target_path) ;
          
          $filename = $target_path;
            $width = 200;
            $height = 300;
          list($width_orig, $height_orig) = getimagesize($filename);
          /* $ratio_orig = $width_orig/$height_orig;
          
          if ($width/$height > $ratio_orig){
            $width = $height*$ratio_orig;
          }else{
            $height = $width/$ratio_orig;
          } */
            $image_p = imagecreatetruecolor($width, $height);
            $image = imagecreatefromjpeg($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            $student_reg_no = str_replace("/","_",$student_reg_no);
          $image_name = "data/".$path."/".$student_reg_no.".jpg";	

          imagejpeg($image_p, $image_name, 100);


          unlink("$target_path");
      }
        $doc[$documents[$i]]=$image_name; 
    }    
    
  }

  //var_dump($doc);
  
  $date_admitted=date("Y-m-d",time());

  if (empty($msg)) {

    $result=$con->query("UPDATE `student` SET `surname`='$surname',`othernames`='$othernames',`gender`='$gender',
                      `dob`='$dob',`nationality`='$nationality',`state_of_origin`='$stateOfOrigin',
                      `lga_of_origin`='$lgaOfOrigin',`parent/guardian`='$pg',`phone 1`='$phone1',`phone 2`='$phone2',
                      `email`='$email',`residential_address`='$residential_address',`home_address`='$home_address',
                      `genotype`='$genotype',`blood_group`='$blood_group',`disability`='$disability',
                      `health_issue`='$health_issue',`health_issue_descr`='$health_issue_descr',
                      `medical_fitness`='".$doc['medical_fitness']."',`medical_report`='".$doc['medical_report']."',
                      `birth_certificate`='".$doc['birth_certificate']."',`certificate_of_origin`='".$doc['certificate_of_origin']."',
                      `family_doctor`='$family_doctor',`family_hospital`='$family_hospital',
                      `family_hospital_address`='$family_hospital_address',`family_doctor_no`='$family_doctor_no',
                      `passport`='".$doc['passport']."',`specialization`='$specialization',`previous_school`='$previous_school'
                      WHERE `std_id`='$std_id'");

  
    if ($result) {


      $result=$con->query("UPDATE `student_class` SET `class`='$class',`arm`='$arm',`sport_group`='$sport_group'
                          WHERE `std_id`='$std_id'");


      if ($former_class != $class || $former_arm != $arm) {
        
        // add student data to the new class attendance and result sheet
        $session=strtolower($_SESSION['session']);
        $term=strtolower($_SESSION['term']);
        $session_format=str_replace("/","_",$session);
  
        $atd_id="atd_student_".$session_format."_".$term."_".$class."_".$arm;
        if ($con->query("DESCRIBE `$atd_id`")) {
          $result=$con->query("ALTER TABLE `$atd_id` ADD `$std_id` VARCHAR(2) NOT NULL DEFAULT '0'");
          if (!$result) {
            $msg[]="could not add record to attendance sheet ".$con->error;
          }
        }
  
       
        $res_id=str_replace("atd_student","res_id",$atd_id);
        if ($con->query("DESCRIBE `$res_id`")) {
          $result=$con->query("INSERT INTO `$res_id`(`std_id`,`surname`,`othernames`)
                              VALUES('$std_id','$surname','$othernames')");

          $class_admitted = $class;
          include_once("add_name_in_resultsheet.php");
          
          if (!$result) {
            $msg[]="could not add record to result sheet ".$con->error;
          }
        }
          
  
  
        // remove student data from the previous class attendance and result sheet
        $atd_id="atd_student_".$session_format."_".$term."_".$former_class."_".$former_arm;
        if ($con->query("DESCRIBE `$atd_id`")) {
          $result=$con->query("ALTER TABLE `$atd_id` DROP `$std_id`");
          if (!$result) {
            $msg[]="could not delete record from attendance sheet ".$con->error;
          }
        }
  
  
        $res_id=str_replace("atd_student","res_id",$atd_id);
        if ($con->query("DESCRIBE `$res_id`")) {
          $result=$con->query("DELETE FROM `$res_id` WHERE `std_id`='$std_id'");
          if (!$result) {
            $msg[]="could not delete record from result sheet ".$con->error;
          }
        }

      }
        
      
      if (empty($msg)) {
        
        $msg[]="Update successful";

      }


    }else {
      $msg[]="Could not update student record ".$con->error;
    }
  }
  
}




$result=$con->query("SELECT * FROM `student` s 
                     JOIN `student_class` sc 
                     ON s.`std_id`=sc.`std_id`
                     WHERE s.`std_id`='$std_id`'");

if ($result) {

  if ($result->num_rows > 0) {

    while ($row=$result->fetch_assoc()) { //var_dump($row);

      $surname=$row['surname'];
      $othernames=$row['othernames'];
      $gender=$row['gender'];
      $dob=$row['dob'];
      $nationality=$row['nationality'];
      $stateOfOrigin=$row['state_of_origin'];
      $lgaOfOrigin=$row['lga_of_origin'];
      $health_issue_descr=$row['health_issue_descr'];
      $phone1=$row['Phone 1'];
      $phone2=$row['phone 2'];
      $email=$row['email'];
      $residential_address=$row['residential_address'];
      $home_address=$row['home_address'];
      $disability=$row['disability'];
      $health_issue=$row['health_issue'];
      $genotype=$row['genotype'];
      $blood_group=$row['blood_group'];
      $family_doctor=$row['family_doctor'];
      $family_hospital=$row['family_hospital'];
      $family_hospital_address=$row['family_hospital_address'];
      $family_doctor_no=$row['family_doctor_no'];
      $class=$row['class'];
      //$session=$row['session'];
      $arm=$row['arm'];
      $specialization=$row['specialization'];
      $previous_school=$row['previous_school'];
      $sport_group=$row['sport_group'];
      $pg=$row['Parent/Guardian'];
      $birth_certificate=$row['birth_certificate'];
      $medical_fitness=$row['medical_fitness'];
      $medical_report=$row['medical_report'];
      $certificate_of_origin=$row['certificate_of_origin'];
      $passport=$row['passport'];
      $student_reg_no=$row['student_reg_no'];

     }
  }
}else{
  $msg[]="Error occured ".$con->error;
}


?>

<div class="container"  style="margin-bottom:25px;">
  <h3>Edit Student Data Portal</h3>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$std_id&former_class=$class&former_arm=$arm&std_reg_no=$student_reg_no"; ?>" enctype="multipart/form-data">
  
  <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>


    <fieldset><legend>Personal Details</legend>
      
      <div style="display: flex;">



        <div style="width: 80%;">

          <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control" value='<?php echo $surname ?>'>
          </div>

          <div class="form-group">
            <label>Othernames</label>
            <input type="text" name="othernames" class="form-control" value='<?php echo $othernames; ?>'>
          </div>


          <div class="form-group"> 
            <label>Gender</label>
            <select name="gender" class="form-control" >
              <?php
                switch ($gender) {
                  case 'Male':
                    echo "<option value='default'>Select your gender</option>
                          <option value='Male' selected >Male</option>
                          <option value='Female'>Female</option>";
                    break;
                  case 'Female':
                    echo "<option value='default'>Select your gender</option>
                          <option value='Male'  >Male</option>
                          <option value='Female' selected >Female</option>";
                    break;
                  
                  default:
                    echo "<option value='default'>Select your gender</option>
                          <option value='Male'>Male</option>
                          <option value='Female'>Female</option>";
                    break;
                }

              ?>
            </select>
          </div>


          <div class="form-group">
            <label>Date of birth</label>
            <input type="date" name="dob" class="form-control" value='<?php echo $dob; ?>'>
          </div>


          <div class="form-group">
            <label>Nationality</label>
            <input type="text" name="nationality" class="form-control" value='<?php echo $nationality; ?>'>
          </div>


          <div class="form-group">
            <label>State of Origin</label>
            <input type="text" name="stateOfOrigin" class="form-control" value='<?php echo $stateOfOrigin; ?>'>
          </div>


          <div class="form-group">
            <label>LGA of Origin</label>
            <input type="text" name="lgaOfOrigin" class="form-control" value='<?php echo $lgaOfOrigin; ?>'>
          </div>


        </div>



        <div style="width: 20%;">

        <div>
          <?php  if ($passport) {
                  echo "<img src='$passport' width='100%' id='show_passport' width='100px' height='100px'>";
                }else{
                  echo "<img src='../images/passport.png' id='show_passport' width='100px' height='100px'>";
                }
                  echo "<input type='hidden' value='$passport' name='passport_alt'>";
          ?>
        </div>          
          <input type="file" name="passport" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control" style="font-size:xx-small;" id='passport' onchange='load_passport();'>
        </div>



      </div>
    </fieldset>




    <fieldset><legend>Contact Details</legend>


      <div class="form-group">
        <label>Parent/Guardian</label>
        <input type="text" name="parent/guardian" class="form-control" value='<?php echo $pg; ?>'>
      </div>


      <div class="form-group">
        <label>Phone 1</label>
        <input type="tel" name="phone1" class="form-control" value='<?php echo $phone1; ?>'>
      </div>


      <div class="form-group">
        <label>Phone 2</label>
        <input type="tel" name="phone2" class="form-control" value='<?php echo $phone2; ?>'>
      </div>


      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value='<?php echo $email; ?>'>
      </div>


      <div class="form-group">
        <label>Residential Address</label>
        <textarea name="residential_address" class="form-control" cols="15" rows="5"><?php echo $residential_address; ?></textarea>
      </div>


      <div class="form-group">
        <label>Home Address</label>
        <textarea name="home_address" class="form-control" cols="15" rows="5"><?php echo $home_address; ?></textarea>
      </div>


    </fieldset>



    <fieldset><legend>Medical Details</legend>


      <div class="form-group">
        <label>Disability</label>
        <input type="text" name="disability" class="form-control" value='<?php echo $disability; ?>'>
      </div>


      <div class="form-group">
        <label>Health Issue</label>
        <input type="text" name="health_issue" class="form-control" value='<?php echo $health_issue; ?>'>
      </div>


      <div class="form-group">
        <label>Description of Health issue</label>
        <textarea name="health_issue_descr" class="form-control" cols="15" rows="5"><?php echo $health_issue_descr; ?></textarea>
      </div>


      <div class="form-group">
        <label>Genotype</label>
        <select name="genotype" class="form-control">
          <?php
            switch ($genotype) {
              case 'AA':
                echo "<option value='default'>select your genotype</option>
                      <option value='AA'selected >AA</option>
                      <option value='AS'>AS</option>
                      <option value='SS'>SS</option>";
                break;
              case 'AS':
                echo "<option value='default'>select your genotype</option>
                      <option value='AA'>AA</option>
                      <option value='AS' selected >AS</option>
                      <option value='SS'>SS</option>";
                break;
              case 'SS':
                echo "<option value='default'>select your genotype</option>
                      <option value='AA'>AA</option>
                      <option value='AS'>AS</option>
                      <option value='SS' selected >SS</option>";
                break;
              default:
                echo "<option value='default' selected>select your genotype</option>
                      <option value='AA'>AA</option>
                      <option value='AS'>AS</option>
                      <option value='SS'>SS</option>";
                break;
            }

          ?>
        </select>
      </div>


      <div class="form-group">
        <label>Blood Group</label>
        <select name='blood_group' class='form-control'>
          <?php
            switch ($blood_group) {
              case 'A+':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+' selected >A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'A-':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-' selected >A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'B+':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+' selected >B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'B-':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-' selected >B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'AB+':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+' selected >AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'AB-':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-' selected >AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'O+':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+' selected >O+</option>
                      <option value='O-'>O-</option>";
              break;
              case 'O-':
                echo "<option value='default'>select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-' selected >O-</option>";
              break;          
              default:
                echo "<option value='default' selected >select your blood group</option>
                      <option value='A+'>A+</option>
                      <option value='A-'>A-</option>
                      <option value='B+'>B+</option>
                      <option value='B-'>B-</option>
                      <option value='AB+'>AB+</option>
                      <option value='AB-'>AB-</option>
                      <option value='O+'>O+</option>
                      <option value='O-'>O-</option>";
                break;
            }

          ?>
        </select>
      </div>


    </fieldset>



    <fieldset><legend>Upload Documents</legend>

      <div style="color:red;"><b>Note:</b> Loading a new document will override the existing one (if any)</div>

      <div class="form-group">
        <label>Birth Certificate</label>
        <div style='display:flex;'>
          <input type="file" name="birth_certificate" accept="Images(.jpeg,.jpg,.png)" class="form-control">
          <?php  
            if ($birth_certificate) {
              echo "<img src='../images/do.jpg' width='52' height='52' title='Birth certificate has been uploaded before'>";
            }
            echo "<input type='hidden' value='$birth_certificate' name='birth_certificate_alt'>";
          ?>
        </div>
      </div>


      <div class="form-group">
        <label>Certificate of Origin</label>
        <div style='display:flex;'>
          <input type="file" name="certificate_of_origin" accept="Images(.jpeg,.jpg,.png)" class="form-control">
          <?php  
            if ($certificate_of_origin) {
              echo "<img src='../images/do.jpg' width='52' height='52' title='Certificate of origin has been uploaded before'>";
            }
            echo "<input type='hidden' value='$certificate_of_origin' name='certificate_of_origin_alt' >";
          ?>
        </div>
      </div>


      <div class="form-group">
        <label>Medical Certificate of fitness</label>
        <div style='display:flex;'>
          <input type="file" name="medical_fitness" accept="Images(.jpeg,.jpg,.png)" class="form-control">
          <?php  
            if ($medical_fitness) {
              echo "<img src='../images/do.jpg' width='52' height='52' title='Medical certificate of fitness has been uploaded before'>";
            }
            echo "<input type='hidden' value='$medical_fitness' name='medical_fitness_alt' >";
          ?>
        </div>
      </div>


      <div class="form-group">
        <label>Medical Report</label>
        <div style='display:flex;'>
          <input type="file" name="medical_report" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
          <?php  
            if ($medical_report) {
              echo "<img src='../images/do.jpg' width='52' height='52' title='Medical report has been uploaded before'>";
            }
            echo "<input type='hidden' value='$medical_report' name='medical_report_alt' >";
          ?>
        </div>
      </div>


    </fieldset>



    <fieldset><legend>Emergency Details</legend>


      <div class="form-group">
        <label>Family Doctor</label>
        <input type="text" name="family_doctor" class="form-control" value='<?php echo $family_doctor; ?>'>
      </div>


      <div class="form-group">
        <label>Family Hospital</label>
        <input type="text" name="family_hospital" class="form-control" value='<?php echo $family_hospital; ?>'>
      </div>


      <div class="form-group">
        <label>Family Hospital Address</label>
        <input type="text" name="family_hospital_address" class="form-control" value='<?php echo $family_hospital_address; ?>'>
      </div>


      <div class="form-group">
        <label>Family Doctor's Number</label>
        <input type="tel" name="family_doctor_no" class="form-control" value='<?php echo $family_doctor_no; ?>'>
      </div>


    </fieldset>



    <fieldset><legend>Class Details</legend>


      <div class="form-group">
        <label>Class</label>
        <select name="class" class="form-control">
          <?php
            switch ($class) {
              case 'jss 1':
                echo "<option value='jss 1' selected >JSS 1</option>
                      <option value='jss 2'>JSS 2</option>
                      <option value='jss 3'>JSS 3</option>
                      <option value='ss 1'>SS 1</option>
                      <option value='ss 2'>SS 2</option>
                      <option value='ss 3'>SS 3</option>";
                break;
              case 'jss 2':
                echo "<option value='jss 1'>JSS 1</option>
                      <option value='jss 2' selected >JSS 2</option>
                      <option value='jss 3'>JSS 3</option>
                      <option value='ss 1'>SS 1</option>
                      <option value='ss 2'>SS 2</option>
                      <option value='ss 3'>SS 3</option>";
                break;
              case 'jss 3':
                echo "<option value='jss 1' >JSS 1</option>
                      <option value='jss 2'>JSS 2</option>
                      <option value='jss 3' selected >JSS 3</option>
                      <option value='ss 1'>SS 1</option>
                      <option value='ss 2'>SS 2</option>
                      <option value='ss 3'>SS 3</option>";
                break;
              case 'ss 1':
                echo "<option value='jss 1' >JSS 1</option>
                      <option value='jss 2'>JSS 2</option>
                      <option value='jss 3'>JSS 3</option>
                      <option value='ss 1' selected >SS 1</option>
                      <option value='ss 2'>SS 2</option>
                      <option value='ss 3'>SS 3</option>";
                break;
              case 'ss 2':
                echo "<option value='jss 1'>JSS 1</option>
                      <option value='jss 2'  >JSS 2</option>
                      <option value='jss 3'>JSS 3</option>
                      <option value='ss 1'>SS 1</option>
                      <option value='ss 2' selected >SS 2</option>
                      <option value='ss 3'>SS 3</option>";
                break;
              case 'ss 3':
                echo "<option value='jss 1' >JSS 1</option>
                      <option value='jss 2'>JSS 2</option>
                      <option value='jss 3'  >JSS 3</option>
                      <option value='ss 1'>SS 1</option>
                      <option value='ss 2'>SS 2</option>
                      <option value='ss 3' selected >SS 3</option>";
                break;
              
              default:
                echo "<option value='jss 1' >JSS 1</option>
                  <option value='jss 2'>JSS 2</option>
                  <option value='jss 3'  >JSS 3</option>
                  <option value='ss 1'>SS 1</option>
                  <option value='ss 2'>SS 2</option>
                  <option value='ss 3' >SS 3</option>";
                break;
            } 
          ?>
        </select>
      </div>


      <!-- <div>
        <label>Session</label>
        <select name="session" class="form-control">
          <option value="2014/2015">2019/2020</option>
          <option value="2015/2016">2019/2020</option>
          <option value="2016/2017">2019/2020</option>
          <option value="2017/2018">2019/2020</option>
          <option value="2018/2019" selected>2018/2019</option>
          <option value="2019/2020">2019/2020</option>
          <option value="2020/2021">2020/2021</option>
          <option value="2021/2022">2021/2022</option>
          <option value="2022/2023">2022/2023</option>
          <option value="2023/2024">2023/2024</option>
          <option value="2024/2025">2024/2025</option>
          <option value="2025/2026">2025/2026</option>
        </select>
      </div> -->


      <div class="form-group">
        <label>Arm</label>
        <select name="arm" class="form-control">
        <option value="default" selected>select arm</option>
        <?php
          $result=$con->query("SELECT * FROM `arm`");
          if($result->num_rows > 0){
            while($row=$result->fetch_assoc()){
              if($row['arm']==$arm){
                echo "<option value='".$row['arm']."' selected >".strtoupper($row['arm'])."</option>";
              }else {
                echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";
              }
            }
          }

          ?>
        </select>
      </div>


      <div class="form-group">
        <label>Area of Specialization</label>
        <select name="specialization" class="form-control">
        <?php
            switch ($specialization) {
              case 'science':
                echo "<option value='default'>Choose an area of specialization</option>
                      <option value='science' selected >Science</option>
                      <option value='arts'>Arts</option>
                      <option value='commercial'>Commercial</option>";
                break;
              case 'arts':
                echo "<option value='default'>Choose an area of specialization</option>
                      <option value='science'>Science</option>
                      <option value='arts' selected >Arts</option>
                      <option value='commercial'>Commercial</option>";
                break;
              case 'commercial':
                echo "<option value='default'>Choose an area of specialization</option>
                      <option value='science'>Science</option>
                      <option value='arts'>Arts</option>
                      <option value='commercial' selected >Commercial</option>";
                break;
              default:
                echo "<option value='default' selected >Choose an area of specialization</option>
                      <option value='science'>Science</option>
                      <option value='arts'>Arts</option>
                      <option value='commercial'>Commercial</option>";
                break;
            }
          ?>
        </select>
      </div>


      <div class="form-group">
        <label>Sport Group</label>
        <select name="sport_group" class="form-control">
        <?php
            switch ($sport_group) {
              case 'blue':
                echo "<option value='default'>select sport group</option>
                      <option value='blue' selected>Blue</option>
                      <option value='white'>White</option>
                      <option value='green'>Green</option>";
              break;
              case 'white':
                echo "<option value='default'>select sport group</option>
                      <option value='blue'>Blue</option>
                      <option value='white' selected>White</option>
                      <option value='green'>Green</option>";
              break;
              case 'green':
                echo "<option value='default'>select sport group</option>
                      <option value='blue'>Blue</option>
                      <option value='white'>White</option>
                      <option value='green' selected >Green</option>";
                break;
              default:
                echo "<option value='default' selected>select sport group</option>
                      <option value='blue'>Blue</option>
                      <option value='white'>White</option>
                      <option value='green'>Green</option>";
                break;
            }
          ?>
        </select>
      </div>


      <div class="form-group">
          <label>Previous school attended (if any)</label>
          <textarea class='form-control' name='previous_school' cols='15' rows='5' value='<?php echo $previous_school; ?>'></textarea>
      </div>
    </fieldset>



    <div class="input-group">
      <input type="submit" name="submit" class="btn btn-success form-control" value="Update">
      <a href="javascript:history.back()" class="btn btn-warning form-control">Back</a>
    </div>
        
  </form>
</div>




<script>

  function load_passport() {
    var pic=document.getElementById("passport");
    var passport=document.getElementById("show_passport");

    var reader=new FileReader();

    reader.readAsDataURL(pic.files[0]);
    
    reader.onload=function(e){
      passport.src=e.target.result;
    }
  }

</script>

<?php

$con->close();
?>
<?php
session_start();
require_once("connect.php");
include("head.php");
include("sanitize.php");

$msg=array();

$staff_id=$_GET['id'];
$staff_reg_no=$_GET['reg_no'];



if (isset($_POST['submit'])) {

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
  $bank=sanitize($_POST['bank']);
  $account_no=sanitize($_POST['account_no']);
  $account_name=sanitize($_POST['account_name']);
  $name_of_nextofkin=sanitize($_POST['name_of_nextofkin']);
  $relationship_with_nextofkin=sanitize($_POST['relationship_with_nextofkin']);
  $position=sanitize($_POST['position']);
  $priviledge=sanitize($_POST['priviledge']);
  $salary=sanitize($_POST['salary']);
  //$staff_password=sanitize($_POST['staff_password']);
  $qualification=sanitize($_POST['qualification']);
  $class=sanitize($_POST['class']);  
  $arm=sanitize($_POST['arm']);
  //$status=sanitize($_POST['status']);
  $status='active';


  $allowedExtensions = array("jpg","jpeg","png");
  $documents=['cv','birth_certificate','medical_fitness','medical_report','certificate_of_origin','passport'];
  
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
            
            $target_path = $target_path."staff ".basename($file); 

            move_uploaded_file($_FILES[$documents[$i]]['tmp_name'], $target_path) ;
            $filename = $target_path;
              $width = 148;
              $height = 300;
            list($width_orig, $height_orig) = getimagesize($filename);
            $ratio_orig = $width_orig/$height_orig;
            if ($width/$height > $ratio_orig){
              $width = $height*$ratio_orig;
            }else{
              $height = $width/$ratio_orig;
            }
              $image_p = imagecreatetruecolor($width, $height);
              $image = imagecreatefromjpeg($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
              $staff_reg_no = str_replace("/","_",$staff_reg_no);
            $image_name = "data/".$path."/".$staff_reg_no.".jpg";	

            imagejpeg($image_p, $image_name, 100);


            unlink("$target_path");
        }
        $doc[$documents[$i]]=$image_name; 
    }    
    
  }

  if (empty($msg)) {
    //var_dump($doc);
  
    $date_employed=date("Y-m-d",time());

    //$cost=['cost'=> 12];
    //$hpassword=password_hash($staff_password,PASSWORD_DEFAULT,$cost);

    $class_arm=$class."_".$arm;
    $result=$con->query("UPDATE `staff` SET `surname`='$surname',`othernames`='$othernames',`gender`='$gender',
                        `dob`='$dob',`nationality`='$nationality',`state_of_origin`='$stateOfOrigin',
                        `lga_of_origin`='$lgaOfOrigin',`name_of_nextofkin`='$name_of_nextofkin',
                        `relationship_with_nextofkin`='$relationship_with_nextofkin',`phone 1`='$phone1',
                        `phone 2`='$phone2',`email`='$email',`residential_address`='$residential_address',
                        `home_address`='$home_address',`genotype`='$genotype',`blood_group`='$blood_group',
                        `disability`='$disability',`health_issue`='$health_issue',`health_issue_descr`='$health_issue_descr',
                        `medical_fitness`='".$doc['medical_fitness']."',`medical_report`='".$doc['medical_report']."',
                        `birth_certificate`='".$doc['birth_certificate']."',`certificate_of_origin`='".$doc['certificate_of_origin']."',
                        `qualification`='$qualification',`cv`='".$doc['cv']."',`status`='$status',`priviledge`='$priviledge',
                        `position`='$position',`bank`='$bank',`account_no`='$account_no',`account_name`='$account_name',`salary`='$salary',
                        `passport`='".$doc['passport']."',`class`='$class_arm'
                        WHERE `staff_id`='$staff_id'");

  
    if ($result) {

      $msg[]="Update successful";

    }else {

      $msg[]="Could not update staff ".$con->error;

    }
  }
}   




$result=$con->query("SELECT * FROM `staff` WHERE `staff_id`='$staff_id'");

if ($result) {
  
  if ($result->num_rows > 0) {
    
    while ($row=$result->fetch_assoc()) {
      
      $surname=$row['surname'];
      $othernames=$row['othernames'];
      $gender=$row['gender'];
      $dob=$row['dob'];
      $nationality=$row['nationality'];
      $stateOfOrigin=$row['state_of_origin'];
      $lgaOfOrigin=$row['lga_of_origin'];
      $health_issue_descr=$row['health_issue_descr'];
      $phone1=$row['phone 1'];
      $phone2=$row['phone 2'];
      $email=$row['email'];
      $residential_address=$row['residential_address'];
      $home_address=$row['home_address'];
      $disability=$row['disability'];
      $health_issue=$row['health_issue'];
      $genotype=$row['genotype'];
      $blood_group=$row['blood_group'];
      $bank=$row['bank'];
      $account_no=$row['account_no'];
      $account_name=$row['account_name'];
      $name_of_nextofkin=$row['name_of_nextofkin'];
      $relationship_with_nextofkin=$row['relationship_with_nextofkin'];
      $position=$row['position'];
      $priviledge=$row['priviledge'];
      $salary=$row['salary'];
      //$staff_password=$row['staff_password'];
      $qualification=$row['qualification'];
      $class_arm=explode("_",$row['class']); 
      $class=$class_arm[0];
      $arm=$class_arm[1];
      //$status=$row['status'];
      $status='active';
      $cv=$row['cv'];
      $birth_certificate=$row['birth_certificate'];
      $medical_fitness=$row['medical_fitness'];
      $medical_report=$row['medical_report'];
      $certificate_of_origin=$row['certificate_of_origin'];
      $passport=$row['passport'];
      $staff_reg_no=$row['staff_reg_no'];
    }
  }
}


?>

<div class="container">
  <h3>Edit Staff Details Portal</h3>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$staff_id&reg_no=$staff_reg_no"; ?>" enctype="multipart/form-data" onsubmit="return(validate());">
  
  <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>

    
    
    <div style="margin-top: 30px; font-weight: bold">Personal Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    <div style="display: flex;">
      
      
      <div style="width:80%;">

        <div style="form-group">
          <label>Surname</label>
          <input type="text" name="surname" class="form-control"  value='<?php echo $surname ?>' required>
        </div>

        <div style="form-group">
          <label>Othernames</label>
          <input type="text" name="othernames" class="form-control"  value='<?php echo $othernames ?>' required>
        </div>

        <div style="form-group">
          <label>Gender</label>
          <select name="gender" class="form-control" required>
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

        <div style="form-group">
          <label>Date of birth</label>
          <input type="date" name="dob" class="form-control"  value='<?php echo $dob ?>' required>
        </div>

        <div style="form-group">
          <label>Nationality</label>
          <input type="text" name="nationality" class="form-control"  value='<?php echo $nationality ?>' required>
        </div>

        <div style="form-group">
          <label>State of Origin</label>
          <input type="text" name="stateOfOrigin" class="form-control"  value='<?php echo $stateOfOrigin ?>' required>
        </div>

        <div style="form-group">
          <label>LGA of Origin</label>
          <input type="text" name="lgaOfOrigin" class="form-control"  value='<?php echo $lgaOfOrigin ?>' required>
        </div>
      </div>


      <div style="width:20%">

        <div>
        <?php  if ($passport) {
            echo "<img src='$passport' width='100%' id='show_passport' width='100px' height='100px'>";
        }else{
          echo "<img src='../images/passport.png' id='show_passport' width='100px' height='100px'>";
        }
        echo "<input type='hidden' value='$passport' name='passport_alt'>";
        ?>
        </div>
        <input type="file" name="passport" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control" onchange="load_pic();" id="passport" style="font-size:10px;">
      </div>


    </div>



    <div style="margin-top: 30px; font-weight: bold">Contact Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
  
    <div style="form-group">
      <label>Phone 1</label>
      <input type="tel" name="phone1" class="form-control"  value='<?php echo $phone1 ?>' required>
    </div>

    <div style="form-group">
      <label>Phone 2</label>
      <input type="tel" name="phone2" class="form-control"  value='<?php echo $phone2 ?>'>
    </div>

    <div style="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control"  value='<?php echo $email ?>'>
    </div>

    <div style="form-group">
      <label>Residential Address</label>
      <textarea name="residential_address" class="form-control" cols="15" rows="5" required><?php echo $residential_address ?></textarea>
    </div>

    <div style="form-group">
      <label>Home Address</label>
      <textarea name="home_address" class="form-control" cols="15" rows="5"><?php echo $home_address ?></textarea>
    </div>

    <div style="margin-top: 30px; font-weight: bold">Medical Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div style="form-group">
      <label>Disability</label>
      <input type="text" name="disability" class="form-control"  value='<?php echo $disability ?>'>
    </div>

    <div style="form-group">
      <label>Health Issue</label>
      <input type="text" name="health_issue" class="form-control"  value='<?php echo $health_issue ?>'>
    </div>

    <div style="form-group">
      <label>Description of Health issue</label>
      <textarea name="health_issue_descr" class="form-control" cols="15" rows="5"><?php echo $health_issue_descr ?></textarea>
    </div>

    <div style="form-group">
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

    <div style="form-group">
      <label>Blood Group</label>
      <select name="blood_group" class="form-control">
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



    <div style="margin-top: 30px; font-weight: bold">Upload Documents</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div style="color:red;">Loading a new document will override the existing one (if any)</div>
    
    <div style="form-group">
      <label>Curriculum Vitae</label>
      <div style='display:flex;'>
        <input type="file" name="cv" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
        <?php  
          if ($cv) {
              echo "<img src='../images/do.jpg' width='52' height='52' title='Curriculum Vitae has been uploaded before'>";
          }
          echo "<input type='hidden' value='$cv' name='cv_alt' >";
        ?>
      </div>
    </div>

    <div style="form-group">
      <label>Birth Certificate</label>
      <div style='display:flex;'>
        <input type="file" name="birth_certificate" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
        <?php  
          if ($birth_certificate) {
            echo "<img src='../images/do.jpg' width='52' height='52' title='Birth certificate has been uploaded before'>";
          }
          echo "<input type='hidden' value='$birth_certificate' name='birth_certificate_alt' >";
        ?>
      </div>
    </div>

    <div style="form-group">
      <label>Certificate of Origin</label>
      <div style='display:flex;'>
        <input type="file" name="certificate_of_origin" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
        <?php  
          if ($certificate_of_origin) {
            echo "<img src='../images/do.jpg' width='52' height='52' title='Certificate of origin has been uploaded before'>";
          }
          echo "<input type='hidden' value='$certificate_of_origin' name='certificate_of_origin_alt' >";
        ?>
      </div>
    </div>

    <div style="form-group">
      <label>Medical Certificate of fitness</label>
      <div style='display:flex;'>
        <input type="file" name="medical_fitness" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
        <?php  
          if ($medical_fitness) {
            echo "<img src='../images/do.jpg' width='52' height='52' title='Medical certificate of fitness has been uploaded before'>";
          }
          echo "<input type='hidden' value='$medical_fitness' name='medical_fitness_alt' >";
        ?>
      </div>
    </div>

    <div>
      <label>Medical Report</label>
      <div style='display:flex;'>
        <input type="file" name="medical_report" accept="Images(*.jpeg,*.jpg,*.png)" class="form-control">
        <?php  if ($medical_report) {
            echo "<img src='../images/do.jpg' width='52' height='52' title='Medical report has been uploaded before'>
                  <input type='hidden' value='$medical_report' name='medical_report_alt' >";
        }?>
      </div>
    </div>



    <div style="margin-top: 30px; font-weight: bold">Bank Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div style="form-group">
      <label>Bank</label>
      <input type="text" name="bank" class="form-control"  value='<?php echo $bank ?>'>
    </div>

    <div style="form-group">
      <label>Account Number</label>
      <input type="number" name="account_no" class="form-control"  value='<?php echo $account_no ?>'>
    </div>

    <div style="form-group">
      <label>Account Name</label>
      <input type="text" name="account_name" class="form-control"  value='<?php echo $account_name ?>'>
    </div>



    <div style="margin-top: 30px; font-weight: bold">School Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div style="form-group">
      <label>Qualification</label>
      <input type="text" name="qualification" class="form-control"  value='<?php echo $qualification ?>'>
    </div>

    <div style="form-group">
      <label>Position</label>
      <select name='position' class='form-control'>
        <option value='default'>Choose staff position</option>
        <?php

          $xml=simplexml_load_file("staff_position.xml") or die("Error: cannot create xml object");
          
          for ($i=0; $i < count($xml->pos); $i++) { 

            if(strtolower($position) == strtolower($xml->pos[$i]['value'])){
                
              echo "<option value='".$xml->pos[$i]['value']."' selected='selected'>".$xml->pos[$i]."</option>";

            }else {
              
              echo "<option value='".$xml->pos[$i]['value']."'>".$xml->pos[$i]."</option>";

            }
            
          
          }
        
          ?>

      </select>
    </div>

    <!-- <div>
      <label>Status</label>
      <input type="text" name="status" class="form-control">
    </div> -->

    <div style="form-group">
      <label>Priviledge</label>
      <select name="priviledge" class="form-control" id="priviledge" onchange="show_class();" onload="show_class();">
      <?php
        switch ($priviledge) {
          case 'teaching_staff':
            echo "<option value='default'>choose staff priviledge</option>
                  <option value='teaching_staff' selected >Teaching Staff</option>
                  <option value='class_teacher'>Class Teacher</option>
                  <option value='non_teaching_staff'>Non Teaching Staff</option>
                  <!-- option value='admin'>Admin</option -->
                  <option value='pro'>Public Relations Officer</option>
                  <option value='account'>Account</option>
                  <option value='bursar'>Bursar</option>";
            break;
          case 'non_teaching_staff':
            echo "<option value='default'>choose staff priviledge</option>
                  <option value='teaching_staff'>Teaching Staff</option>
                  <option value='class_teacher'>Class Teacher</option>
                  <option value='non_teaching_staff' selected >Non Teaching Staff</option>
                  <!-- option value='admin'>Admin</option -->
                  <option value='pro'>Public Relations Officer</option>
                  <option value='account'>Account</option>
                  <option value='bursar'>Bursar</option>";
              break;
          case 'class_teacher':
            echo "<option value='default'>choose staff priviledge</option>
                  <option value='teaching_staff'>Teaching Staff</option>
                  <option value='class_teacher' selected >Class Teacher</option>
                  <option value='non_teaching_staff' >Non Teaching Staff</option>
                  <!-- option value='admin'>Admin</option-->
                  <option value='pro'>Public Relations Officer</option>
                  <option value='account'>Account</option>
                  <option value='bursar'>Bursar</option>";
              break;
          case 'account':
          echo "<option value='default'>choose staff priviledge</option>
                <option value='teaching_staff'>Teaching Staff</option>
                <option value='class_teacher'>Class Teacher</option>
                <option value='non_teaching_staff' >Non Teaching Staff</option>
                <!-- option value='admin'>Admin</option-->
                <option value='pro'>Public Relations Officer</option>
                <option value='account' selected>Account</option>
                <option value='bursar'>Bursar</option>";
            break;
          case 'bursar':
          echo "<option value='default'>choose staff priviledge</option>
                <option value='teaching_staff'>Teaching Staff</option>
                <option value='class_teacher'>Class Teacher</option>
                <option value='non_teaching_staff' >Non Teaching Staff</option>
                <!-- option value='admin'>Admin</option-->
                <option value='pro'>Public Relations Officer</option>
                <option value='account'>Account</option>
                <option value='bursar' selected>Bursar</option>";
            break;
          case 'pro':
          echo "<option value='default'>choose staff priviledge</option>
                <option value='teaching_staff'>Teaching Staff</option>
                <option value='class_teacher'>Class Teacher</option>
                <option value='non_teaching_staff' >Non Teaching Staff</option>
                <!-- option value='admin'>Admin</option-->
                <option value='pro' selected>Public Relations Officer</option>
                <option value='account'>Account</option>
                <option value='bursar'>Bursar</option>";
            break;
          default:
            echo "<option value='default' selected>choose staff priviledge</option>
                  <option value='teaching_staff'>Teaching Staff</option>
                  <option value='class_teacher'>Class Teacher</option>
                  <option value='non_teaching_staff'>Non Teaching Staff</option>
                  <!-- option value='admin'>Admin</option-->
                  <option value='pro'>Public Relations Officer</option>
                  <option value='account'>Account</option>
                  <option value='bursar'>Bursar</option>";
            break;
        }

      ?>
        
      </select>
    </div>

    <div style="display:none" id='class'>
      <div style="form-group">
        <label>Class</label>
        <select name="class" class="form-control" >
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

      <div style="form-group">
        <label>Arm</label>
        <select name="arm" class="form-control" >
          <option value="default" selected='false'>select arm</option>
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
  </div>

    <div style="form-group">
      <label>Salary</label>
      <input type="number" name="salary" class="form-control" value='<?php echo $salary; ?>'>
    </div>

    <div style="form-group">
      <label>Next of Kin</label>
      <input type="text" name="name_of_nextofkin" class="form-control" value='<?php echo $name_of_nextofkin ?>'>
    </div>

    <div style="form-group">
      <label>Relationship with Next of Kin</label>
      <input type="text" name="relationship_with_nextofkin" class="form-control" value='<?php echo $relationship_with_nextofkin ?>'>
    </div>

    <!-- <div>
      <label>Choose a Password</label>
      <input type="password" name="staff_password" class="form-control" id="password" required>
    </div>

    <div>
      <label>Confirm Password</label>
      <input type="password" name="cpassword" class="form-control" id="cpassword" required>
    </div> -->



    <div style="input-group">
      <input type="submit" name="submit" class="btn btn-success form-control" value="Update">
      <a href="javascript:history.back()" class='btn btn-warning form-control'>Back</a>
    </div>
        
  </form>
</div>



<script>

  function show_class() {

    priviledge=document.getElementById('priviledge');
    staff_class=document.getElementById("class");
    //alert(priviledge.value);
    
    if (priviledge.value == "class_teacher") {
      staff_class.style="display:block";
    }else{
      staff_class.style="display:none";
    }

  }

  function validate() {
    return true;
  }

  function load_pic() {
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

  include("footer.php");
  $con->close();
  
?>
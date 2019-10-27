<?php
session_start();
require_once("connect.php");
include("head.php");
include("sanitize.php");

$msg=array();

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
  $family_doctor=sanitize($_POST['family_doctor']);
  $family_hospital=sanitize($_POST['family_hospital']);
  $family_hospital_address=sanitize($_POST['family_hospital_address']);
  $family_doctor_no=sanitize($_POST['family_doctor_no']);
  $class_admitted=sanitize($_POST['class_admitted']);
  $session=sanitize($_POST['session']);
  // $term=sanitize($_POST['term']);
  $arm=sanitize($_POST['arm']);
  $specialization=sanitize($_POST['specialization']);
  $previous_school=sanitize($_POST['previous_school']);
  $sport_group=sanitize($_POST['sport_group']);
  $pg=sanitize($_POST['parent/guardian']);



$result=$con->query("SELECT * FROM `student` WHERE `surname`='$surname' AND `othernames`='$othernames'");
if ($result) {
  if ($result->num_rows > 0) {
    $msg[]="A student with the same name exists. Please verify and try again or try using something (e.g an index) to differentiate the students";
  }else {
    
    $allowedExtensions = array("jpg","jpeg");
    $documents=['birth_certificate','medical_fitness','medical_report','certificate_of_origin','passport'];
    
    for ($i=0; $i < count($documents); $i++) { 
      
      $file=$_FILES[$documents[$i]]['name'];
      $path=preg_replace("/[^A-Za-z]/"," ",$documents[$i]);

      if ($_FILES[$documents[$i]]['tmp_name'] ==""){
        $doc[$documents[$i]]="";

      }else{

        if (!in_array(pathinfo(basename($file),PATHINFO_EXTENSION),$allowedExtensions)) {
              
            $msg[]=$documents[$i]." file type is not accepted.";
          
          }else {

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
            }
              */ 
              $image_p = imagecreatetruecolor($width, $height);
              $image = imagecreatefromjpeg($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            $image_name = "data/".$path."/student ".rand(1000, 99999).".jpg";	

            imagejpeg($image_p, $image_name, 100);


            unlink("$target_path");
          }
          
          $doc[$documents[$i]]=$image_name; 
        }    
      
    }

    //var_dump($doc);
    
    $date_admitted=date("Y-m-d",time());

    if (empty($msg)) {

      $result=$con->query("INSERT INTO `student`(`surname`,`othernames`,`gender`,`dob`,`nationality`,
                        `state_of_origin`,`lga_of_origin`,`parent/guardian`,`phone 1`,`phone 2`,`email`,
                        `residential_address`,`home_address`,`genotype`,`blood_group`,
                        `disability`,`health_issue`,`health_issue_descr`,`medical_fitness`,`medical_report`,
                        `birth_certificate`,`certificate_of_origin`,`family_doctor`,`family_hospital`,`family_hospital_address`,
                        `family_doctor_no`,`date_admitted`,`passport`,`specialization`,`previous_school`) 
                        VALUES('$surname','$othernames','$gender','$dob','$nationality','$stateOfOrigin','$lgaOfOrigin',
                        '$pg','$phone1','$phone2','$email','$residential_address',
                        '$home_address','$genotype','$blood_group','$disability','$health_issue','$health_issue_descr',
                        '".$doc['medical_fitness']."','".$doc['medical_report']."','".$doc['birth_certificate']."',
                        '".$doc['certificate_of_origin']."','$family_doctor','$family_hospital',
                        '$family_hospital_address','$family_doctor_no','$date_admitted','".$doc['passport']."',
                        '$specialization','$previous_school')");

    
      if ($result) {





        $std_id=$con->insert_id;
        $student_reg_no="student".$std_id."/".substr(str_shuffle(time()),1,5);
       
        for ($i=0; $i < count($documents); $i++) { 
          if (file_exists($doc[$documents[$i]])) {
            $data = explode("/",$doc[$documents[$i]]);
            $data[2] = str_replace("/","_",$student_reg_no).".jpg";
            $docname[$documents[$i]] = $data[0]."/".$data[1]."/".$data[2];
            rename($doc[$documents[$i]],$docname[$documents[$i]]);
          }
        }
       
        $result=$con->query("UPDATE `student` set 
                              `student_reg_no` = '".$student_reg_no."', 
                              `medical_fitness` = '".$docname['medical_fitness']."',
                              `medical_report` = '".$docname['medical_report']."',
                              `birth_certificate` = '".$docname['birth_certificate']."',
                              `certificate_of_origin` = '".$docname['certificate_of_origin']."', 
                              `passport` = '".$docname['passport']."' 
                              WHERE `std_id`='$std_id'");


        $session=strtolower($_SESSION['session']);
        $term=strtolower($_SESSION['term']);
        $session_format=str_replace("/","_",$session);
        


        $result=$con->query("INSERT INTO `student_class`(`std_id`,`class_admitted`,`session_admitted`,`session`,`term`,`class`,`arm`,`sport_group`) 
                              VALUES('$std_id','$class_admitted','$session','$session','$term','$class_admitted','$arm','$sport_group')");






        
        $atd_id="atd_student_".$session_format."_".$term."_".$class_admitted."_".$arm;
        
        /*  if ($con->query("SELECT count(*) AS count FROM information_schema.tables 
                        WHERE table_schema='managementsystem'
                        AND table_name='$atd_id'")->fetch_assoc()) {
          $con->query("ALTER TABLE `$atd_id` ADD `$std_id` VARCHAR(2) NOT NULL DEFAULT '0'");
        } */
        
        if ($con->query("DESCRIBE `$atd_id`")) {
          $con->query("ALTER TABLE `$atd_id` ADD `$std_id` VARCHAR(2) NOT NULL DEFAULT '0'");
        }


        $res_id=str_replace("atd_student","res_id",$atd_id);
        if ($con->query("DESCRIBE `$res_id`")) {
          $con->query("INSERT INTO `$res_id`(`std_id`,`surname`,`othernames`)
                        VALUES('$std_id','$surname','$othernames')");
        }
        
        include_once("add_name_in_resultsheet.php");


        
        if (empty($msg)) {
          
          $msg[]="Registration successful<br>
                  <b>Student Reg. No. : ".$student_reg_no."</b>";

        }


      
      }else {
        $msg[]="Could not register student ".$con->error;
      }
    }


  }
}  
  
}

?>

<div class="container" style="margin-bottom:25px;">
  <h2>Student Registration Portal</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  
  <ul style='color:red;'>
    <?php 
      for ($i=0; $i < count($msg) ; $i++) { 
        echo "<li style='list-style:none;'>".$msg[$i]."</li>";
      }  
    ?>
  </ul>

  <h6>Fields Marked <sup style="color:red;font-weight:bolder;">*</sup> are mandatory</h6>
    <fieldset><legend>Personal Details</legend>
      <div style="display: flex;">



        <div style="width: 80%;">

          <div class="form-group">
            <label>Surname<sup style="color:red;">*</sup></label>
            <input type="text" name="surname" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Othernames<sup style="color:red;">*</sup></label>
            <input type="text" name="othernames" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Gender<sup style="color:red;">*</sup></label>
            <select name="gender" class="form-control" required>
              <option value="" selected>Select your gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

          <div class="form-group">
            <label>Date of birth<sup style="color:red;">*</sup></label>
            <input type="date" name="dob" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nationality<sup style="color:red;">*</sup></label>
            <input type="text" name="nationality" class="form-control" value="Nigerian" required>
          </div>

          <div class="form-group">
            <label>State of Origin<sup style="color:red;">*</sup></label>
            <!-- <select name="stateOfOrigin" class="form-control" required onchange="load_lga(this.value)"> -->
            <select name="stateOfOrigin" class="form-control" required >
              <?php include_once("load_states.php"); ?>
            </select>
          </div>

          <div class="form-group">
            <label>LGA of Origin<sup style="color:red;">*</sup></label>
            <input type="text" name="lgaOfOrigin" class="form-control" required>
          </div>

        </div>



        <div style="width: 20%;">
          <div><img src="../images/passport.png" width="100%" id='show_passport' width='100px' height='100px' id='show_passport'></div>
          <input type="file" name="passport" accept="Images(*.jpeg,*.jpg)" class="form-control" style="font-size:xx-small;" id='passport' onchange='load_passport();'>
        </div>



      </div>
    </fieldset>



    <fieldset><legend>Contact Details</legend>
     
      <div class="form-group">
        <label>Parent/Guardian<sup style="color:red;">*</sup></label>
        <input type="text" name="parent/guardian" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Phone 1<sup style="color:red;">*</sup></label>
        <input type="tel" name="phone1" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Phone 2</label>
        <input type="tel" name="phone2" class="form-control">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="form-group">
        <label>Residential Address<sup style="color:red;">*</sup></label>
        <textarea name="residential_address" class="form-control" cols="15" rows="5" required></textarea>
      </div>

      <div class="form-group">
        <label>Home Address</label>
        <textarea name="home_address" class="form-control" cols="15" rows="5"></textarea>
      </div>

    </fieldset>



    <fieldset><legend>Medical Details</legend>
      
      <div class="form-group">
        <label>Disability</label>
        <input type="text" name="disability" class="form-control">
      </div>

      <div class="form-group">
        <label>Health Issue</label>
        <input type="text" name="health_issue" class="form-control">
      </div>

      <div class="form-group">
        <label>Description of Health issue</label>
        <textarea name="health_issue_descr" class="form-control" cols="15" rows="5"></textarea>
      </div>

      <div class="form-group">
        <label>Genotype</label>
        <select name="genotype" class="form-control">
          <option value="default" selected>select your genotype</option>
          <option value="AA">AA</option>
          <option value="AS">AS</option>
          <option value="SS">SS</option>
        </select>
      </div>

      <div class="form-group">
        <label>Blood Group</label>
        <select name="blood_group" class="form-control">
          <option value="default" selected>select your blood group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>
      </div>

    </fieldset>



    <fieldset><legend>Upload Documents</legend>
      
      <div class="form-group">
        <label>Birth Certificate</label>
        <input type="file" name="birth_certificate" accept="Images(*.jpeg,*.jpg)" class="form-control">
      </div>

      <div class="form-group">
        <label>Certificate of Origin</label>
        <input type="file" name="certificate_of_origin" accept="Images(*.jpeg,*.jpg)" class="form-control">
      </div>

      <div class="form-group">
        <label>Medical Certificate of fitness</label>
        <input type="file" name="medical_fitness" accept="Images(*.jpeg,*.jpg)" class="form-control">
      </div>

      <div class="form-group">
        <label>Medical Report</label>
        <input type="file" name="medical_report" accept="Images(*.jpeg,*.jpg,)" class="form-control">
      </div>

    </fieldset>



    <fieldset><legend>Emergency Details</legend>
      
      <div class="form-group">
        <label>Family Doctor</label>
        <input type="text" name="family_doctor" class="form-control">
      </div>

      <div class="form-group">
        <label>Family Hospital</label>
        <input type="text" name="family_hospital" class="form-control">
      </div>

      <div class="form-group">
        <label>Family Hospital Address</label>
        <input type="text" name="family_hospital_address" class="form-control">
      </div>

      <div class="form-group">
        <label>Family Doctor's Number</label>
        <input type="tel" name="family_doctor_no" class="form-control">
      </div>

    </fieldset>



    <fieldset><legend>Class Details</legend>
      <div class="form-group">
        <label>Class Admitted<sup style="color:red;">*</sup></label>
        <select name="class_admitted" class="form-control" id="class_admitted" required>
          <option value="jss 1">JSS 1</option>
          <option value="jss 2">JSS 2</option>
          <option value="jss 3">JSS 3</option>
          <option value="ss 1">SS 1</option>
          <option value="ss 2">SS 2</option>
          <option value="ss 3">SS 3</option>
        </select>
      </div>
      
      <div class="form-group">
        <label>Session<sup style="color:red;">*</sup></label>
        <select name="session" class="form-control" required>
        <option value="2014/2015">2014/2015</option>
      <option value="2015/2016">2015/2016</option>
      <option value="2016/2017">2016/2017</option>
      <option value="2017/2018">2017/2018</option>
      <option value="2018/2019">2018/2019</option>
      <option value="2019/2020" selected>2019/2020</option>
      <option value="2020/2021">2020/2021</option>
      <option value="2021/2022">2021/2022</option>
      <option value="2022/2023">2022/2023</option>
      <option value="2023/2024">2023/2024</option>
      <option value="2024/2025">2024/2025</option>
      <option value="2025/2026">2025/2026</option>
        </select>
      </div>

      <!-- <div class="form-group">
        <label>Term Admitted</label>
        <select name="term" class="form-control">
          <option value="first">First</option>
          <option value="second">Second</option>
          <option value="third">Third</option>
        </select>
      </div> -->
      
      <div class="form-group">
        <label>Arm<sup style="color:red;">*</sup></label>
        <select name="arm" class="form-control" required onchange="get_num_std(this.value);">
          <option value="" selected>choose arm</option>
          <?php
          $result=$con->query("SELECT * FROM `arm`");
          if($result->num_rows > 0){
            while($row=$result->fetch_assoc()){
                echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";              
            }
          }

          ?>
        </select><span id="display_result" style="color:red;font-weight:bolder;"></span>
      </div>

      <div class="form-group">
        <label>Area of Specialization<sup style="color:red;">*</sup></label>
        <select name="specialization" class="form-control" required>
          <option value="">Choose an area of specialization</option>
          <option value="science">Science</option>
          <option value="arts">Arts</option>
          <option value="commercial">Commercial</option>
        </select>
      </div>

      <div class="form-group">
        <label>Sport Group</label>
        <select name="sport_group" class="form-control">
          <option value="Blue">Blue</option>
          <option value="White">White</option>
          <option value="Green">Green</option>
        </select>
      </div>

      <div class="form-group">
          <label>Previous school attended (if any)</label>
          <input type='text' class='form-control' name='previous_school'>
      </div>

    </fieldset>



    <div class="input-group">
      <input type="submit" name="submit" class="btn btn-success form-control" value="Register">
      <input name="back" type="submit" formaction="back.php" value="Back" class="btn btn-warning form-control">
    </div>
        
  </form>
</div>


<!-- <script src="load_lga.js"></script> -->
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


function get_num_std(arm) {
  var std_class = document.getElementById('class_admitted').value;
  str_text = 'num_of_std_in_class_arm.php?arm='+arm+'&class='+std_class;
  // alert(str_text);
  get_data(str_text,'display_result');
}

</script>

<?php
require_once("foot.php");
$con->close();
?>
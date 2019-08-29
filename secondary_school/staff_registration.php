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
  $residential_address=mysqli_real_escape_string($con,sanitize($_POST['residential_address']));
  $home_address=mysqli_real_escape_string($con,sanitize($_POST['home_address']));
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
  $staff_password=sanitize($_POST['staff_password']);
  $qualification=sanitize($_POST['qualification']);
  $class=sanitize($_POST['class']);  
  $arm=sanitize($_POST['arm']);
  //$status=sanitize($con,$_POST['status']);
  $status='active';


  $allowedExtensions = array("jpg","jpeg");
  $documents=['cv','birth_certificate','medical_fitness','medical_report','certificate_of_origin','passport'];
  
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
            $image_name = "data/".$path."/staff ".rand(1000, 99999).".jpg";	

            imagejpeg($image_p, $image_name, 100);


            unlink("$target_path");
        }
        $doc[$documents[$i]]=$image_name; 
    }    
    
  }

  //var_dump($doc);
  
  $date_employed=date("Y-m-d",time());

  $cost=['cost'=> 12];
  $hpassword=password_hash($staff_password,PASSWORD_DEFAULT,$cost);

  $class_arm=$class."_".$arm;
  $result=$con->query("INSERT INTO `staff`(`surname`,`othernames`,`gender`,`dob`,`nationality`,
                      `state_of_origin`,`lga_of_origin`,`name_of_nextofkin`,`relationship_with_nextofkin`,
                      `phone 1`,`phone 2`,`email`,`residential_address`,`home_address`,`genotype`,`blood_group`,
                      `disability`,`health_issue`,`health_issue_descr`,`medical_fitness`,`medical_report`,
                      `birth_certificate`,`certificate_of_origin`,`qualification`,`cv`,`status`,`priviledge`,
                      `position`,`date_employed`,`bank`,`account_no`,`account_name`,`salary`,`staff_password`,`passport`,`class`) 
                      VALUES('$surname','$othernames','$gender','$dob','$nationality','$stateOfOrigin','$lgaOfOrigin',
                      '$name_of_nextofkin','$relationship_with_nextofkin','$phone1','$phone2','$email','$residential_address',
                      '$home_address','$genotype','$blood_group','$disability','$health_issue','$health_issue_descr',
                      '".$doc['medical_fitness']."','".$doc['medical_report']."','".$doc['birth_certificate']."',
                      '".$doc['certificate_of_origin']."','$qualification','".$doc['cv']."','$status','$priviledge',
                      '$position','$date_employed','$bank','$account_no','$account_name','$salary','$hpassword',
                      '".$doc['passport']."','$class_arm')");

 
  if ($result) {
    $staff_id=$con->insert_id;
    $staff_reg_no="staff".$staff_id."/".substr(str_shuffle(time()),1,5);
    
    for ($i=0; $i < count($documents); $i++) { 
      if (file_exists($doc[$documents[$i]])) {
        $data = explode("/",$doc[$documents[$i]]);
        $data[2] = str_replace("/","_",$staff_reg_no).".jpg";
        $docname[$documents[$i]] = $data[0]."/".$data[1]."/".$data[2];
        rename($doc[$documents[$i]],$docname[$documents[$i]]);
      }
    }
   
    $result=$con->query("UPDATE `staff` set 
                          `staff_reg_no` = '".$staff_reg_no."', 
                          `medical_fitness` = '".$docname['medical_fitness']."',
                          `medical_report` = '".$docname['medical_report']."',
                          `birth_certificate` = '".$docname['birth_certificate']."',
                          `certificate_of_origin` = '".$docname['certificate_of_origin']."', 
                          `cv` = '".$docname['cv']."', 
                          `passport` = '".$docname['passport']."' 
                          WHERE `staff_id`='$staff_id'");
    
    $session=strtolower($_SESSION['session']);
    $term=strtolower($_SESSION['term']);
    $session_format=str_replace("/","_",$session);
    $atd_id="atd_staff_".$session_format."_".$term;
    $con->query("ALTER TABLE `$atd_id` ADD `$staff_id` timestamp NOT NULL");


    $msg[]="Registration successful";

    header("Location: staff_registration_done.php?id=$staff_id&regno=$staff_reg_no");
  }else {
    $msg[]="Could not register staff ".$con->error;
  }
}   

?>

<div class="container">
  <h2>Staff Registration Portal</h2>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" onsubmit="return(validate());">
  
  <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>

    
    <h6>Fields Marked <sup style="color:red;font-weight:bolder;">*</sup> are mandatory</h6>
    <div style="margin-top: 30px; font-weight: bold">Personal Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    <div style="display: flex;">
      
      
      <div style="width:80%;">
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
            <option value="default" selected>Select your gender</option>
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
          <select name="stateOfOrigin" class="form-control" required onchange="load_lga(this.value)">
            <?php include_once("load_states.php"); ?>
          </select>
        </div>

        <div class="form-group">
          <label>LGA of Origin<sup style="color:red;">*</sup></label>
          <input type="text" name="lgaOfOrigin" class="form-control" required>
        </div>
      </div>


      <div style="width:20%">
        <div><img src="../images/passport.png" id="show_passport" width="200px" height="200px"></div>
        <input type="file" name="passport" accept="Images|(*.jpeg;*.jpg)" class="form-control" onchange="load_pic();" id="passport" style="font-size:10px;">
      </div>


    </div>



    <div style="margin-top: 30px; font-weight: bold">Contact Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
  
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

    <div style="margin-top: 30px; font-weight: bold">Medical Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
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



    <div style="margin-top: 30px; font-weight: bold">Upload Documents</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="form-group">
      <label>Curriculum Vitae</label>
      <input type="file" name="cv" accept="Images|(*.jpeg;*.jpg)||" class="form-control">
    </div>

    <div class="form-group">
      <label>Birth Certificate</label>
      <input type="file" name="birth_certificate" accept="Images|(*.jpeg;*.jpg)||" class="form-control">
    </div>

    <div class="form-group">
      <label>Certificate of Origin</label>
      <input type="file" name="certificate_of_origin" accept="Images|(*.jpeg;*.jpg)||" class="form-control">
    </div>

    <div class="form-group">
      <label>Medical Certificate of fitness</label>
      <input type="file" name="medical_fitness" accept="Images|(*.jpeg;*.jpg)||" class="form-control">
    </div>

    <div class="form-group">
      <label>Medical Report</label>
      <input type="file" name="medical_report" accept="Images|(*.jpeg;*.jpg)||" class="form-control">
    </div>



    <div style="margin-top: 30px; font-weight: bold">Bank Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="form-group">
      <label>Bank</label>
      <input type="text" name="bank" class="form-control">
    </div>

    <div class="form-group">
      <label>Account Number</label>
      <input type="number" name="account_no" class="form-control" maxlength="10">
    </div>

    <div class="form-group">
      <label>Account Name</label>
      <input type="text" name="account_name" class="form-control">
    </div>



    <div style="margin-top: 30px; font-weight: bold">School Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="form-group">
      <label>Qualification</label>
      <input type="text" name="qualification" class="form-control">
    </div>

    <div class="form-group">
      <label>Position</label>
      <select name='position' class='form-control'>
        <option value='default'>Choose staff position</option>
        <?php

          $xml=simplexml_load_file("staff_position.xml") or die("Error: cannot create xml object");
          
          for ($i=0; $i < count($xml->pos); $i++) { 
                      
              echo "<option value='".$xml->pos[$i]['value']."'>".$xml->pos[$i]."</option>";
           
          
          }
        
          ?>

      </select>
    </div>

    <!-- <div>
      <label>Status</label>
      <input type="text" name="status" class="form-control">
    </div> -->

    <div class="form-group">
      <label>Priviledge</label>
      <select name="priviledge" class="form-control" id="priviledge" onchange="show_class();">
        <option value="teaching_staff" selected>Teaching Staff</option>
        <option value="class_teacher">Class Teacher</option>
        <option value="account">Account</option>
        <option value="bursar">Bursar</option>
        <option value="pro">Public Relations Officer</option>
        <option value="non_teaching_staff">Non Teaching Staff</option>
        <!-- option value="admin">Admin</option>
        <option value="account">Account</option -->
      </select>
    </div>

    <div style="display:none" id='class'>
      <div class="form-group">
        <label>Class</label>
        <select name="class" class="form-control" >
          <option value="default" selected>select class</option>
          <option value="jss 1">JSS 1</option>
          <option value="jss 2">JSS 2</option>
          <option value="jss 3">JSS 3</option>
          <option value="ss 1">SS 1</option>
          <option value="ss 2">SS 2</option>
          <option value="ss 3">SS 3</option>
        </select>
      </div>

      <div class="form-group">
        <label>Arm</label>
        <select name="arm" class="form-control">
          <option value="default" selected>choose arm</option>
          <?php
            $result=$con->query("SELECT * FROM `arm`");
            if($result->num_rows > 0){
              while($row=$result->fetch_assoc()){
                  echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";              
              }
            }

          ?>
        </select>
    </div>
  </div>

    <div class="form-group">
      <label>Salary</label>
      <input type="number" name="salary" class="form-control">
    </div>

    <div class="form-group">
      <label>Next of Kin</label>
      <input type="text" name="name_of_nextofkin" class="form-control">
    </div>

    <div class="form-group">
      <label>Relationship with Next of Kin</label>
      <input type="text" name="relationship_with_nextofkin" class="form-control">
    </div>

    <div class="form-group">
      <label>Choose a Password<sup style="color:red;">*</sup></label>
      <input type="password" name="staff_password" class="form-control" id="password" required>
    </div>

    <div class="form-group">
      <label>Confirm Password<sup style="color:red;">*</sup></label>
      <input type="password" name="cpassword" class="form-control" id="cpassword" required>
    </div>



    <div class="input-group">
      <input type="submit" name="submit" class="btn btn-success form-control" value="Register">
      <a href="back.php" class='btn btn-warning form-control'>Back</a>
    </div>
        
  </form>
</div>


<script src="load_lga.js"></script>

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

  //var tags=document.getElementsByTagName("select");
  var password=document.getElementById("password");
  var cpassword=document.getElementById("cpassword");


  /* tags.forEach(tag => {
    if (tag.value == "default") {
      alert("choose a value for " + tag.name);
      return false;
    }
  });
   */
  if (password.value != cpassword.value) {
    alert("Password mismatch");
    cpassword.value="";
    password.select();
    //password.focus();
    return false;
  }
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

include("foot.php");
$con->close();
?>
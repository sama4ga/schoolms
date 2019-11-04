<?php
session_start();
require_once("connect.php");
include("head.php");

include_once("auth.php");
if ($priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

include("sanitize.php");

$msg=array();

$staff_id=$_GET['id'];



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
    }
  }
}


?>

<div class="container">
  <h3>View Staff Details Portal</h3>
      
    
    <div style="margin-top: 30px; font-weight: bold">Personal Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    <div style="display: flex;">
      
      
      <div style="width:80%;">
        <div class="row">
          <div class="col-5">Surname</div>
          <div class="col-7"><?php echo $surname ?></div>
        </div>

        <div class="row">
          <div class="col-5">Othernames</div>
          <div class="col-7"><?php echo $othernames ?></div>
        </div>

        <div class="row">
          <div class="col-5">Gender</div>
          <div class="col-7"><?php echo $gender ?></div>
        </div>

        <div class="row">
          <div class="col-5">Date of birth</div>
          <div class="col-7"><?php echo $dob ?></div>
        </div>

        <div class="row">
          <div class="col-5">Nationality</div>
          <div class="col-7"><?php echo $nationality ?></div>
        </div>

        <div class="row">
          <div class="col-5">State of Origin</div>
          <div class="col-7"><?php echo $stateOfOrigin ?></div>
        </div>

        <div class="row">
          <div class="col-5">LGA of Origin</div>
          <div class="col-7"><?php echo $lgaOfOrigin ?></div>
        </div>

      </div>


      <div style="width:20%">
        <div>
          <?php  
            if ($passport) {
                echo "<img src='$passport' width='100%' id='show_passport' width='100px' height='100px'>";
            }else{
              echo "<img src='../images/passport.png' id='show_passport' width='100px' height='100px'>";
            }
          ?>
      </div>
    </div>


    </div>



    <div style="margin-top: 30px; font-weight: bold">Contact Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
  
    <div class="row">
      <div class="col-5">Phone 1</div>
      <div class="col-7"><?php echo $phone1 ?></div>
    </div>

    <div class="row">
      <div class="col-5">Phone 2</div>
      <div class="col-7"><?php echo $phone2 ?></div>
    </div>

    <div class="row">
      <div class="col-5">Email</div>
      <div class="col-7"><?php echo $email ?></div>
    </div>

    <div class="row">
      <div class="col-5">Residential Address</div>
      <div class="col-7"><?php echo $residential_address ?></div>
    </div>

    <div class="row">
      <div class="col-5">Home Address</div>
      <div class="col-7"><?php echo $home_address ?></div>
    </div>

    <div style="margin-top: 30px; font-weight: bold">Medical Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    <div class="row">
      <div class="col-5">Disability</div>
      <div class="col-7"><?php echo $disability ?></div>
    </div>

    <div class="row">
      <div class="col-5">Health Issue</div>
      <div class="col-7"><?php echo $health_issue ?></div>
    </div>

    <div class="row">
      <div class="col-5">Description of Health issue</div>
      <div class="col-7"><?php echo $health_issue_descr ?></div>
    </div>

    <div class="row">
      <div class="col-5">Genotype</div>
      <div class="col-7"><?php echo $genotype ?></div>
    </div>

    <div class="row">
      <div class="col-5">Blood Group</div>
      <div class="col-7"><?php echo $blood_group ?></div>
    </div>



    <div style="margin-top: 30px; font-weight: bold">Upload Documents</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
   
    <div class="row">
      <div class="col-5">Curriculum Vitae</div>
      <?php  
        if ($cv) {
          echo "<div class='col-7'>File uploaded</div>";
        }else{
          echo "<div class='col-7'>No File uploaded</div>";
        }
      ?>
    </div>

    <div class="row">
      <div class="col-5">Birth Certificate</div>
      <?php  
        if ($birth_certificate) {
          echo "<div class='col-7'>File uploaded</div>";
        }else{
          echo "<div class='col-7'>No File uploaded</div>";
        }
      ?>
    </div>

    <div class="row">
      <div class="col-5">Certificate of Origin</div>
      <?php  
        if ($certificate_of_origin) {
          echo "<div class='col-7'>File uploaded</div>";
        }else{
          echo "<div class='col-7'>No File uploaded</div>";
        }
      ?>
    </div>

    <div class="row">
      <div class="col-5">Medical Certificate of fitness</div>
      <?php  
        if ($medical_fitness) {
          echo "<div class='col-7'>File uploaded</div>";
        }else{
          echo "<div class='col-7'>No File uploaded</div>";
        }
      ?>
    </div>

    <div class="row">
      <div class="col-5">Medical Report</div>
      <?php
        if ($medical_report) {
          echo "<div class='col-7'>File uploaded</div>";
        }else{
          echo "<div class='col-7'>No File uploaded</div>";
        }
      ?>
    </div>



    <div style="margin-top: 30px; font-weight: bold">Bank Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="row">
      <div class="col-5">Bank</div>
      <div class="col-7"><?php echo $bank ?></div>
    </div>

    <div class="row">
      <div class="col-5">Account Number</div>
      <div class="col-7"><?php echo $account_no ?></div>
    </div>

    <div class="row">
      <div class="col-5">Account Name</div>
      <div class="col-7"><?php echo $account_name ?></div>
    </div>



    <div style="margin-top: 30px; font-weight: bold">School Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="row">
      <div class="col-5">Qualification</div>
      <div class="col-7"><?php echo $qualification ?></div>
    </div>

    <div class="row">
      <div class="col-5">Position</div>
      <div class="col-7"><?php echo $position ?></div>
    </div>

    <div class="row">
      <div class="col-5">Priviledge</div>
      <div class="col-7"><?php echo $priviledge ?></div>
    </div>

    <div style="display:none" id='class' class="row">
      <div>
        <div class="col-5">Class</div>
        <div class="col-7"><?php echo $class ?></div>
      </div>

      <div class="row">
        <div class="col-5">Arm</div>
        <div class="col-7"><?php echo $arm ?></div>
    </div>
  </div>

    <div class="row">
      <div class="col-5">Salary</div>
      <div class="col-7"><span style="text-decoration:line-through double;">N</span><?php echo number_format($salary) ?></div>
    </div>

    <div class="row">
      <div class="col-5">Next of Kin</div>
      <div class="col-7"><?php echo $name_of_nextofkin ?></div>
    </div>

    <div class="row">
      <div class="col-5">Relationship with Next of Kin</div>
      <div class="col-7"><?php echo $relationship_with_nextofkin ?></div>
    </div>

    <div class="input-group">
      <a href="javascript:history.back()" class='btn btn-warning'>Back</a>
      <a href="javascript:window.print()" class="btn btn-success">Print</a>
    </div>
        
  </form>
</div>

<script>

function show_class() {

  priviledge=document.getElementById('priviledge');
  staff_class=document.getElementById("class");
  //alert(priviledge.value);
  
  if (priviledge.innerHTML == "class_teacher") {
    staff_class.style="display:block";
  }else{
    staff_class.style="display:none";
  }

}

</script>

<?php

include("foot.php");
$con->close();
?>
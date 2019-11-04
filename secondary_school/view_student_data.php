<?php
session_start();
require_once("connect.php");
include("head.php");

include_once("auth.php");
if ($priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

$msg=array();

$std_id=intval($_GET['id']);



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

     }
  }
}else{
  echo "<div style='color:red;'>Error occured ".$con->error."</div>";
}


?>

<div class="container" style="margin-bottom:25px;">
  <h3>View Student Data Portal</h3>
  
    <fieldset><legend>Personal Details</legend>
      
      <div class="row">



        <div class="col-8">

          <div class="row">
            <div class="col-5">Surname</div>
            <div class="col-7"><?php echo $surname ?></div>
          </div>

          <div class="row">
            <div class="col-5">Othernames</div>
            <div class="col-7"><?php echo $othernames; ?></div>
          </div>


          <div class="row"> 
            <div class="col-5">Gender</div>
            <div class="col-7"><?php echo $gender; ?></div>
          </div>


          <div class="row">
            <div class="col-5">Date of birth</div>
            <div class="col-7"><?php echo $dob; ?></div>
          </div>


          <div class="row">
            <div class="col-5">Nationality</div>
            <div class="col-7"><?php echo $nationality; ?></div>
          </div>


          <div class="row">
            <div class="col-5">State of Origin</div>
            <div class="col-7"><?php echo $stateOfOrigin; ?></div>
          </div>


          <div class="row">
            <div class="col-5">LGA of Origin</div>
            <div class="col-7"><?php echo $lgaOfOrigin; ?></div>
          </div>


        </div>



        <div class="col-4">

            <?php  
              if ($passport) {
                echo "<div><img src=".$passport." width='200px' height='150px'></div>";
              }else{
                echo "<div><img src='../images/passport.png' width='200px' height='150px'></div>";
              }
            ?>
        </div>          
          
      </div>


    </fieldset>




    <fieldset><legend>Contact Details</legend>


      <div class="row">
        <div class="col-5">Parent/Guardian</div>
        <div class="col-7"><?php echo $pg; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Phone 1</div>
        <div class="col-7"><?php echo $phone1; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Phone 2</div>
        <div class="col-7"><?php echo $phone2; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Email</div>
        <div class="col-7"><?php echo $email; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Residential Address</div>
        <div class="col-7"><?php echo $residential_address; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Home Address</div>
        <div class="col-7"><?php echo $home_address; ?></div>
      </div>


    </fieldset>



    <fieldset><legend>Medical Details</legend>


      <div class="row">
        <div class="col-5">Disability</div>
        <div class="col-7"><?php echo $disability; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Health Issue</div>
        <div class="col-7"><?php echo $health_issue; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Description of Health issue</div>
        <div class="col-7"><?php echo $health_issue_descr; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Genotype</div>
        <div class="col-7"><?php echo $genotype; ?></div>        
      </div>


      <div class="row">
        <div class="col-5">Blood Group</div>
        <div class="col-7"><?php echo $blood_group; ?></div>
      </div>


    </fieldset>



    <fieldset><legend>Uploaded Documents</legend>

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


    </fieldset>



    <fieldset><legend>Emergency Details</legend>


      <div class="row">
        <div class="col-5">Family Doctor</div>
        <div class="col-7"><?php echo $family_doctor; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Family Hospital</div>
        <div class="col-7"><?php echo $family_hospital; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Family Hospital Address</div>
        <div class="col-7"><?php echo $family_hospital_address; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Family Doctor's Number</div>
        <div class="col-7"><?php echo $family_doctor_no; ?></div>
      </div>


    </fieldset>



    <fieldset><legend>Class Details</legend>


      <div class="row">
        <div class="col-5">Class</div>
        <div class="col-7"><?php echo strtoupper($class); ?></div>
      </div>


      
      <div class="row">
        <div class="col-5">Arm</div>
        <div class="col-7"><?php echo strtoupper($arm); ?></div>
      </div>


      <div class="row">
        <div class="col-5">Area of Specialization</div>
        <div class="col-7"><?php echo $specialization; ?></div>
      </div>


      <div class="row">
        <div class="col-5">Sport Group</div>
        <div class="col-7"><?php echo $sport_group; ?></div>
      </div>


      <div class="row">
          <div class="col-5">Previous school attended (if any)</div>
          <div class="col-7"><?php echo $previous_school; ?></div>
      </div>
    </fieldset>



    <div class="input-group">
      <a href="javascript:history.back()" class="btn-lg btn-warning">Back</a>
      <a href="javascript:window.print()" class="btn-lg btn-success">Print</a>
    </div>


</div>



<?php

$con->close();
?>
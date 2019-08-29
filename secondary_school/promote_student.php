<?php
session_start();
require_once("connect.php");
include_once("head.php");

$msg=array();

$session=$_SESSION['session'];
$term=$_SESSION['term'];

if ($term != "third") {
  echo "<script>
          alert('It is not yet third term so you cannot promote students');
        </script>";
  exit();
}

echo "<script>
        answer = confirm('Are you sure you want to promote students?'); 
        if(answer){";



          $session_format=str_replace("/","_",$session);


          /* 
          if (isset($_POST['submit'])) {
            

            $from=$_POST['from'];
            $to=$_POST['to'];
            $from_arm=$_POST['from_arm'];
            $to_arm=$_POST['to_arm'];
                      
            $atd_id="atd_student_".$session_format."_".$term."_".$from."_".$from_arm;
            $res_id=str_replace("atd_student","res_id",$atd_id);

            $result=$con->query("SELECT `std_id` FROM `$res_id` WHERE `status`='pass' ");
            if ($result->num_rows > 0) {

              $x=0;
              while($row=$result->fetch_assoc()){

                $std_id[$x]=$row['std_id'];

                $x++;
              }
              

              for ($x=0; $x < count($std_id); $x++) { 
              
                $con->query("UPDATE `student_class` SET `class`='$to',`arm`='$to_arm' WHERE `std_id`='$std_id[$x]'");

              }
              
              $msg[]="Students successfully promoted";


            }


            


          } */


          // define class
          $class = ['jss 1','jss 2','jss 3','ss 1','ss 2','ss 3','graduate'];

          // get arm
          $result=$con->query("SELECT * FROM `arm`");
          $num_of_arms = $result->num_rows;
          if($num_of_arms > 0){
            $i=0;
            while($row=$result->fetch_assoc()){
                $arm[$i] = $row['arm'];      
                $i++;
            }
          }

          for ($i=0; $i < 6; $i++) { 
            
            for ($j=0; $j < $num_of_arms; $j++) { 
              
              $atd_id="atd_student_".$session_format."_".$term."_".$class[$i]."_".$arm[$j];
              $res_id=str_replace("atd_student","res_id",$atd_id);
            
              $result=$con->query("SELECT `std_id` FROM `$res_id` WHERE `status`='pass' ");
              if ($result && $result->num_rows > 0) {
            
                $x=0;       
                while($row=$result->fetch_assoc()){
            
                  $std_id[$x]=$row['std_id'];
            
                  $x++;
                }
                
            
                if ($i == 5) {       
                    
                    // create graduate table
                    $result = $con->query("CREATE TABLE IF NOT EXISTS `graduates` (
                      `std_id` int(10) NOT NULL,
                      `surname` varchar(20) NOT NULL,
                      `othernames` varchar(40) NOT NULL,
                      `gender` varchar(6) NOT NULL,
                      `dob` date NOT NULL,
                      `nationality` varchar(20) NOT NULL,
                      `state_of_origin` varchar(60) NOT NULL,
                      `lga_of_origin` varchar(60) NOT NULL,
                      `passport` varchar(60) NOT NULL,
                      `Parent/Guardian` varchar(60) NOT NULL,
                      `Phone 1` varchar(14) NOT NULL,
                      `email` varchar(40) NOT NULL,
                      `residential_address` varchar(100) NOT NULL,
                      `home_address` varchar(100) NOT NULL,
                      `class_admitted` varchar(20) NOT NULL,
                      `session_admitted` varchar(20) NOT NULL,
                      `term_admitted` varchar(20) NOT NULL,
                      `session_graduated` varchar(20) NOT NULL,
                      PRIMARY KEY (`std_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

                  for ($x=0; $x < count($std_id); $x++) { 
                    // get student details
                    $result = $con->query("SELECT * FROM `student`s JOIN `student_class`sc ON sc.`std_id`=s.`std_id` WHERE s.`std_id`='$std_id[$x]'");
                    if ($result && $result->num_rows > 0) {

                      while ($row = $result->fetch_assoc()) {              
                        $surname = $row['surname'];
                        $othernames = $row['othernames'];
                        $gender = $row['gender'];
                        $dob = $row['dob'];
                        $state_of_origin = $row['state_of_origin'];
                        $nationality = $row['nationality'];
                        $lga_of_origin = $row['lga_of_origin'];
                        $passport = $row['passport'];
                        $pg = $row['parent/guardian'];
                        $phone = $row['phone 1'];
                        $email = $row['email'];
                        $residential_address = $row['residential_address'];
                        $home_address = $row['home_address'];
                        $class_admitted = $row['class_admitted'];
                        $session_admitted = $row['session_admitted'];
                        $term_admitted = $row['term_admitted'];
                        $session_graduated = $row['session_graduated'];
                      }

                    }

                    // insert record in graduate table
                    $result = $con->query("INSERT INTO `graduates` VALUES(
                              '$std_id[$x]','$surname','$othernames','$gender','$dob',
                              '$nationality','$state_of_origin','$lga_of_origin','$passport','$pg',
                              '$phone','$email','$residential_address','$home_address','$class_admitted',
                              '$sesion_admitted','$term_admitted','$session'  
                            )");


                    $con->query("DELETE FROM `student_class` WHERE `std_id`='$std_id[$x]'");
                    $con->query("DELETE FROM `student` WHERE `std_id`='$std_id[$x]'");
              
                  }
                }else{
                  for ($x=0; $x < count($std_id); $x++) { 
                  
                    $con->query("UPDATE `student_class` SET `class`='".$class[$i+1]."',`arm`='$arm[$j]' WHERE `std_id`='$std_id[$x]'");
              
                  }
                }
                
                
            
              }

            }
          }

          $msg[]="Students successfully promoted";
          echo "Students successfully promoted";


echo "  }
      </script>";

?>
<!-- 
<div class="container">

  <h2>Promote Students</h2>

  <form method="POST" action="" class='form-control'>
    
  <ul style='color:red;'>
    <?php 
      /* for ($i=0; $i < count($msg) ; $i++) { 
        echo "<li style='list-style:none;'>".$msg[$i]."</li>";
      }  */ 
    ?>
  </ul>

    <div class="form-group">
      <label>From</label>
      <select name="from" class="form-control">
        <option value="default">Choose class students currently are in</option>
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
      <select name="from_arm" class="form-control">
        <option value="default" selected>choose arm</option>
        <?php
        /* $result=$con->query("SELECT * FROM `arm`");
        if($result->num_rows > 0){
          while($row=$result->fetch_assoc()){
              echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";              
          }
        } */

        ?>
      </select>
    </div>

    <div class="form-group">
      <label>To</label>
      <select name="to" class="form-control">
        <option value="default">Choose class students are to be promoted to</option>
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
      <select name="to_arm" class="form-control">
        <option value="default" selected>choose arm</option>
        <?php
        /* $result=$con->query("SELECT * FROM `arm`");
        if($result->num_rows > 0){
          while($row=$result->fetch_assoc()){
              echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";              
          }
        } */

        ?>
      </select>
    </div>

    <div class="input-group">
      <input type="submit" name="submit" value="Promote" class='btn btn-success form-control'/>
      <a href='back.php' class='btn btn-warning form-control'>Back</a>

    </div>

  </form>
</div> -->

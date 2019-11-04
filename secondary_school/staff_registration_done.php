<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

$msg=array();

$staff_id=$_GET['id'];
$staff_reg_no=$_GET['regno'];


if (isset($_POST['submit'])) {
  $class=$_POST['class'];
  $arm=$_POST['arm'];
  $subject=$_POST['subjects'];


  $result=$con->query("INSERT INTO `staff_class`(`staff_id`,`class`,`subject`,`arm`) VALUES('$staff_id',
                    '$class','$subject','$arm')");

  if ($result) {
    $msg[]=$subject." successfully added for ".strtoupper($class)." ".strtoupper($arm);
  }



  $result=$con->query("SELECT * FROM `staff_class` WHERE `staff_id`='$staff_id'");

  if ($result) {
    if ($result->num_rows > 0) {
      $y=0;
      while ($rows = $result->fetch_assoc()) {

        $class_handled[$y]=$rows['class'];
        $subject_handled[$y]=$rows['subject'];
        $arm_handled[$y]=$rows['arm'];

        $y++;
      }
    }
  }

}
//echo count($class_handled);var_dump($class_handled);exit();

?>

<div class="container">
  <h3>Staff Registration Portal</h3>
  
  <div><?php echo "Staff Reg. No.: <b style='color:red'>".$staff_reg_no."</b>"; ?></div>
  <div style="font-weight:bold;">Note: Your Reg. No. is your username to log into the portal </div>
  

  <?php

    if (!empty($class)) {

      echo "<div style='margin-top:50px;'>Your are currently handling the following classes
              <table border='1' width='80%'>
                <th width='10px'>S/N</th>
                <th width='200px'>Class</th>
                <th width='200px'>Subject</th>
                <th width='200px'>Arm</th>";

      for ($x=0; $x < count($class_handled); $x++) { 
        $num=$x+1;
        echo "<tr>
                <td align='centre'>".$num."</td>
                <td align='centre'>".strtoupper($class_handled[$x])."</td>
                <td align='centre'>".$subject_handled[$x]."</td>
                <td align='centre'>".strtoupper($arm_handled[$x])."</td>
              </tr>";

      }

      echo "</table></div>";
    }

  ?>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$staff_id."&regno=$staff_reg_no"; ?>">
  
  <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>

    <div style="margin-top: 30px; font-weight: bold">Class Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    <div class="form-group">
      <label>Class</label>
      <select name="class" id="class" class="form-control" onchange="
      var sel=document.getElementById('class'); javascript:get_data('load_subjects.php?class='+sel.value,'subjects_div')">
        <option value="default" selected>select your class</option>
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
    
    <div id='subjects_div' class="form-group">
      
        
      </select>      
    </div>
    <div  class="input-group">
      <input type="submit" value="Add" class="btn btn-success form-control" id="btnAdd" name="submit" style="display: none;">
      <a class="btn btn-warning form-control" id="btnBack" name="back" href='staff_registration.php'>Back</a>
    </div>
  </form>
</div>
<?php
include_once("foot.php");
?>
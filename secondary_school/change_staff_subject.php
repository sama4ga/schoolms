<?php
include_once("head.php");
require_once("connect.php");

$msg=array();




if (isset($_POST['btnAdd'])) {

  $staff_id=$_REQUEST['id'];

  $class=$_POST['class'];
  $arm=$_POST['arm'];
  $subject=$_POST['subjects'];


  $result=$con->query("INSERT INTO `staff_class`(`staff_id`,`class`,`subject`,`arm`) VALUES('$staff_id',
                    '$class','$subject','$arm')");

  if ($result) {
    $msg[]=$subject." successfully added for ".strtoupper($class)." ".$arm;
  }


}




if (isset($_POST['delete'])) {

  $staff_id=$_REQUEST['id'];

  $details=$_POST['details'];
  $details=explode("_",$details);
  $subject=$details[0];
  $class=$details[1];
  $arm=$details[2];

  $result=$con->query("DELETE FROM `staff_class` 
                      WHERE `staff_id`='$staff_id'
                      AND `class`='$class'
                      AND `arm`='$arm'
                      AND `subject`='$subject'");

  if (!$result) {

    $msg[]="Error removing ".$subject." for staff";

  }else {
    $msg[]=$subject." successfully removed for staff";
  }

  //var_dump($details);
}






if (isset($_POST['submit'])) {
  
$staff_id=$_REQUEST['staff_id'];

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


$result = $con->query("SELECT * FROM `arm`");
if ($result) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $class_arm[] = $row['arm'];
    }
  }
}

?>

<div class="container">
  <h3>Edit Subjects taken by staff</h3>
  

  <?php

    if (!empty($class_handled)) {

      echo "<p>Your are currently handling the following classes
              <table border='1' width='80%'>
                <th width='10px'>S/N</th>
                <th width='200px'>Class</th>
                <th width='200px'>Subject</th>
                <th width='200px'>Arm</th>";

      for ($x=0; $x < count($class_handled); $x++) { 
        $num=$x+1;
        echo "<tr>
              <form action='change_staff_subject.php?id=$staff_id' method='POST'>
                <td align='centre'>".$num."</td>
                <td align='centre'>".strtoupper($class_handled[$x])."</td>
                <td align='centre'>".$subject_handled[$x]."</td>
                <td align='centre'>".strtoupper($arm_handled[$x])."</td>
                <td align='centre'><input type='hidden' name='details' value='".$subject_handled[$x]."_".$class_handled[$x]."_".$arm_handled[$x]."'></td>
                <td align='centre'><input type='submit' name='delete' value='delete' class='btn btn-danger btn-sm' onclick=\"return confirm_action('delete','$subject_handled[$x]');\"></td>
              </form>
              </tr>";

      }

      echo "</table><p>";
    }

  ?>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$staff_id.""; ?>">
  
  <ul style='color:red;'><?php for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }  ?></ul>

    <div style="margin-top: 30px; font-weight: bold">Class Details</div><hr style="margin: 0 0  20px 0;" color="#000" /> 
    
    <div class="form-group">
      <label>Class</label>
      <select name="class" id="class" class="form-control" onchange="javascript:get_data('load_subjects.php?class='+this.value,'subjects_div')">
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
      <div class="radio">
        <?php
          for ($i=0; $i < count($class_arm); $i++) { 
            echo "<label class='radio-inline' style='padding-right:15px;'><input type='radio' name='arm' value='".strtoupper($class_arm[$i])."' /> ".strtoupper($class_arm[$i])." </label>";
          }

        ?>
      </div>
    </div>

    <div id='subjects_div' class="form-group">
      
        
      </select>      
    </div>
    <div  class="input-group">
      <input type="submit" value="Add" class="btn btn-success form-control" id="btnAdd" name="btnAdd" style="display: none;">
      <a class="btn btn-warning form-control" id="btnBack" name="back" href='back.php'>Back</a>
    </div>
  </form>
</div>


<?php

include_once("footer.php");

exit();

}

?>

<div class='container'>
  <h2 align='center'>Change Staff Priviledge</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <p><!-- <form method='POST' action=''> -->
    <div class='form-control'>Search database for Staff
      <div class='btn-group' style='width:100%;'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' oninput="javascript:
        var data=document.getElementById('search'); get_data('search_for_staff.php?name='+data.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div></p>
		<div id='display_result'></div>
		
		<div>
		<a href='back.php' class='btn btn-warning btn-lg'>Back</a>
		</div>

</div>

<?php

include_once("footer.php");

?>
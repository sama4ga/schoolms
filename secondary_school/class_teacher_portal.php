<?php
include_once("auth.php");
if ($priviledge !== "class_teacher") {
  header("location:forbidden.php");
   exit();
}
include_once("header.php");
include_once("connect.php");

$msg=array();

if (isset($_POST['compute_result'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];

    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:compute_result(copy).php?class=$class&arm=$arm");
    }
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}elseif (isset($_POST['behaviour'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];

    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:affective.php?class=$class&arm=$arm");
    }
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}elseif (isset($_POST['attendance'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];
    
    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:attendance.php?class=$class&arm=$arm");
    }
    
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}elseif (isset($_POST['create_attendance_sheet'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];
    
    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:create_attendance_sheet.php?class=$class&arm=$arm");
    }
    
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}elseif (isset($_POST['create_result_sheet'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];
    
    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:create_result_sheet(copy).php?class=$class&arm=$arm");
    }
    
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}elseif (isset($_POST['record_scores'])) {
  if (isset($_POST['info'])) {
    $info=$_POST['info'];
    
    if (is_array($info)) {
       $msg[]="Please check one box at a time";
    }else {
      $prop=explode("_",$info);

      $class=$prop[0];
      $arm=$prop[1];
      $subject=$prop[2];

      //$class=preg_replace("/[^A-Za-z0-9_-]/", "", $class);
      header("Location:result.php?class=$class&arm=$arm&subject=$subject");
    }
    
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}

$staff_id=$_SESSION['staff_id'];
$class_handled=$_SESSION['class_handled'];
$session=$_SESSION['session'];
$term=$_SESSION['term'];

$formatted=explode("_",$class_handled);
$class_formatted=$formatted[0];
$arm_formatted=$formatted[1];



echo "<h2 align='center'>Class Teacher Portal</h2>";
echo "Class in-charge: <b style='color:red;'>".strtoupper($class_formatted)."</b><br/>";
echo "Arm in-charge: <b style='color:red;'>".strtoupper($arm_formatted)."</b><br/>";
echo "Session: <b style='color:red;'>".strtoupper($session)." academic session</b><br/>";
echo "Term: <b style='color:red;'>".strtoupper($term)." term</b><br/>";


$atd_id="atd_student_".strtolower(str_replace("/","_",$session))."_".strtolower($term)."_".$class_formatted."_".$arm_formatted;
$temp = $atd_id;
$res_id=str_replace("atd_student","res_id",$temp);

echo "<div style='margin-top:50px;'></div>";

if (!$con->query("DESCRIBE `$atd_id`")) {
  echo "<div class='btn-group'>
          <div>
            <a href='create_student_attendance_sheet.php?class=$class_formatted&arm=$arm_formatted' class='btn-success btn-sm form-control'>Create Attendance Sheet</a>
          </div>

        </div>";

}else{
  echo "<div class='btn-group'>

          <div>
            <a href='student_attendance.php?class=$class_formatted&arm=$arm_formatted' class='btn-success btn-sm form-control'>Mark Attendance</a>
          </div>

          <div>
            <a href='view_student_attendance(copy).php?atd_id=$atd_id' class='btn-success btn-sm form-control'>View Student Attendance Sheet</a>
          </div>

        </div>";
}



if (!$con->query("DESCRIBE `$res_id`")) {
  echo "<div class='btn-group'>

        <div>
          <a href='create_result_sheet(copy).php?class=$class_formatted&arm=$arm_formatted' class='btn-success btn-sm form-control'>Create Result Sheet</a>
        </div>
        
      </div>";

}else{
  echo "<div class='btn-group'>

        <div>
          <a href='affective.php?class=$class_formatted&arm=$arm_formatted' class='btn-success btn-sm form-control'>Record Student Behaviour</a>
        </div>

        <div>
          <a href='compute_result(copy).php?class=$class_formatted&arm=$arm_formatted' class='btn-success btn-sm form-control'>Compute Result</a>
        </div>

        <div>
          <a href='result_spreadsheet(copy).php?res_id=$res_id&class=$class_formatted' class='btn-success btn-sm form-control'>View Result Spreadsheet</a>
        </div>

      </div>";
}





// display class teacher class info
$result=$con->query("SELECT `class`,`subject`,`arm` FROM `staff_class`
                          WHERE `staff_id`='$staff_id' ORDER BY class");
  
  if ($result->num_rows > 0) {

    echo "<div style='padding-top:50px;'>
          <form method='POST'>
            <ul style='color:red;'>";
              for ($i=0; $i < count($msg); $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
              }
    echo "  </ul>

            <table class='table' style='' align='left'>
              <th></th>
              <th>Class</th>
              <th>Arm</th>
              <th>Subject(s)</th>";
    
    $count=0;
    
    while ($row=$result->fetch_assoc()) {
      $class[$count]=$row['class'];
      $arm[$count]=$row['arm'];
      $subject[$count]=$row['subject'];

      echo "<tr>
      
              <td>
                <input type='checkbox' name='info' value='".$class[$count].'_'.$arm[$count].'_'.$subject[$count]."'>
              </td>

              <td>".
                strtoupper($class[$count])
              ."</td>

              <td>".
                strtoupper($arm[$count])
              ."</td>

              <td>".
                $subject[$count]
              ."</td>
              
            </tr>";
    }

    echo "</table>";
    
    
    
    
    
    echo "<div>With selected: 
          <table>
          
            <tr>            

              <td>
                <input type='submit' name='record_scores' value='Record Scores' class='btn-success btn-sm form-control'>
              </td>

            </tr>


          </table>
        </div>
      </form>
      </div>";
  }
  
  
?>
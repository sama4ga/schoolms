<?php
include_once("connect.php");
include_once("header.php");

include_once("auth.php");
if ($auth == 'true' && ($priviledge !== 'teaching_staff')) {
  header("location:forbidden.php");
   exit();
}

$msg=array();

if (isset($_POST['result'])) {
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
      header("Location:create_result_sheet.php?class=$class&arm=$arm");
    }
    
  }else{
    $msg[]="Choose one of the checkboxes to proceed";
  }
  
}

$staff_id=$_SESSION['staff_id'];
$session=$_SESSION['session'];
$term=$_SESSION['term'];



echo "<div><h2 align='center'>Class Portal</h2>";
echo "Session: <b style='color:red;'>".strtoupper($session)." academic session</b><br/>";
echo "Term: <b style='color:red;'>".strtoupper($term)." term</b><br/></div>";


$result=$con->query("SELECT `class`,`subject`,`arm` FROM `staff_class`
                          WHERE `staff_id`='$staff_id' ORDER BY class");
  
  if ($result->num_rows > 0) {
    echo "<div style='margin:30px;'><form method='POST'>
            <ul style='color:red;'>";
              for ($i=0; $i < count($msg); $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
              }
    echo "  </ul>
            <table border='1' cellpadding='15' id='table1' cellspacing='10'>
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
              <td><input type='checkbox' name='info' value='".$class[$count].'_'.$arm[$count].'_'.$subject[$count]."' class='checkbox'></td>
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
  }
  
  echo "<div style='margin-top:20px;'>With selected: <table border='0' cellpadding='1' cellspacing='1'>
          <tr>
            <!-- td>
              <input  type='submit' name='attendance' value='Mark Attendance' class='btn btn-success btn-sm form-control'>
            </td -->
            <td>
              <input type='submit' name='result' value='Record Scores' class='btn btn-success btn-sm form-control'>
            </td>
            <!--td>
              <input type='submit' name='create_attendance_sheet' value='Create Attendance Sheet' class='btn btn-success btn-sm form-control'>
            </td -->
            <!-- td>
              <input type='submit' name='create_result_sheet' value='Create Result Sheet' class='btn btn-success btn-sm form-control'>
            </td -->
          </tr>
        </table></div>
      </form></div>";
?>
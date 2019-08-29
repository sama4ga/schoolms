<?php
//session_start();
include_once("header.php");
include_once("connect.php");

$msg=array();

if (isset($_POST['submit'])) {
  
  $present=$_POST['present'];
  $nature=$_POST['nature'];
  $atd_id=$_GET['atd_id'];
  
  if (isset($_POST['atd_date']) && $_POST['atd_date'] !="") {
    $today_raw = date('Y-m-d',strtotime($_POST['atd_date']));
  }else {    
    $today_raw = date('Y-m-d',time());
  }


  // check if record already exists
  $result=$con->query("SELECT * FROM `$atd_id` WHERE `dd`='$today_raw'");
  if ($result->num_rows == 0) {
    
    // no record found, insert new record
    $con->query("INSERT INTO `$atd_id`(`dd`) VALUES('$today_raw')");
  
  }
  
  // mark the attendance

  // check for mid-term breaks
  if ($nature == "MTB") {
    for ($i=0; $i < count($present); $i++) { 
      $con->query("UPDATE `$atd_id` SET `$present[$i]`='MTB' WHERE `dd`='$today_raw'");
    }

    // check for public holiday
  }elseif ($nature == "PHD") {
    for ($i=0; $i < count($present); $i++) { 
      $con->query("UPDATE `$atd_id` SET `$present[$i]`='PHD' WHERE `dd`='$today_raw'");
    }

    // no break, mark the attendance
  }else{
    for ($i=0; $i < count($present); $i++) { 
      $con->query("UPDATE `$atd_id` SET `$present[$i]`='1' WHERE `dd`='$today_raw'");
    }
  }
  
  

  echo "Attendance successfully marked.
        <a href='javascript:history.back()' class='btn btn-warning'>Click here to go back</a>";

  //var_dump($present);
}else {

  $session=strtolower($_SESSION['session']);
  $term=strtolower($_SESSION['term']);
  $class=strtolower($_GET['class']);
  $arm=strtolower($_GET['arm']);
  $session_format=str_replace("/","_",$session);

  $atd_id="atd_student_".$session_format."_".$term."_"."".$class."_".$arm;

  // check if attendance has been created
  if (!$con->query("DESCRIBE `$atd_id`")) {
    echo "<div style='color:red;'>
            Attendance sheet not yet created.<br/>
            Create attendance sheet and try again.<br/>
            <a href='javascript:history.back()' class='btn btn-warning'>Click here to go back</a>
          </div>";
        exit();

  }


  //import all class members
  $get_results = $con->query("SELECT * FROM `student` s LEFT JOIN `student_class` sc 
                              ON sc.`std_id`=s.`std_id` 
                              WHERE sc.`class`='$class' AND sc.`arm`='$arm' AND sc.`session`='$session'");

  $z=0;
  $today = date('D, M d, Y');

  $no_of_results=0; 

  if($get_results){

    $no_of_results = $get_results->num_rows;

    echo "<div class='container'>
          Attendance for ".strtoupper($class)." ".strtoupper($term)." term ".$session." Academic Session
          <div style='margin-top:30px;'>Date: <b>".$today."</b>";
    echo "<form method='POST' action='student_attendance.php?atd_id=$atd_id'>
            <ul style='color:red;'>";
            for ($i=0; $i < count($msg); $i++) { 
            echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }
    echo "</ul>
            
          <div class ='form-control container'  style='width:500px; margin:30px 0 30px 0;'><b>Or choose date</b>
            <div style='margin-bottom:10px;'>
              <label>Date</label>
              <input type='date' name='atd_date' class='form-control' style='width:200px;'>
            </div>
          </div>";

    // make provision for mid-term breaks and public holidays
    echo "<div class='form-control container' style='width:500px;margin-bottom:30px;'>
            <div style='margin-bottom:10px;'>
              <label class='form-label'>Nature</label>
              <select name='nature' class='form-control' style='width:200px;'>
              <option value='Regular' selected>Regular</option>
              <option value='MTB'>Mid-Term Break</option>
              <option value='PHD'>Public Holiday</option>
              </select>
            </div>
          </div>";


    echo  "<div style='color:red;margin-bottom:50px;'>Tick the box beside if the student is present. <br/>
              <b>Note: Not ticking the box means the student is absent.</b>
          </div>
            <table cellpadding='15' cellspacing='60' class='table'>
            <th>Student's Name</th>
            <th>Present <input type='checkbox' onchange=\"mark_all('present[]')\" title='mark all' class='checkbox'></th>";
    while($row = $get_results->fetch_assoc()){				
      $z++;
      $surname_this[$z] = strtoupper($row['surname']);
      $other_names_this[$z] = strtoupper($row['othernames']);		
      $std_id[$z] = $row['std_id'];

      echo "<tr>
              <td>".$surname_this[$z].", ".$other_names_this[$z]."</td>
              <td><input type='checkbox' name='present[]' value='".$std_id[$z]."' class='checkbox'></td>
            </tr>";
    }
    echo "   <tr>
                <td><input type='submit' name='submit' class='btn btn-success form-control' value='Submit'></td>
                <td><a href='javascript:history.back();' class='btn btn-warning'>Back</a></td>
              </tr>
            </table>
          </form>";
  }else {
  echo "An error occured ".$con->error;
  }
}
 
echo "</div>";

include_once("footer.php");
?>

<script>

count = 0;
function mark_all(div){
  count++;
  var box = document.getElementsByName(div);
  if (count%2 == 1) {
    box.forEach(val => {
      val.checked = true;
    });
  }else{
    box.forEach(val => {
      val.checked = false;
    });
  }
  
}

</script>
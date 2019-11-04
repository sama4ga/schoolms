<?php
require_once("connect.php");
include_once("head.php");


$msg=array();

if (isset($_POST['submit'])) {

  $class=$_POST['class'];
  $arm=$_POST['arm'];
  $action=$_POST['action'];
  $session=$_POST['session'];
  $term = $_REQUEST['term'];

  if ($class == "default") {
    $msg[]="Choose class to proceed";
  }
  if ($arm == "default") {
    $msg[]="Choose arm to proceed";
  }
  if ($action == "default") {
    $msg[]="Choose action to proceed";
  }

  if (empty($msg)) {

    $session_format= str_replace("/", "_", $session);
    $res_id="res_id_".$session_format."_".$term."_".$class."_".$arm;
    
    switch ($action) {
      case 'compute_result':
      header("location:compute_result_2ndcum.php?class=$class&arm=$arm&session=$session&term=$term");
        break;

      case 'record_scores':
      header("location:record_scores.php?resid=$res_id&class=$class");
        break;

      case 'view_result':
      header("location:view_result.php?resid=$res_id&class=$class&session=$session&term=$term");
        break;

      case 'create_result_sheet':
        header("location:create_result_sheet(copy).php?class=$class&arm=$arm&session=$session&term=$term");
        break;

      case 'create_student_attendance_sheet':
        header("location:create_student_attendance_sheet.php?class=$class&arm=$arm");
        break;

      case 'psychomotor':
        header("location:affective.php?class=$class&arm=$arm");
        break;

      case 'spreadsheet':
        header("location:result_spreadsheet(copy).php?class=$class&res_id=$res_id");
        break;

      case 'view_available_result_sheets':
        header("location:view_available_result_sheets.php?session=$session&term=$term");
        break;

      case 'attendance':
        $atd_id = "atd_student_".$session_format."_".$term."_".$class."_".$arm;
        //echo $atd_id;exit();
        header("location:view_student_attendance(copy).php?atd_id=$atd_id");
        break;
      
      default:
        
        break;
    }
  }

}

  

?>

<div style="margin-bottom:25px;">
<h2 align='center'>Result Manager</h2>
<form method="POST" action="">
  <ul style='color:red;'>
    <?php 
      for ($i=0; $i < count($msg) ; $i++) { 
        echo "<li style='list-style:none;'>".$msg[$i]."</li>";
      }  
    ?>
  </ul>

  <div class="form-group">
    <label>Class</label>
    <select name="class" class="form-control">
      <option value="default" selected>Choose class</option>
      <optgroup>
        <option value="jss 1">JSS 1</option>
        <option value="jss 2">JSS 2</option>
        <option value="jss 3">JSS 3</option>
      </optgroup>
      <optgroup>
        <option value="ss 1">SS 1</option>
        <option value="ss 2">SS 2</option>
        <option value="ss 3">SS 3</option>
      </optgroup>
      
    </select>
  </div>

  <div class="form-group">
    <label>Arm</label>
    <select name="arm" class="form-control">
      <option value="default" selected>Choose arm</option>
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

  <div class="form-group">
    <label>Session</label>
    <select name="session" class="form-control">
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

  <div class="form-group">
    <label>Term</label>
    <select name="term" class="form-control">
      <option value="default" selected>Choose term</option>
      <optgroup>Term
        <option value="first">First</option>
        <option value="second">Second</option>
        <option value="third">Third</option>
      </optgroup>
    </select>
  </div>

  <div class="form-group">
    <label>Action</label>
    <select name="action" class="form-control">
      <option value="default" selected>Choose one</option>
      <optgroup>Result
        <option value="create_result_sheet">Create Result Sheet</option>
        <option value="record_scores">Record/Update Scores</option>
        <option value="psychomotor">Record Student Behaviour</option>
        <option value="compute_result">Compute Result</option>
        <option value="spreadsheet">View Result Spreadsheet</option>
        <option value="view_result">View Computed Result</option>
      </optgroup>
      <optgroup>
        <option value="view_available_result_sheets">View Available Result Sheets</option>
      </optgroup>
      <optgroup>Attendance
        <option value="create_student_attendance_sheet">Create Attendance Sheet</option>
        <option value="attendance">View Student Attendance</option>
      </optgroup>
    </select>
  </div>

  <div class="input-group">
    <input type="submit" name="submit" value="Submit" class="btn btn-success form-control">
    <a href='back.php' class='btn btn-warning form-control'>Back</a>
  </div>

</form>
</div>

<?php





?>
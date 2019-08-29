<?php
include_once("header.php");


if ($_SESSION['priviledge'] != "admin") {
  header("location:forbidden.php");
  exit();
}


?>


<h1 align='center'>Student Management Portal</h1>

<div style="display: flex;">
  <nav class="navbar navbar-inverse" style="width:250px;align-content:start;">
    <div class="container-fluid" >
      <ul class='nav navbar-nav'>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='new_student_registration.php'">Admit New Student</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='expel_student.php'">Expel Student</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='result_manager.php'">Student Result Manager</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='performance_chart.php'">Student Performance</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='career_recommender.php'">Career Recommender</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='promote_student.php'">Promote Students</a></li>
        <li>
          <a href="#" onclick="javascript:document.getElementById('filter').style='display:block';">
            View Statistics of Students
          </a>
          <div id="filter" style="display:none;" class="form-group">
            <label>Filter by:</label>
            <select class="form-control" onchange="document.getElementById('display').src='statistics.php?group=student&filter='+this.value">
              <option value="state_of_origin">State</option>
              <option value="gender">Gender</option>
              <option value="dob" >Age</option>
            </select>
          </div>
        </li>
        <!--<li><a href="#" onclick="javascript:document.getElementById('display').src='create_student_attendance_sheet.php'">Create Attendance Sheet</a></li>-->
        <li>
          <a href="#" onclick="javascript:document.getElementById('view_cat').style.display='block';" id='view'>View List of Students</a>
          
          <div style='display:none;' id='view_cat'>
            <ul style="list-style:none;">
              <li><a href="#" onclick="javascript:document.getElementById('class_div').style='display:block';" id='view_cat_class'>By Class</a></li>
              <li><a href="#" onclick="javascript:document.getElementById('display').src='view_student_list.php';" id='view_cat_all'>All</a></li>
            </ul>
          </div>
          
          <div style="display:none;" id='class_div' class="form-group">
            <label>Class</label>
            <select name="class" class="form-control" id="class" onchange="javascript:var data=document.getElementById('class').value;
                                                                                      document.getElementById('display').src='view_student_list.php?class='+data">
              <option value="default" selected>select class</option>
              <option value="jss 1">JSS 1</option>
              <option value="jss 2">JSS 2</option>
              <option value="jss 3">JSS 3</option>
              <option value="ss 1">SS 1</option>
              <option value="ss 2">SS 2</option>
              <option value="ss 3">SS 3</option>
            </select>
          </div>
        </li>
      </ul>
    </div>

    <div style="margin-top:30px;"><a href='admin_portal.php' class='btn-warning form-control'>Exit Student manager</a></div>
  </nav>


  <div style="width:100%;" align='right'>
    <iframe id="display" src="back.php"></iframe>
  </div>

</div>


<?php

include_once("footer.php");

?>
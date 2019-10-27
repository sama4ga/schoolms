<?php
include_once("header.php");

if ($_SESSION['priviledge'] != "admin" ) {
  header("location:forbidden.php");
  exit();
}

?>


<h1 align='center'>Miscellaneous Portal</h1>

<div style="display: flex;">
  <nav class="navbar navbar-inverse" style="width:250px;align-content:start;">
    <div class="container-fluid" >
      <ul class='nav navbar-nav'>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='start_new_session.php'">Start New Session</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='backup_database.php'">Backup Database</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='restore_backup.php'">Restore Database</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='upload_result.php'">Upload Results</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='upload_attendance.php'">Upload Attendace</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='change_resumption_date.php'">Change Resumption and Closing Dates</a></li>
        <li><a href="/samaservices/samaservices/login_action.php?username=dmc&password=detipcollege" target="_blank" >Go online</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='add_arm.php'" >Add Arm </a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='edit_arm.php'" >Edit Arm </a></li>
        <li><a href="#" onclick="javascript:document.getElementById('class_div').style='display:block';" id='view_cat_class'>Edit Subjects</a>

          <div style="display:none;" id='class_div'>
            <label>Class</label>
            <select name="class" class="form-control" id="class" onchange="javascript:var data=document.getElementById('class').value;
                                                                                      document.getElementById('display').src='edit_subjects.php?class='+data">
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
        
        <li><a href="#" onclick="javascript:document.getElementById('display').src='update_license.php'" >Update License</a></li>
      </ul>
    </div>

    <div><a href='admin_portal.php' class='btn btn-warning form-control'>Exit Miscellaneous Portal</a></div>
  </nav>


  <div style="width:100%;" align='right'>
    <iframe id="display"></iframe>
  </div>

</div>


<?php

include_once("footer.php");

?>
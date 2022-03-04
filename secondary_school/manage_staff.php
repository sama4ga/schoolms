<?php
include_once("header.php");
require_once("connect.php");



if ($_SESSION['priviledge'] != "admin" ) {
  header("location:forbidden.php");
  exit();
}

?>

<h1 align='center'>Staff Management Portal</h1>

<div id='info' style='color:red;'></div>

<div style="display: flex;">
  <nav class="navbar navbar-inverse" style="width:250px;align-content:start;">
    <div class="container-fluid" >
      <ul class='nav navbar-nav'>
      
       <li><a href="#" onclick="javascript:document.getElementById('display').src='staff_registration.php'">Admit New Staff</a></li>
        
        <?php

          $session=strtolower($_SESSION['session']);
          $term=strtolower($_SESSION['term']);
          
          $session_format=str_replace("/","_",$session);
          
          $atd_id="atd_staff_".$session_format."_".$term;

          if (!$con->query("DESCRIBE `$atd_id`")) {
            ?>
            <li><a href="javascript: get_data('create_staff_attendance_sheet.php','info');">Create Staff Attendance Sheet</a></li>
            <?php
          }

        ?>
        <?php echo "<li><a href='staff_attendance.php?atd_id=$atd_id' target='_blank'>Staff Attendance</a></li>"; ?>
        <?php echo "<li><a href='view_staff_attendance.php?atd_id=$atd_id'>View Staff Attendance</a></li>"; ?>

       
        <li><a href="#" onclick="javascript:document.getElementById('display').src='sack_staff.php'">Sack Staff</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='change_priviledge.php'">Change Staff Priviledge</a></li>
       <!--  <li><a href="#" onclick="javascript:document.getElementById('display').src='pay_staff.php'">Pay Staff</a></li> -->
        <li><a href="#" onclick="javascript:document.getElementById('display').src='query_staff.php'">Query Staff</a></li>
        <!-- <li><a href="#" onclick="javascript:document.getElementById('display').src='promote_staff.php'">Promote Staff</a></li> -->
        <li><a href="#" onclick="javascript:document.getElementById('display').src='change_staff_subject.php'">Change Staff Subject</a></li>
        <li>
        <li class="divider"><a href="#" onclick="javascript:document.getElementById('display').src='view_staff_list.php'">View List of Staff</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('filter').style='display:block';">
            View Statistics of Staffs
          </a>
          <div id="filter" style="display:none;">Filter by:
            <select class="form-control" onchange="document.getElementById('display').src='statistics.php?group=staff&filter='+this.value">
              <option value="state_of_origin">State</option>
              <option value="gender">Gender</option>
              <option value="dob" >Age</option>
            </select>
          </div>
        </li>
      </ul>
    </div>

    <div style="margin-top:30px;"><a href='admin_portal.php' class='btn-warning form-control'>Exit Staff Management Portal</a></div>
  
  </nav>

  


  <div style="width:100%;" align='right'>
    <iframe id="display" src="back_staff.php"></iframe>
  </div>

</div>


<script>
  var menus = document.querySelectorAll(".nav li a");
  for (let index = 0; index < menus.length; index++) {
    menus[index].addEventListener("click", function(){menu_clicked(menus[index]);});    
  }

  function menu_clicked(menu_item){
    menus = document.querySelectorAll(".nav li a");
    for (let index = 0; index < menus.length; index++) {
      menus[index].className = "";    
    }
    menu_item.className = "active";

  }
</script>
<?php
include_once("footer.php");

?>
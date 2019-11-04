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

if (isset($_POST['submit'])) { 

  

	$staff_name=$_POST['submit'];
  $staff_id=$_POST['staff_id'];
  

  // delete staff details
  $result=$con->query("DELETE FROM  `staff` WHERE `staff_id`='$staff_id'");

  // delete staff class
  $result=$con->query("DELETE FROM  `staff_class` WHERE `staff_id`='$staff_id'");
  
  // delete staff from attendance sheet
  $result=$con->query("ALTER TABLE `atd_id`  DROP `$staff_id`");

  echo "<div style='color:red;'>$staff_name successfully sacked</div>
				<a href='javascript:history.back();' class='btn btn-warning form-control'>Back</a>";
				exit();
      
}
$con->close();
?>

<div class='container'>
  <div align='center'><b>Sack Staff</b></div>

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
        var data=document.getElementById('search'); get_data('search_for_staff(copy).php?name='+data.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div></p>
		<div id='display_result'></div>
		
		<div>
		<a href='back.php' class='btn btn-warning form-control'>Back</a>
		</div>

</div>


<!-- <script type='text/javascript'>

function confirm_action(full_name) {
  var result=confirm("Do you really want to sack " + full_name + "?");
  if (result) {
    return true;
  }else{
    return false;
  }
}


</script> -->


<?php

include_once("footer.php");

?>
<?php
require_once("connect.php");
include_once("head.php");

$msg=array();

if (isset($_POST['change'])) {
  
  $class=$_POST['class'];
  $arm=$_POST['arm'];
  $priviledge=$_POST['priviledge'];
  $position=$_POST['position'];
  $staff_id=$_GET['sid'];
  $full_name=$_GET['name'];


  if ($class=="default") {
    $class_formatted="";
  }else {
    $class_formatted=$class."_".$arm;
  }

  $result=$con->query("UPDATE `staff` SET `position`='$position', 
                       `priviledge`='$priviledge', 
                       `class`='$class_formatted'
                      WHERE `staff_id`='$staff_id'");

  if ($result) {
    $msg[]=$full_name."'s priviledge successfully changed";
  }

}

if (isset($_POST['submit'])) {
  
  $staff_id=$_POST['staff_id'];
  $full_name=$_POST['submit'];

  $result=$con->query("SELECT * FROm`staff` WHERE `staff_id`='$staff_id'");
  if ($result->num_rows > 0) {
    
    while ($row=$result->fetch_assoc()) {
      
      $priviledge=$row['priviledge'];
      $position=$row['position'];
      $class_formatted=$row['class'];
      
    }


    if ($class_formatted !== "") {
      
      $class_split=explode("_",$class_formatted);
      $class=$class_split[0];
      $arm=$class_split[1];

    }



    ?>
      <div>
        <h2 align='center'>Change Staff Priviledge</h2>
        <?php echo "<div>Staff Name: <b style='color:red;'>$full_name</b></div>
        
          <form method='POST' action='change_priviledge.php?sid=$staff_id&name=$full_name' class='form-control'>"; ?>

          <ul style='color:red;'>
            <?php 
              for ($i=0; $i < count($msg) ; $i++) { 
                echo "<li style='list-style:none;'>".$msg[$i]."</li>";
              }  
            ?>
          </ul>

          <div class="form-group">
            <label>Staff Priviledge</label>
            <select name="priviledge" class="form-control">
            <?php
              switch ($priviledge) {
                case 'teaching_staff':
                  echo "<option value='default'>choose staff priviledge</option>
                        <option value='teaching_staff' selected >Teaching Staff</option>
                        <option value='class_teacher'>Class Teacher</option>
                        <option value='non_teaching_staff'>Non Teaching Staff</option>
                        <option value='admin'>Admin</option>
                        <option value='pro'>Public Relations Officer</option>
                        <option value='account'>Account</option>
                        <option value='bursar'>Bursar</option>";
                  break;
                case 'non_teaching_staff':
                  echo "<option value='default'>choose staff priviledge</option>
                        <option value='teaching_staff'>Teaching Staff</option>
                        <option value='class_teacher'>Class Teacher</option>
                        <option value='non_teaching_staff' selected >Non Teaching Staff</option>
                        <option value='admin'>Admin</option->
                        <option value='pro'>Public Relations Officer</option>
                        <option value='account'>Account</option>
                        <option value='bursar'>Bursar</option>";
                    break;
                case 'class_teacher':
                  echo "<option value='default'>choose staff priviledge</option>
                        <option value='teaching_staff'>Teaching Staff</option>
                        <option value='class_teacher' selected >Class Teacher</option>
                        <option value='non_teaching_staff' >Non Teaching Staff</option>
                        <option value='admin'>Admin</option>
                        <option value='pro'>Public Relations Officer</option>
                        <option value='account'>Account</option>
                        <option value='bursar'>Bursar</option>";
                    break;
                case 'account':
                echo "<option value='default'>choose staff priviledge</option>
                      <option value='teaching_staff'>Teaching Staff</option>
                      <option value='class_teacher'>Class Teacher</option>
                      <option value='non_teaching_staff' >Non Teaching Staff</option>
                      <option value='admin'>Admin</option>
                      <option value='pro'>Public Relations Officer</option>
                      <option value='account' selected>Account</option>
                      <option value='bursar'>Bursar</option>";
                  break;
                case 'bursar':
                echo "<option value='default'>choose staff priviledge</option>
                      <option value='teaching_staff'>Teaching Staff</option>
                      <option value='class_teacher'>Class Teacher</option>
                      <option value='non_teaching_staff' >Non Teaching Staff</option>
                      <option value='admin'>Admin</option>
                      <option value='pro'>Public Relations Officer</option>
                      <option value='account'>Account</option>
                      <option value='bursar' selected>Bursar</option>";
                  break;
                case 'pro':
                echo "<option value='default'>choose staff priviledge</option>
                      <option value='teaching_staff'>Teaching Staff</option>
                      <option value='class_teacher'>Class Teacher</option>
                      <option value='non_teaching_staff' >Non Teaching Staff</option>
                      <option value='admin'>Admin</option>
                      <option value='pro' selected>Public Relations Officer</option>
                      <option value='account'>Account</option>
                      <option value='bursar'>Bursar</option>";
                  break;
                default:
                  echo "<option value='default' selected>choose staff priviledge</option>
                        <option value='teaching_staff'>Teaching Staff</option>
                        <option value='class_teacher'>Class Teacher</option>
                        <option value='non_teaching_staff'>Non Teaching Staff</option>
                        <option value='admin'>Admin</option>
                        <option value='pro'>Public Relations Officer</option>
                        <option value='account'>Account</option>
                        <option value='bursar'>Bursar</option>";
                  break;
              }

            ?>
            </select>
          </div>

          <div class="form-group">
            <label>Class</label>
            <select name="class" class="form-control" >
            <?php
              switch ($class) {
                case 'jss 1':
                  echo "<option value='jss 1' selected >JSS 1</option>
                        <option value='jss 2'>JSS 2</option>
                        <option value='jss 3'>JSS 3</option>
                        <option value='ss 1'>SS 1</option>
                        <option value='ss 2'>SS 2</option>
                        <option value='ss 3'>SS 3</option>";
                  break;
                case 'jss 2':
                  echo "<option value='jss 1'>JSS 1</option>
                        <option value='jss 2' selected >JSS 2</option>
                        <option value='jss 3'>JSS 3</option>
                        <option value='ss 1'>SS 1</option>
                        <option value='ss 2'>SS 2</option>
                        <option value='ss 3'>SS 3</option>";
                  break;
                case 'jss 3':
                  echo "<option value='jss 1' >JSS 1</option>
                        <option value='jss 2'>JSS 2</option>
                        <option value='jss 3' selected >JSS 3</option>
                        <option value='ss 1'>SS 1</option>
                        <option value='ss 2'>SS 2</option>
                        <option value='ss 3'>SS 3</option>";
                  break;
                case 'ss 1':
                  echo "<option value='jss 1' >JSS 1</option>
                        <option value='jss 2'>JSS 2</option>
                        <option value='jss 3'>JSS 3</option>
                        <option value='ss 1' selected >SS 1</option>
                        <option value='ss 2'>SS 2</option>
                        <option value='ss 3'>SS 3</option>";
                  break;
                case 'ss 2':
                  echo "<option value='jss 1'>JSS 1</option>
                        <option value='jss 2'  >JSS 2</option>
                        <option value='jss 3'>JSS 3</option>
                        <option value='ss 1'>SS 1</option>
                        <option value='ss 2' selected >SS 2</option>
                        <option value='ss 3'>SS 3</option>";
                  break;
                case 'ss 3':
                  echo "<option value='jss 1' >JSS 1</option>
                        <option value='jss 2'>JSS 2</option>
                        <option value='jss 3'  >JSS 3</option>
                        <option value='ss 1'>SS 1</option>
                        <option value='ss 2'>SS 2</option>
                        <option value='ss 3' selected >SS 3</option>";
                  break;
                
                default:
                  echo "<option value='jss 1' >JSS 1</option>
                    <option value='jss 2'>JSS 2</option>
                    <option value='jss 3'  >JSS 3</option>
                    <option value='ss 1'>SS 1</option>
                    <option value='ss 2'>SS 2</option>
                    <option value='ss 3' >SS 3</option>";
                  break;
              } 
            ?>
            </select>
          </div>

          <div class="form-group">
            <label>Arm</label>
            <select name="arm" class="form-control">
              <option value="default">choose arm</option>
              <?php

                $result=$con->query("SELECT * FROM `arm`");

                if($result->num_rows > 0){

                  while($row=$result->fetch_assoc()){

                    if(strtolower($arm) == strtolower($row['arm'])){
                      
                      echo "<option value='".$row['arm']."' selected='selected'>".strtoupper($row['arm'])."</option>";              

                    }else {

                      echo "<option value='".$row['arm']."'>".strtoupper($row['arm'])."</option>";              

                    }

                    
                  }
                }

              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Position</label>
            <select name='position' class='form-control'>
              <option value='default'>Choose staff position</option>
              <?php

                $xml=simplexml_load_file("staff_position.xml") or die("Error: cannot create xml object");
                
                for ($i=0; $i < count($xml->pos); $i++) { 

                  if(strtolower($position) == strtolower($xml->pos[$i]['value'])){
                      
                    echo "<option value='".$xml->pos[$i]['value']."' selected='selected'>".$xml->pos[$i]."</option>";

                  }else {
                    
                    echo "<option value='".$xml->pos[$i]['value']."'>".$xml->pos[$i]."</option>";

                  }
                  
                
                }
              
                ?>

            </select>
          </div>

          <div class="input-group">
            <input type='submit' name='change' value='Submit' class='btn btn-success form-control'>
		        <a href='back.php' class='btn btn-warning form-control'>Back</a>
          </div> 

        </form>

      </div>

    <?php

  }


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
		<a href='back.php' class='btn btn-warning form-control'>Back</a>
		</div>

</div>



<?php

include_once("footer.php");

?>
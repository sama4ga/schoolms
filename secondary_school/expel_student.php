<?php
require_once("connect.php");
include_once("head.php");


$msg=array();



if (isset($_POST['submit'])) {

  $std_id=$_POST['std_id'];
  $full_name=$_POST['full_name'];
//echo $std_id;
  


  $result=$con->query("DELETE FROM `student` WHERE `std_id`='$std_id'");
  if ($result) {

    $msg[]=$full_name." successfully expelled";
  
  }else {

    $msg[]="Error encountered while expelling ".$full_name." ".$con->error;
  
  }

  
}

  

?>


<div class='container'>
  <h2 align='center'>Expel Student</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <!-- <form method='POST' action=''> -->
    <div class='form-control' style="margin-bottom:50px;">Search database for student
      <div class='btn-group' style='width:100%;'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="Enter student name" oninput="javascript:
        var data=document.getElementById('search'); get_data('search_for_student.php?name='+data.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div>
  


  <div class='form-control'>Or search by student record
      
    <div>
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

    <div>
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

    <div>
      
      <div class='btn-group form-control'>
        <div style='display:flex;'>
          <label>Surname</label>
          <input type='text' name='surname' id='surname' class='form-control' oninput="javascript:
        var data=document.getElementById('surname'); get_data('search_for_student.php?name='+data.value,'display_result');">
        </div>
        <div style='display:flex;'>
          <label>Othernames</label>
          <input type='text' name='othernames' id='othernames' class='form-control' oninput="javascript:
        var data=document.getElementById('othernames'); get_data('search_for_student.php?name='+data.value,'display_result');">
        </div>
      </div>
    </div>
  </div>

  <div id='display_result'></div>
  

  <a href='back.php' class='btn btn-warning form-control'>Back</a>
   
</div>

<!-- <script type='text/javascript'>

  function confirm_action(full_name) {
    var result=confirm("Do you really want to expel " + full_name + "?");
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
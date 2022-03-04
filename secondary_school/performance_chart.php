<?php
require_once("connect.php");
include_once("head.php");


$msg=array();

if (isset($_POST['submit'])) {
  
  $std_id=$_REQUEST['std_id'];
  $std_name=$_REQUEST['full_name'];
  //$std_class=$_REQUEST['class'];
  //$std_arm=$_REQUEST['arm'];
  
  // get available result sheets
  $result=$con->query("SELECT * FROM `existing_result_sheets`");
  if ($result) {
    
    $no_of_results=$result->num_rows;
    if ($no_of_results > 0) {

      while ($row=$result->fetch_assoc()) {
        $avail_results[]=$row['result_id'];
      }

          
      // get term and session details
      $j=0;
      for ($i=0; $i < $no_of_results; $i++) { 
        
        $details=explode("_",$avail_results[$i]);
        $session[$i]=$details[2]."/".$details[3];
        $term[$i]=$details[4];
        $class[$i]=$details[5];
        $arm[$i]=$details[6];
        
        
        // get student record from available result sheets
        
        $result=$con->query("SELECT * FROM `$avail_results[$i]` WHERE `std_id`='$std_id'");
        if ($result) {
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              
              //$std_name=$row['surname'].", ".$row['othernames'];
              $total_score[$j]=$row['total_score'];
              $average[$j]=$row['average'];
              $res_class[$j]=$class[$i];
              $arm[$j]=$arm[$i];
              $res_session[$j]=$session[$i];
              $res_term[$j]=$term[$i];
            
              $j++;
            }
          }
        }
      
      }


       // prepare the data for plotting
      for ($i=0; $i < $j; $i++) { 
        $x[$i]=strtoupper($res_class[$i]." ".$res_term[$i]);
        $y[$i]=$total_score[$i];
      
      }



      // display graph of student performance
      echo "<h2 style='align-text:center;'>Performance Chart</h2>";
      echo "<h3>Student Name: <b>$std_name</b></h2>";
      $x=json_encode($x);
      $y=json_encode($y);//var_dump($y);
      $title="Student Performance Chart";
      echo("<img src='show_graph.php?x=$x&y=$y&title=$title' />");
      

      
  
    }else {
      echo "<div>No record found</div>";
    }

  }else {
    echo "<div>Error getting record ".$con->error."</div>";
  }
  
  
  
 exit();  
  
  
}  
  
?>


<div class='container'>
  <h2 align='center'>Student Performance Chart</h2>

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
          get_data('search_student.php?name='+this.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div>
  


  <div class='panel panel-default'>
    <div class="panel-heading" style="margin-bottom:50px;">Or search by student reg. no.</div>
    <div class='panel-body'>
      <div class="form-group">Search database for student
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="Enter student reg. no." oninput="javascript:
        get_data('search_student_with_regno.php?regno='+this.value,'display_result');">
      </div>
    </div>
  </div>
      
    

  <div id='display_result'></div>
  

  <a href='back.php' class='btn btn-warning form-control'>Back</a>
   
</div>




<?php

include_once("foot.php");



?>
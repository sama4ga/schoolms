<?php
require_once("connect.php");

$data=mysqli_real_escape_string($con,$_GET['name']);

$result=$con->query("SELECT * FROM `staff` WHERE `staff_id` <> '1' AND `surname` LIKE '%$data%' OR `othernames` LIKE '%$data%' ");

if ($result) {

  echo "<ul style='list-style:none'>";

  for ($i=0; $i < $result->num_rows; $i++) { 
    
    $result->data_seek($i);
    $row=$result->fetch_assoc();
    $full_name=$row['surname'].", ".$row['othernames'];
    
    if ($row['staff_id'] != 1) {
      
      echo "<li>
              <form method='POST' action='' name='search'>
                <div style='display:flex;'>
                  <input type='submit' class='btn btn-default form-control' name='submit' value='".$full_name."' style='width:90%' onclick=\"return confirm_action('sack',this.value);\"/>
                  <input type='hidden' value='".$row['staff_id']."' name='staff_id' />
                </div>
              </form>
            </li>
            <hr />";   

    }
    
  }
  echo "</ul>";
}else {
  echo "There was an error ".$con->error;
}


?>
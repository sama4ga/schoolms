<?php
require_once("connect.php");

$data=mysqli_real_escape_string($con,$_GET['name']);

if (trim($data) != "") {
  
  $result=$con->query("SELECT * FROM `student` WHERE `surname` LIKE '%$data%' OR `othernames` LIKE '%$data%' ");

  if ($result) {
    echo "<div>";

    for ($i=0; $i < $result->num_rows; $i++) { 
      $result->data_seek($i);
      $row=$result->fetch_assoc();
      $full_name=$row['surname'].", ".$row['othernames'];
      /* echo "<li style='border-bottom:black 1px;'>
              <form method='POST' action='expel_student.php'>
                <div style='display:flex;'>
                  <div style='width:90%'>".$full_name."</div>
                  <input type='hidden' value='".$full_name."' name='name'>
                  <input type='hidden' value='".$row['std_id']."' name='std_id'>
                  <input type='submit' class='btn btn-danger form-control' name='expel' value='Expel' align='right'>
                </div>
              </form>
            </li>"; */

            /* echo "<li>
              <form method='POST' action='' name='search'>
                <div style='display:flex;'>
                  <input type='submit' class='btn btn-default form-control' name='submit' value='".$full_name."' style='width:90%'/>
                  <input type='hidden' value='".$row['std_id']."' name='std_id' />
                </div>
              </form>
            </li>
            <hr />";  */
      echo "
              <form method='POST' action='' name='search' id='search'>
                <div style='display:flex;'>
                  <div style='width:80%;'>
                    <label>".$full_name."</label>
                    <input type='hidden' value='".$row['std_id']."' name='std_id' />
                    <input type='hidden' value='".$full_name."' name='full_name' />
                  </div>
                  <div>
                    <input type='submit' class='btn btn-danger btn-sm ' name='submit' value='Expel' onclick=\"return confirm_action('expel','$full_name');\"/>
                  </div>
                  </div>
              </form>"; 
      
    }
    echo "</div>";
  }else {
    echo "There was an error ".$con->error;
  }

}else{
  echo " ";
}


?>
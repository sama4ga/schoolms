<?php
require_once("connect.php");

$data=$_GET['name'];

$result=$con->query("SELECT * FROM `student` WHERE `surname` LIKE '%$data%' OR `othernames` LIKE '%$data%' ");

if ($result) {
  echo "<div>";

  for ($i=0; $i < $result->num_rows; $i++) { 
    $result->data_seek($i);
    $row=$result->fetch_assoc();
    $full_name=$row['surname'].", ".$row['othernames'];
    
    echo "
            <form method='POST' action='' name='search' id='search'>
              <div style='display:flex;'>
                <div style='width:80%;'>
                  <label>".$full_name."</label>
                  <input type='hidden' value='".$row['std_id']."' name='std_id' />
                  <input type='hidden' value='".$full_name."' name='full_name' />
                </div>
                <div>
                  <input type='submit' class='btn btn-success btn-sm ' name='submit' value='Proceed' />
                </div>
                </div>
            </form>"; 
    
  }
  echo "</div>";
}else {
  echo "There was an error ".$con->error;
}


?>
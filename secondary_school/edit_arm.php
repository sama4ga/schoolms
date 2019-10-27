<?php
require_once("connect.php");
include_once("head.php");


if (isset($_POST['submit'])) {
  include_once("sanitize.php");

  $arm = strtolower(sanitize($_POST['arm_id']));
  if (trim($arm != "")) {
    
    //echo $arm;exit();
    $result = $con->query("DELETE FROM `arm` WHERE `id` = '$arm'");
    if ($result) {
      echo "Arm successfully deleted";
    }else{
      echo "Error deleting arm ".$con->error;
    }
    
  }

}


$result = $con->query("SELECT * FROM `arm`");
if($result){
  $num_of_arm = $result->num_rows;
  if ($num_of_arm > 1) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      $arm[$x]= ucwords($row['arm']);
      $arm_id[$x] = $row['id'];
      $x++;
    }
  }
}


?>


<div class="container">
  <div>
    <h2>Edit Arms</h2>
    <div>      
      <table class="table">
        
        <tr>
          <th>S/N</th>
          <th>Arm</th>
          <th></th>
        </tr>

        
          <?php
            for ($i=0; $i < $num_of_arm; $i++) {
              $count = $i + 1; 
              echo "<tr>
                      <form action='".$_SERVER['REQUEST_URI']."' method='POST'>
                        <td>".$count."</td>
                        <td>".$arm[$i]."</td>
                        <td>
                          <input type='hidden' value='".$arm_id[$i]."' name='arm_id' />
                          <input type='submit' class='btn btn-danger btn-sm ' name='submit' value='Delete' onclick=\"return confirm_action('delete','arm $arm[$i]');\"/>
                        </td>
                      </form>
                    </tr>";
            }
          ?>
        </tr>
      </table>
    </div>
  </div>
</div>


<?php
  include_once("foot.php");
?>
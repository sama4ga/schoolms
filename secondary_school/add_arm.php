<?php
require_once("connect.php");
include_once("head.php");


if (isset($_POST['submit'])) {
  include_once("sanitize.php");

  $arm = strtolower(sanitize($_POST['arm']));
  if (trim($arm != "")) {
    
    //echo $arm;exit();
    $result = $con->query("INSERT INTO `arm`(`arm`) VALUES('$arm')");
    if ($result) {
      echo "Arm successfullty added";
    }else{
      echo "Error adding arm ".$con->error;
    }
    
  }

}


$result = $con->query("SELECT * FROM `arm`");
if($result){
  $num_of_arm = $result->num_rows;
  if ($num_of_arm > 1) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      $arm[$x]=$row['arm'];

      $x++;
    }
  }
}


?>


<div class="container">
  <div>
    <h2>Add Arm</h2>
    <div>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        
        <div class="form-group">
          <label>Available Arms</label>
          <select name="available_arms" class="form-control">
            <?php 
              for($x=0; $x < $num_of_arm; $x++){
                echo "<option value='$arm[$x]'>".strtoupper($arm[$x])."</option>";
              }
            ?>            
          </select>
        </div>

        <div class="form-group">
          <label>Arm Name</label>
          <input type="text" name="arm" class="form-control">
        </div>

        <div class="input-group">
          <input type="submit" name="submit" class="form-control btn btn-success" value="Add">
          <input type="submit" name="back" class="form-control btn btn-warning" value="Back" onsubmit="history.back();">
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require_once("connect.php");
include_once("head.php");

$atd_id = $_REQUEST['atd_id'];

// get other data from atd_id
$data  = explode("_",$atd_id);
$session_formatted = $data[2]."_".$data[3];
$session = str_replace("_","/",$session_formatted);
$term = $data[4];


// check if attendance has been created
if (!$con->query("DESCRIBE `$atd_id`")) {
  echo "<div style='color:red;'>
          Attendance sheet not yet created.<br/>
          Create attendance sheet and try again.<br/>
          <a href='javascript:history.back()' class='btn btn-warning'>Click here to go back</a>
        </div>";
      exit();

}


//import all staff members
$result = $con->query("SELECT * FROM `staff` WHERE `staff_id` <> '1'");


if($result){
  if ($result->num_rows > 0) {
    $x = 0;
    while ($row = $result->fetch_assoc()) {
      $staff_id[$x] = $row['staff_id']; 
      $surname[$x] = $row['surname']; 
      $othernames[$x] = $row['othernames']; 
      $full_name[$x] = $surname[$x].", ".$othernames[$x]; 

      $x++;
    }
  }else {
    echo "<div>No staff found in database</div>";
    exit();
  }
}else {
  echo "<div>Error getting staff data ".$con->error."</div>";
  exit();
}


// get attendance details
$result = $con->query("SELECT * FROM `$atd_id`");


if($result){
  if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
      $date[$i] = $row['date']; 
      for ($x=0; $x < count($staff_id); $x++) {        
        $present[$staff_id[$x]][$i] = $row[$staff_id[$x]];
        $signin_time = explode(" ",$row[$staff_id[$x]]);
        $present[$staff_id[$x]][$i] = end($signin_time);
        //$present[$staff_id[$x]][$i] = date("h:i:s",strtotime($present[$staff_id[$x]][$i]));
      }
      $i++;
    }
  }else {
    echo "<div>Attendance not marked</div>";
    exit();
  }
}else {
  echo "<div>Error getting attendance record ".$con->error."</div>";
  exit();
}



// display the record for the class concerned
?>


<div class="container">
  <h2>Displaying  Staff Attendance Record for <?php echo $session." academic session."; ?></h2>
</div>
<div style="margin-top:50px;">
  <table  class="data" border="1">
    <tr>
      <th rowspan="2">S/N</th>
      <th rowspan="2">Staff Name</th>
      <th colspan="<?php echo count($date); ?>">Date</th>
    </tr>

    <tr>
      <?php
        for ($i=0; $i < count($date); $i++) { 
          echo "<th>".$date[$i]."</th>";
        }
      ?>
    </tr>

    <?php
    $count = 0;
      for ($x=0; $x < count($staff_id); $x++) { 
        $count = $x + 1;
        echo "<tr>
                <td>".$count."</td>
                <td>".$full_name[$x]."</td>";
                for ($i=0; $i < count($date); $i++) { 
                  if ($present[$staff_id[$x]][$i] == "00:00:00") {
                    echo "<td>absent</td>";
                  }else {
                    echo "<td>".$present[$staff_id[$x]][$i]."</td>";
                  }
                }
                
          echo "</tr>";
      }


    ?>
    
  </table>
</div>

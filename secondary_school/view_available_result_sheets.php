<?php
require_once("connect.php");
include_once("head.php");

$session = $_REQUEST['session'];
$session_formatted = str_replace("/","_",$session);
$term = $_REQUEST['term'];

if (!$con->query("DESCRIBE `existing_result_sheets`")) {
  echo "<div>No Result available<br/>
          <a href='javascript:history.back();' class='btn-md btn-warning'>Back</a>  
        </div>";
        exit();
}

$result = $con->query("SELECT * FROM `existing_result_sheets` WHERE `session`='$session_formatted' AND `term`='$term'");
if ($result) {
  $num_of_results = $result->num_rows;
  if ($num_of_results > 0) {
    $x = 0;while ($row = $result->fetch_assoc()) {
      $class[$x] = $row['class'];
      $arm[$x] = $row['arm'];
      $result_id[$x] = $row['result_id'];

      $x++;
    }

?>

<div>

  <h2 class="heading">Showing available result sheets</h2>
  <div style="margin:40px 0;">
    <div>Session:  <b><?php echo $session; ?></b></div>
    <div>Term:  <b><?php echo ucwords($term); ?></b></div>
  </div>

  <div>
    <table class="table">
      <tr>
        <th>S/N</th>
        <th>Class</th>
        <th>Arm</th>
      </tr>

<?php
for ($x=0; $x < $num_of_results; $x++) { 
  $count = $x + 1;
  echo "<tr>
        <td>".$count."</td>
        <td>".strtoupper($class[$x])."</td>
        <td>".strtoupper($arm[$x])."</td>
      </tr>";
}
      
?>
    </table>
  </div>

<div>
  <a href="javascript:history.back();" class="btn-lg btn-warning">Back</a>
</div>

</div>

<?php

  }else {
    echo "<div>No result found.</div>
          <a href='javascript:history.back();' class='btn btn-md btn-warning'>Back</a>";
  }
}

?>
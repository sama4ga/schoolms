<?php
include_once("header.php");
require_once("connect.php");


if ($con->query("DESCRIBE `sent_messages`")) {
  
  $result = $con->query("SELECT * FROM `sent_messages`");
  if ($result) {
    $num_of_messages = $result->num_rows;
    if ($num_of_messages > 0) {
      $x = 0;
      while ($row = $result->fetch_assoc()) {
        $msg_id[$x] = $row["msg_id"];
        $type[$x] = $row["type"];
        $subject[$x] = $row["subject"];
        $to[$x] = $row["to"];
        $body[$x] = $row["body"];
        $data[$x] = $row["data"];
        $status[$x] = $row["status"];
        $date[$x] = $row["date"];

        $x++;
      }

?>
<div class="container">
  <div><h1 class="heading">Sent Messages</h1></div>
  <div>
    <table class="table">
      <tr>
        <th>S/N</th>
        <th>Type</th>
        <th>Subject</th>
        <th>To</th>
        <th>Date</th>
        <th>Status</th>
        <th>Recieved By</th>
        <th>Body</th>
      </tr>
  <?php
  for ($x=0; $x < $num_of_messages; $x++) { 
    $count = $x+1;
    echo "<tr>
        <td>".$count."</td>
        <td>".ucwords($type[$x])."</td>
        <td><div style='width:200px;height:100px;'>".$subject[$x]."</div></td>
        <td>".$to[$x]."</td>
        <td><div style='width:100px;height:100px;'>".$date[$x]."</div></td>
        <td>".$status[$x]."</td>
        <td><div style='width:500px;height:100px;overflow:scroll;'>".$data[$x]."</div></td>
        <td><div style='width:500px;height:100px;overflow:scroll;'>".$body[$x]."<div></td>
      </tr>";
  }
      
  ?>
    </table>
  </div>
</div>



<?php
  
    }else {
        echo "<div>No messages has been sent</div>";
    }
  }else {
    echo "<div> An error occured while fetching record of messages: ".$con->error."</div>";
  }

}else {
  echo "<div>Message record table not found: ".$con->error."</div>";
}
 
  echo "<div><a href='javascript:history.back();' class='btn-warning btn-lg'>Back</a></div>";

?>
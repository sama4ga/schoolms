<?php
  require_once("connect.php");

  $session = $_REQUEST['session'];
  $term = $_REQUEST['term'];
  $std_id = $_REQUEST['std_id'];
  //echo $session." ".$term;

  $session_formatted=str_replace("/","_",$session);

  //$fees_id="fees_".$session_formatted;
  if (!$con->query("DESCRIBE `fees_debtors`")) {
    echo "Fees debtors table not found.<br/>
          Setup fees for the correct session/term or create fees table to continue";
          exit();
  }

  
  $result=$con->query("SELECT * FROM `fees_debtors` WHERE 
                    `session`='$session' AND `term`='$term' 
                    AND `std_id`='$std_id'");

  if ($result) {

    if ($result->num_rows > 0) {
      //echo "i am here";
      while ($row=$result->fetch_assoc()) {
        $amount_owed = $row['balance'];
      }

      echo $amount_owed."    ";

    }else {
      echo "No record found ";
    }
  }else {
    echo "Error fetching record ".$con->error;
  }
  





?>
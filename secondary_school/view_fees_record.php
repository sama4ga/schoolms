<?php
session_start();
include_once("head.php");
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "bursar" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

$msg=array();


if (isset($_POST['submit'])) {

  $std_id=$_POST['std_id'];
  $full_name=$_POST['full_name'];
  $session=$_SESSION['session'];
  $term=$_SESSION['term'];

  $session_formatted=str_replace("/","_",$session);

  $fees_id="fees_".$session_formatted."_".$term;
  if (!$con->query("DESCRIBE `$fees_id`")) {
    echo "Fees table not created";
    exit();
  }

  echo "<h2>Payment Record for $term term $session academic session </h2>
        <div>
          <div>Student's Name: <b style='color:red;'>$full_name</b></div>
        </div>";

  $result=$con->query("SELECT * FROM `$fees_id` WHERE `std_id`='$std_id'");
  if ( $result){
    if($result->num_rows > 0 ) {

      $x=0;
      while ($row=$result->fetch_assoc()) {

        $amount_paid[$x]=$row['amount_paid'];
        //$amount_due[$x]=$row['amount_due'];
        //$fees[$x]=$row['fees'];
        //$balance[$x]=$row['balance'];
        //$term=$row['term'];
        $teller_no[$x]=$row['teller_no'];
        $class=$row['class'];
        $arm=$row['arm'];
        $date[$x]=$row['date'];
        $date_added[$x]=$row['date_added'];
        $bank[$x]=$row['bank'];

        $x++;
      }

      echo "<div style='margin-bottom:30px;'>
              <div>Student's Class: <b style='color:red;'>$class $arm</b></div>
            </div>";

      echo "<table class='table-striped table-hover' cellpadding='5' style='margin-top:20px;' id='fees'>
              
              <tr>
                <th>S/N</th>
                <th>Amount Paid (<span style='text-decoration:line-through double;'>N</span>)</th>
                <th>Date Paid</th>
                <th>Teller No.</th>
              </tr>";

      for ($i=0; $i < count($date); $i++) { 
        
        $count=$i+1;
        echo "<tr>
                <td>$count</td> 
                <td>$amount_paid[$i]</td>
                <td>$date[$i]</td>
                <td>$teller_no[$i]</td>
              </tr>";

      }
        echo "<tr>
                <td><b>Total</b></td>
                <td><b>".array_sum($amount_paid)."</b></td>
                <td></td>
                <td></td>
              </tr>";

      echo "</table>
            <iframe id='txtArea1' style='display:none;'></iframe>

            <!-- <div id='btnExport' style='margin-top:20px'><button onclick=\"fnExcelExport('fees');\" class='btn-default'>Export data to Excel</button></div> -->
            <div id='export' style='margin-top:20px'><button onclick=\"exportToExcel('fees');\"  class='btn-default'>Export data to Excel Spreadsheet</button></div>
  
            ";
    }else {
      echo "No record found";
    }
  }else {
    echo "Error encountered while fetching fees record. ".$con->error;
  }







  // Get student debt record

  $result=$con->query("SELECT * FROM `fees_debtors` WHERE 
                    `std_id`=$std_id ORDER BY `session`");


if ($result) {

  if ($result->num_rows > 0) {

    $x=0;
    while ($rows = $result->fetch_assoc()) {
      
      $std_class[$x] = $rows['class'];
      $std_arm[$x] = $rows['arm'];
      $term_fees[$x] = $rows['term'];
      $session_fees[$x] = $rows['session'];
      $balance[$x] = $rows['balance'];
      $amount_paid[$x] = $rows['amount_paid'];
      $fees[$x] = $rows['fees'];
      $fees_id[$x] = $rows['fees_id'];

      $x++;
    }


    echo "<div style='margin-top:50px;'>
            <h2>Debts Record</h2>
            <table class='table-striped table-hover table-responsive' cellpadding='5' id='debts'>
              <tr>
                <th>S/N</th>
                <th>Class</th>
                <th>Arm</th>
                <th>Session</th>
                <th>Term</th>
                <th>Fees (<span style='text-decoration:line-through double;'>N</span>)</th>
                <th>Amount Paid (<span style='text-decoration:line-through double;'>N</span>)</th>
                <th>Balance (<span style='text-decoration:line-through double;'>N</span>)</th>
              </tr>";

    $count=0;//echo count($term)."<br/>";
    for ($i=0; $i < count($term_fees); $i++) {
      
        $count+=1;
        //$amount = intval($amount_paid[$i])-intval($balance[$i]);
          echo "<tr>
                  <td>".$count."</td>
                  <td>".strtoupper($std_class[$i])."</td>
                  <td>".strtoupper($std_arm[$i])."</td>
                  <td>".ucwords($session_fees[$i])."</td>
                  <td>".ucwords($term_fees[$i])."</td>
                  <td>".$fees[$i]."</td>
                  <td>".$amount_paid[$i]."</td>
                  <td>".$balance[$i]."</td>
                </tr>";
      }

      echo "<tr>
              <td colspan='6'><b>Total</b></td>
              <td><b>".array_sum($amount_paid)."</b></td>
              <td><b>".array_sum($balance)."</b></td>
            </tr>";


    echo "  </table>
    <iframe id='txtArea1' style='display:none;'></iframe>

            <!-- <div id='btnExport' style='margin-top:20px'><button onclick=\"fnExcelExport('debts');\" class='btn-default'>Export data to Excel</button></div> -->
            <div id='export' style='margin-top:20px'><button onclick=\"exportToExcel('debts');\"  class='btn-default'>Export data to Excel Spreadsheet</button></div>

          </div>";

  }
}else {
  echo "Error getting debt record ".$con->error;
}




  echo "<div class='input-group' style='margin-top:30px;'>
          <a href='javascript:history.back();' class='btn btn-warning btn-lg'>Back</a>
          <a href='javascript:window.print();' class='btn-success btn-lg'>Print</a>
        </div>";
  


include_once("foot.php");
  
  exit(1);

}


?>

<div class='container'>
  <h2 align='center'>Record Fees</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <p><!-- <form method='POST' action=''> -->
    <div class='form-control'>Search database for student
      <div class='input-group'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="search for student here"
        oninput="javascript:var data=document.getElementById('search'); get_data('search_student.php?name='+data.value,'display_result');">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div>
  </p>
  <div id='display_result'></div>
</div>


<?php

include_once("footer.php");

?>
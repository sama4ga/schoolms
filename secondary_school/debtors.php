<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "account" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

$_term=strtolower($_SESSION['term']);//echo $term;
$session=$_SESSION['session'];
$session=str_replace("/","_",$session);

$fees_debtors_id="fees_debtors_".$session;

if (!$con->query("DESCRIBE `$fees_debtors_id`")) {
  echo "Fees table not created.";
  exit();
}


$result=$con->query("SELECT * FROM `$fees_debtors_id` /* WHERE 
                    `balance` <> 0  AND `term`='$_term'*/
                    ORDER BY `surname`");


if ($result) {

  if ($result->num_rows > 0) {

    $x=0;
    while ($rows = $result->fetch_assoc()) {
      
      $std_surname[$x] = $rows['surname'];
      $std_othernames[$x] = $rows['othernames'];
      $std_class[$x] = $rows['class'];
      $std_arm[$x] = $rows['arm'];
      $term[$x] = $rows['term'];
      $balance[$x] = $rows['balance'];
      $amount_due[$x] = $rows['amount_due'];
      $fees[$x] = $rows['fees'];
      $fees_id[$x] = $rows['fees_id'];
      $std_name[$x] = $std_surname[$x].", ".$std_othernames[$x];

      $x++;
    }


    echo "<div>
            <table class='table-responsive'>
              <tr>
                <th>S/N</th>
                <th style='min-width:300px;'>Student Name</th>
                <th>Class</th>
                <th>Arm</th>
                <th>Term</th>
                <th>Fees (<span style='text-decoration:line-through double;'>N</span>)</th>
                <th>Amount Paid (<span style='text-decoration:line-through double;'>N</span>)</th>
                <th>Balance (<span style='text-decoration:line-through double;'>N</span>)</th>
              </tr>";

    $count=0;//echo count($term)."<br/>";
    for ($i=0; $i < count($term); $i++) {
      //echo $i;
      $amount=0;
      if ($i < count($term)-1) { // check if i > number of fees record read
        
        if ($std_name[$i] != $std_name[$i+1]) {
         
          $count=$count+1;
          $amount =intval($amount_due[$i])-intval($balance[$i]);
          echo "<tr>
                  <td>".$count."</td>
                  <td>".$std_name[$i]."</td>
                  <td>".strtoupper($std_class[$i])."</td>
                  <td>".strtoupper($std_arm[$i])."</td>
                  <td>".ucwords($term[$i])."</td>
                  <td>".number_format($fees[$i])."</td>
                  <td>".number_format($amount)."</td>
                  <td>".number_format($balance[$i])."</td>
                </tr>";

        }else {
          //$amount = $amount_due[$i]-$balance[$x];
        }
      }else {

        $count=$count+1;
        $amount = intval($amount_due[$i])-intval($balance[$i]);
          echo "<tr>
                  <td>".$count."</td>
                  <td>".$std_name[$i]."</td>
                  <td>".strtoupper($std_class[$i])."</td>
                  <td>".strtoupper($std_arm[$i])."</td>
                  <td>".ucwords($term[$i])."</td>
                  <td>".number_format($fees[$i])."</td>
                  <td>".number_format($amount)."</td>
                  <td>".number_format($balance[$i])."</td>
                </tr>";
      }
      
     
    }


    echo " 
    
            </table>
            
            <iframe id='txtArea1' style='display:none;'></iframe>

            <!-- <div id='btnExport' style='margin-top:20px'><button onclick=\"fnExcelExport('fees');\" class='btn-default'>Export data to Excel</button></div> -->
            <div id='export' style='margin-top:20px'><button onclick=\"exportToExcel('fees');\"  class='btn-default'>Export data to Excel Spreadsheet</button></div>

          </div>";

  }
}else {
  echo "Error getting record ".$con->error;
}





?>
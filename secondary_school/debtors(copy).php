<?php
session_start();
require_once("connect.php");
include_once("head.php");

$_term=strtolower($_SESSION['term']);//echo $term;
$session=$_SESSION['session'];
$session=str_replace("/","_",$session);

$fees_debtors_id="fees_debtors";

if (!$con->query("DESCRIBE `$fees_debtors_id`")) {
  echo "Fees debtors table not created.";
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
      $std_id[$x] = $rows['std_id'];
      $std_othernames[$x] = $rows['othernames'];
      $std_class[$x] = $rows['class'];
      $std_arm[$x] = $rows['arm'];
      $term_fees[$x] = $rows['term'];
      $session_fees[$x] = $rows['session'];
      $balance[$x] = $rows['balance'];
      $amount_paid[$x] = $rows['amount_paid'];
      $fees[$x] = $rows['fees'];
      $fees_id[$x] = $rows['fees_id'];
      $std_name[$x] = $std_surname[$x].", ".$std_othernames[$x];

      $x++;
    }


    echo "<div class='container'>
            <h2>Showing Fee Debtors</h2> 
            <table class='table-responsive table-hover' cellpadding='5' id='debts'>
              <tr>
                <th>S/N</th>
                <th style='min-width:300px;'>Student Name</th>
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
                  <td>".$std_name[$i]."</td>
                  <td>".strtoupper($std_class[$i])."</td>
                  <td>".strtoupper($std_arm[$i])."</td>
                  <td>".ucwords($session_fees[$i])."</td>
                  <td>".ucwords($term_fees[$i])."</td>
                  <td>".number_format($fees[$i])."</td>
                  <td>".number_format($amount_paid[$i])."</td>
                  <td>".number_format($balance[$i])."</td>
                </tr>";
      }


    echo "      <tr>
                  <td colspan='8' style='font-weight:bolder;'>Total Amount Owed</td>
                  <td style='font-weight:bolder;'>".number_format(array_sum($balance))."</td>
                </tr>
            </table>

            <iframe id='txtArea1' style='display:none;'></iframe>
            <div class='input-group' style='margin-top:20px'>
              <!-- <div id='btnExport'><button onclick=\"fnExcelExport('debts');\" class='btn-default'>Export data to Excel</button></div> -->
              <div id='export'><button onclick=\"exportToExcel('debts');\"  class='btn-default'>Export data to Excel Spreadsheet</button></div>
              <div><button onclick='javascript:window.print();'  class='btn-primary'>Print</button></div>
            </div>
          </div>";

  }else {
    echo "No debtor found ";
  }
}else {
  echo "Error getting record ".$con->error;
}


include_once("foot.php");


?>
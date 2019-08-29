<?php
require_once("connect.php");

$month=$_REQUEST['month'];
$session=$_REQUEST['session'];


$session_formatted=str_replace("/","_",$session);

$expense_id="expenses_".$session_formatted."_".$month;

if ($con->query("DESCRIBE `$expense_id`")) {
  $result=$con->query("SELECT * FROM `$expense_id` ");
  if ($result) {

      if ($result->num_rows > 0 ) {

      $x=0;
      while($row=$result->fetch_assoc()){

        $expense_id[$x] = $row['expense_id'];
        $description[$x] = $row['description'];
        $date[$x] = $row['date'];
        $quantity[$x] = $row['quantity'];
        $price[$x] = $row['price'];
        $amount_paid[$x] = $row['amount_paid'];
        $balance[$x] = $row['balance'];
        $supplier[$x] = $row['supplier'];
        $x++;
        
      }


      switch ($month) {
        case 'jan':
          $month = "January";
          break;
        case 'feb':
          $month = "February";
          break;
        case 'mar':
          $month = "March";
          break;
        case 'apr':
          $month = "April";
          break;
        case 'may':
          $month = "May";
          break;
        case 'jun':
          $month = "June";
          break;
        case 'jul':
          $month = "July";
          break;
        case 'aug':
          $month = "August";
          break;
        case 'sep':
          $month = "September";
          break;
        case 'oct':
          $month = "October";
          break;
        case 'nov':
          $month = "November";
          break;
        case 'dec':
          $month = "December";
          break;
        
        default:
          $month = "";
          break;
      }


    ?>

    

    <h2>Showing Expense Record for <?php echo $month." ".$session;  ?></h2>
    <table class="table-bordered" id="headerTable">
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Description</th>
        <th>Supplier</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount Paid</th>
        <th>Balance</th>
      </tr>

      <?php

        for ($i=0; $i < count($description); $i++) { 
          $count=$i+1;
          echo "<tr>
                  <td>$count</td>
                  <td>$date[$i]</td>
                  <td>$description[$i]</td>
                  <td>$supplier[$i]</td>
                  <td>".number_format($quantity[$i])."</td>
                  <td>".number_format($price[$i])."</td>
                  <td>".number_format($amount_paid[$i])."</td>
                  <td>".number_format($balance[$i])."</td>
                </tr>";

        }


      ?>

      <tr>
        <td></td>
        <td></td>
        <td><b>Total</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b><?php echo number_format(array_sum($amount_paid),0,".",","); ?></b></td>
        <td><b><?php echo number_format(array_sum($balance),0,".",","); ?></b></td>
      </tr>

    </table>

    <iframe id="txtArea1" style="display:none;"></iframe>

    <!-- <div id="btnExport" style="margin-top:20px"><button onclick="fnExcelExport('headerTable');"  class="btn-default">Export data to Excel</button> -->
    <div id="btnExport" style="margin-top:20px"><button onclick="exportToExcel('headerTable');"  class="btn-default">Export data to Excel</button>


    <?php 


    }else {
      echo "No record(s) found for the selected month ($month $session)";
    }
  }else {
    echo "Error encountered ".$con->error;
  }
}else {
  echo "Record does not exist for the selected month (".ucwords($month)." $session)";
}



?>
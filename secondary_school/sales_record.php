<?php
session_start();
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "account" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

$month=$_REQUEST['month'];
$session=$_REQUEST['session'];


$session_formatted=str_replace("/","_",$session);

$sales_id="sales_".$session_formatted."_".$month;

if ($con->query("DESCRIBE `$sales_id`")) {
  $result=$con->query("SELECT * FROM `$sales_id` ");
  if ($result) {

      if ($result->num_rows > 0 ) {

      $x=0;
      while($row=$result->fetch_assoc()){

        $sales_id[$x] = $row['sales_id'];
        $product_name[$x] = $row['product_name'];
        $date[$x] = $row['date'];
        $quantity[$x] = $row['quantity'];
        $price[$x] = $row['price'];
        $price_with_discount[$x] = $row['price_with_discount'];
        $discount[$x] = $row['discount'];
        $amount_paid[$x] = $row['amount_paid'];
        $client[$x] = $row['client'];
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

    <h2>Showing Sales Record for <?php echo $month." ".$session;  ?></h2>
    <table class="table-responsive table-bordered" id="headerTable">
      <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Product Name</th>
        <th>Client Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Price With Discount</th>
        <th>Discount</th>
        <th>Amount Paid</th>
      </tr>

      <?php

        $count=0;
        for ($i=0; $i < count($product_name); $i++) { 
          $count=$i+1;
          echo "<tr>
                  <td>$count</td>
                  <td>".$date[$i]."</td>
                  <td>$product_name[$i]</td>
                  <td>$client[$i]</td>
                  <td>".number_format($quantity[$i])."</td>
                  <td>".number_format($price[$i])."</td>
                  <td>".number_format($price_with_discount[$i])."</td>
                  <td>".number_format($discount[$i])."</td>
                  <td>".number_format($amount_paid[$i])."</td>
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
        <td></td>
        <td></td>
        <td><b><?php echo array_sum($amount_paid); ?></b></td>
      </tr>
    </table>

    <iframe id="txtArea1" style="display:none;"></iframe>

    <!-- <div id="btnExport" style="margin-top:20px"><button onclick="fnExcelExport('headerTable');"  class="btn-default">Export data to Excel</button></div> -->
    <div id="export" style="margin-top:20px"><button onclick="exportToExcel('headerTable');"  class="btn-default">Export data to Excel Spreadsheet</button></div>

    <?php 


    }else {
      echo "No record(s) found";
    }
  }else {
    echo "Error encountered ".$con->error;
  }
}else {
    echo "Record does not exist for the selected month (".ucwords($month)." ".$session.")";
}



?>
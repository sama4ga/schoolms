<?php
session_start();
require_once("connect.php");
include_once("head.php");

$session=$_SESSION['session'];
$session_formatted=str_replace("/","_",$session);

$start_month=strtotime("january");
$end_month=strtotime("december");

// get record for all the months in the year
$x=0;
$y=0;
while ($start_month <= $end_month) {

  $month=date("M",$start_month); 

  // get sales record
  $sales_id="sales_".$session_formatted."_".$month;
  if ($con->query("DESCRIBE `$sales_id`")) {
    
    $result=$con->query("SELECT * FROM `$sales_id`");
    if ($result) {
      if ($result->num_rows > 0) {

        while ($rows = $result->fetch_assoc()) {
          
          $sales_date[$x]=$rows['date'];
          $sales_client[$x]=$rows['client'];
          $sales_product_name[$x]=$rows['product_name'];
          $sales_balance[$x]=$rows['balance'];
          $sales_quantity[$x]=$rows['quantity'];
          $sales_price[$x]=$rows['price_with_discount'];
          $sales_amount_paid[$x]=$rows['amount_paid'];

          $x++;

        }
        
      }
    }else {
      echo "Error encountered ".$con->error;
    }
  }


  // get expense record
  $expenses_id="expenses_".$session_formatted."_".$month;
  if ($con->query("DESCRIBE `$expenses_id`")) {
    
    $result=$con->query("SELECT * FROM `$expenses_id`");
    if ($result) {
      if ($result->num_rows > 0) {

        while ($rows = $result->fetch_assoc()) {
          
          $expenses_date[$y]=$rows['date'];
          $expenses_supplier[$y]=$rows['supplier'];
          $expenses_description[$y]=$rows['description'];
          $expenses_balance[$y]=$rows['balance'];
          $expenses_quantity[$y]=$rows['quantity'];
          $expenses_price[$y]=$rows['price'];
          $expenses_amount_paid[$y]=$rows['amount_paid'];

          $y++;

        }
        
      }
    }else {
      echo "Error encountered ".$con->error;
    }
  }
  
  $start_month=strtotime("+1 month",$start_month);

}

?>


<h2>Showing Sales Summary for <?php echo $session; ?> </h2>

<table class="table" id="headerTable">

  <tr>
  <tr>
    <th colspan="7" style="border-right:solid black 2px;">Credit</th>
    <th colspan="7">Debit</th>
  </tr>
  <tr>    
    <th style="min-width:50px;">Date</th>
    <th style="min-width:200px;">Product Name</th>
    <th style="min-width:200px;">Client Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Amount Paid</th>
    <th style="border-right:solid black 2px;">Balance</th>

    <th style="min-width:50px;">Date</th>
    <th style="min-width:200px;">Product Name</th>
    <th style="min-width:200px;">Client Name</th>
    <th>Quantity</th>
    <th>Price (<span style="text-decoration:line-through double;">N</span>)</th>
    <th>Amount Paid (<span style="text-decoration:line-through double;">N</span>)</th>
    <th>Balance (<span style="text-decoration:line-through double;">N</span>)</th>
  </tr>
  <tr>

    <td>
      <table class="table-bordered">        

  <?php
        if (!empty($sales_date)) {
          for ($i=0; $i < count($sales_date); $i++) { 
            $count=$i+1;
            echo "<tr>
                    <td>".$sales_date[$i]."</td>
                    <td>".$sales_product_name[$i]."</td>
                    <td>".$sales_client[$i]."</td>
                    <td>".$sales_quantity[$i]."</td>
                    <td>".$sales_price[$i]."</td>
                    <td>".$sales_amount_paid[$i]."</td>
                    <td>".$sales_balance[$i]."</td>
                  </tr>";
      
          }     
        }


  ?>

        <tr>
          <td></td>
          <td><b>Total</b></td>
          <td></td>
          <td></td>
          <td></td>
          <td><b><?php echo array_sum($sales_amount_paid); ?></b></td>
          <td></td>
        </tr>
      </table>
    </td>

    <td>
      <table class="table-bordered">
        
  <?php
        if (!empty($expenses_date)) {
          for ($i=0; $i < count($expenses_date); $i++) { 
            $count=$i+1;
            echo "<tr>
                    <td>".$expenses_date[$i]."</td>
                    <td>".$expenses_description[$i]."</td>
                    <td>".$expenses_supplier[$i]."</td>
                    <td>".$expenses_quantity[$i]."</td>
                    <td>".$expenses_price[$i]."</td>
                    <td>".$expenses_amount_paid[$i]."</td>
                    <td>".$expenses_balance[$i]."</td>
                  </tr>";

          }     
        }

  ?>
        
        <tr>
          <td></td>
          <td><b>Total</b></td>
          <td></td>
          <td></td>
          <td></td>
          <td><b><?php echo array_sum($expenses_amount_paid); ?></b></td>
          <td></td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td><b>Net Profit = <span style="text-decoration:line-through double;">N</span><?php $profit = array_sum($sales_amount_paid) - array_sum($expenses_amount_paid); echo $profit; ?></b></td>
    <td></td>
  </tr>
  
</table>

<iframe id="txtArea1" style="display:none;"></iframe>

<div id="btnExport" style="margin-top:20px"><button onclick="fnExcelExport();"  class="btn-default">Export data to Excel</button>
<div id="export" style="margin-top:20px"><button onclick="exportToExcel();"  class="btn-default">Export data to Excel Spreadsheet</button>



<!-- <table class="table-bordered">
  <tr>
    <th rowspan="2">S/N</th>
    <th colspan="7" style="border-right:2px solid black;">Credit</th>
    <th colspan="7">Debit</th>
  </tr>

  <tr>    
    <th>Date</th>
    <th>Product Name</th>
    <th>Client Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Amount Paid</th>
    <th style="border-right:2px solid black;">Balance</th>
    <th>Date</th>
    <th>Description</th>
    <th>Supplier</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Amount Paid</th>
    <th>Balance</th>
  </tr> -->

<?php
/* 


  if (isset($sales_balance)) {

    for ($i=0; $i < count($sales_balance); $i++) { 
      $count=$i+1;
      echo "<tr>
              <td>".$count."</td>
              <td>".$sales_date[$i]."</td>
              <td>".$sales_product_name[$i]."</td>
              <td>".$sales_client[$i]."</td>
              <td>".$sales_quantity[$i]."</td>
              <td>".$sales_price[$i]."</td>
              <td>".$sales_amount_paid[$i]."</td>
              <td style='border-right:2px solid black;'>".$sales_balance[$i]."</td>
              <td>".$expenses_date[$i]."</td>
              <td>".$expenses_description[$i]."</td>
              <td>".$expenses_supplier[$i]."</td>
              <td>".$expenses_quantity[$i]."</td>
              <td>".$expenses_price[$i]."</td>
              <td>".$expenses_amount_paid[$i]."</td>
              <td>".$expenses_balance[$i]."</td>
            </tr>";

    }     
    
    
  } */ 

?> 

<!-- </table> -->

<a href="javascript:history.back();" target="_parent" class="btn btn-warning">Back</a>

<?php
session_start();
require_once("connect.php");
include_once("head.php");


if (isset($_REQUEST['submit'])) {
  $amount = $_POST['amount'];
  $_debtors_id = $_POST['debtors_id'];
  $_quantity = $_POST['quantity'];
  $_amount_paid = $_POST['amount_paid'];
  $_product_name = $_POST['product_name'];
  $_client = $_POST['client'];
  $_price = $_POST['price'];
  $_balance = $_POST['balance'];
  

  $new_balance = $_balance - $amount;
  $new_amount_paid = $_amount_paid + $amount;
  
  if ($new_balance == 0) {

    $result = $con->query("DELETE FROM `sales_debtors` WHERE `debtors_id`='$_debtors_id'");
    if ($result) {
      echo "<div>Debt record successfully deleted </div>";
    }else {
      echo "<div>Error occured while deleting debt record ".$con->error."</div>";
    }

  }else {
    
    $result = $con->query("UPDATE `sales_debtors`  SET `balance`='$new_balance',`amount_paid`='$new_amount_paid',`date`=CURRENT_TIMESTAMP WHERE `debtors_id`='$_debtors_id'");
    if ($result) {
      echo "<div>Debt payment successfully recorded </div>";
    }else {
      echo "<div>Error occured while recording debt payment ".$con->error."</div>";
    }

  }

  $session=$_SESSION['session'];
  $session_formatted=str_replace("/","_",$session);
  
  $sales_id="sales_".$session_formatted."_".date("M",time());
 
  $result = $con->query("INSERT INTO `$sales_id`(
                        `product_name`,
                        `client`,
                        `amount_paid`)
                        VALUES(
                        'Debt payment for $_product_name',
                        '$_client',
                        '$amount');");

  if ($result) {
    echo "<div>Record successfully inserted in sales table </div>";
  }else {
    echo "<div>Error occured while recording debt payment in sales record ".$con->error>"</div>";
  }

}




$x=0; 

  $sales_debtors_id="sales_debtors";

  if ($con->query("DESCRIBE `$sales_debtors_id`")) {
    $result=$con->query("SELECT * FROM `$sales_debtors_id` WHERE `balance` > 0");
    if ($result) {
      if ($result->num_rows > 0) {

        while ($rows = $result->fetch_assoc()) {
          
          $debtors_id[$x]=$rows['debtors_id'];
          $date[$x]=$rows['date'];
          $client[$x]=$rows['client'];
          $product_name[$x]=$rows['product_name'];
          $balance[$x]=$rows['balance'];
          $quantity[$x]=$rows['quantity'];
          $price[$x]=$rows['price'];
          $amount_paid[$x]=$rows['amount_paid'];

          $x++;

        }
        
      }else {
        
      }
    }else {
      echo "Error encountered ".$con->error;
    }
  }
  

?>


<h2>Showing list of debtors </h2>

<table class="table-bordered">
<tr>
  <th>S/N</th>
  <th>Date</th>
  <th>Product Name</th>
  <th>Client Name</th>
  <th>Quantity</th>
  <th>Price (<span style="text-decoration:line-through double;">N</span>)</th>
  <th>Amount Paid (<span style="text-decoration:line-through double;">N</span>)</th>
  <th>Balance (<span style="text-decoration:line-through double;">N</span>)</th>
</tr>

<?php

if (isset($balance)) {
  
  for ($i=0; $i < count($balance); $i++) { 
    $count=$i+1;
    echo "<tr>
            <form method='post' action=''>
              <td>".$count."</td>
              <td><input type='hidden' name='date' value='$date[$i]'>".$date[$i]."</td>
              <td><input type='hidden' name='product_name' value='$product_name[$i]'>".$product_name[$i]."</td>
              <td><input type='hidden' name='client' value='$client[$i]'>".$client[$i]."</td>
              <td><input type='hidden' name='quantity' value='$quantity[$i]'>".number_format($quantity[$i])."</td>
              <td><input type='hidden' name='price' value='$price[$i]'>".number_format($price[$i])."</td>
              <td><input type='hidden' name='amount_paid' value='$amount_paid[$i]'>".number_format($amount_paid[$i])."</td>
              <td><input type='hidden' name='balance' value='$balance[$i]'>".number_format($balance[$i])."</td>
              <td>
                <input type='number' name='amount' class='form-control' style='width:100px;'>
                <input type='hidden' name='debtors_id' value='$debtors_id[$i]'>
                <input type='submit' value='Pay' name='submit' class='btn-success'>
              </td>
            </form>
          </tr>";

  } 
  
  
}else {
  echo "There are no debtors";
}

?>

</table>

<a href="javascript:history.back();" class="btn btn-warning">Back</a>

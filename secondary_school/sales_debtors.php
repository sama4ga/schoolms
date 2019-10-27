<?php
include_once("auth.php");
if ($priviledge !== "account" || $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
require_once("connect.php");
include_once("head.php");


$session=$_SESSION['session'];
$session_formatted=str_replace("/","_",$session);

$start_month=strtotime("january");
$end_month=strtotime("december");


$x=0;
while ($start_month <= $end_month) {

  $month=date("M",$start_month); 

  $sales_id="sales_".$session_formatted."_".$month;
  
  if ($con->query("DESCRIBE `$sales_id`")) {
    $result=$con->query("SELECT * FROM `$sales_id` WHERE `balance` > 0");
    if ($result) {
      if ($result->num_rows > 0) {

        while ($rows = $result->fetch_assoc()) {
          
          $sales_id[$x]=$rows['sales_id'];
          $date[$x]=$rows['date'];
          $client[$x]=$rows['client'];
          $product_name[$x]=$rows['product_name'];
          $balance[$x]=$rows['balance'];
          $quantity[$x]=$rows['quantity'];
          $price[$x]=$rows['price_with_discount'];
          $amount_paid[$x]=$rows['amount_paid'];

          $x++;

        }
        
      }else {
        
      }
    }else {
      echo "Error encountered ".$con->error;
    }
  }
  

  
  $start_month=strtotime("+1 month",$start_month);

}

?>


<h2>Showing list of debtors for <?php echo $session; ?></h2>

<table class="table-bordered">
<tr>
  <th>S/N</th>
  <th>Date</th>
  <th>Product Name</th>
  <th>Client Name</th>
  <th>Quantity</th>
  <th>Price</th>
  <th>Amount Paid</th>
  <th>Balance</th>
</tr>

<?php

if (isset($balance)) {
  
  for ($i=0; $i < count($balance); $i++) { 
    $count=$i+1;
    echo "<tr>
            <td>".$count."</td>
            <td>".$date[$i]."</td>
            <td>".$product_name[$i]."</td>
            <td>".$client[$i]."</td>
            <td>".$quantity[$i]."</td>
            <td>".$price[$i]."</td>
            <td>".$amount_paid[$i]."</td>
            <td>".$balance[$i]."</td>
          </tr>";

  } 
  
  
}else {
  echo "There are no debtors";
}

?>

</table>

<a href="javascript:history.back();" class="btn btn-warning">Back</a>

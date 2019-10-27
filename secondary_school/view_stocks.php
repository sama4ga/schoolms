<?php
include_once("auth.php");
if ($priviledge !== "account" || $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
require_once("connect.php");


//$product_name=$_REQUEST['product_name'];

$result=$con->query("SELECT * FROM `products`");
if ($result && $result->num_rows > 0 ) {

  $x=0;
  while($row=$result->fetch_assoc()){

    $product_name[$x] = $row['product_name'];
    $quantity[$x] = $row['quantity'];
    $price[$x] = $row['price'];
    $price_with_discount[$x] = $row['price_with_discount'];
    $discount[$x] = $row['discount'];

    $x++;
  }

}


?>


<table class="table" cellpadding='5'>
  <tr>
    <th>S/N</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price(N)</th>
    <th>Discount(%)</th>
    <th>Discounted Price(N)</th>
  </tr>



<?php

if (isset($product_name)) {
  
  for ($i=0; $i < count($product_name); $i++) { 
    
    $count=$i+1;
    echo "<tr>
          <td>".$count."</td>
          <td>".$product_name[$i]."</td>
          <td>".number_format($quantity[$i])."</td>
          <td>".number_format($price[$i])."</td>
          <td>".$discount[$i]."</td>
          <td>".number_format($price_with_discount[$i])."</td>
        </tr>";
  }

}else {
  echo "There are no products in stock";
}
  



?>
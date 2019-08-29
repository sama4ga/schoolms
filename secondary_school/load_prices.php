<?php
require_once("connect.php");


$product_name=$_REQUEST['product_name'];

$result=$con->query("SELECT * FROM `products` WHERE `product_name`='$product_name'");
if ($result->num_rows > 0 ) {
  while($row=$result->fetch_assoc()){
    $quantity = $row['quantity'];
    $price = $row['price'];
    $price_with_discount = $row['price_with_discount'];
    $discount = $row['discount'];
  }

}


?>

<div class="form-group">
  <label>Quantity Available</label>
  <input type="number" class="form-control" readonly name="quantity_available" id="quantity_available" value="<?php echo $quantity  ?>"/>
</div>

<div class="form-group">
  <label>Quantity</label>
  <input type="number" name="quantity" class="form-control" id="quantity" onchange="calculate_price();" />
</div>

<div class="form-group">
  <label>Discount(%)</label>
  <input type="number" name="discount" class="form-control" id="discount" readonly value="<?php echo $discount  ?>"/>
</div>

<div class="form-group">
  <label>Price</label>
  <input type="number" name="price" class="form-control" id="price" readonly value="<?php echo $price  ?>"/>
</div>

<div class="form-group">
  <label>Discounted Price</label>
  <input type="number" name="price_with_discount" class="form-control" id="price_with_discount" readonly value="<?php echo $price_with_discount  ?>"/>
</div>

<div class="form-group">
  <label>Amount Expected</label>
  <input type="number" name="amount_expected" class="form-control" id="amount_expected" readonly />
</div>

<div class="form-group">
  <label>Client's Name</label>
  <input type="text" name="client" class="form-control" required />
</div>

<div class="form-group">
  <label>Amount Paid</label>
  <input type="text" name="amount_paid" class="form-control" required />
</div>
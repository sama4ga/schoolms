<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "account" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}


if (!$con->query("DESCRIBE `products`")) {
 $result = $con->query("CREATE TABLE IF NOT EXISTS `products`(
                        `product_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `product_name` varchar(200) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        `price_with_discount` INT NOT NULL,
                        `discount` INT NOT NULL
                        );");

  if ($result){
    echo "<div style='color:red;'>products tables successfully created</div>";
  }else {
    echo "<div style='color:red;'>error creating products record".$con->error."</div>";
  }

}

if (!$con->query("DESCRIBE `stocks`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `stocks`(
                        `stock_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        /* `product_id` INT NOT NULL, FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`), */
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `product_name` varchar(200) NOT NULL,
                        `quantity` INT NOT NULL,
                        `amount_bought` INT NOT NULL,
                        `price` INT NOT NULL,
                        `discount` INT NOT NULL,
                        `price_with_discount` INT NOT NULL,
                        `amount_expected` INT NOT NULL,
                        `profit_expected` INT NOT NULL
                        );");
 
   if ($result){
     echo "<div style='color:red;'>stocks record successfully created</div>";
   }else {
     echo "<div style='color:red;'>error creating stocks record".$con->error."</div>";
   }
 
}


/* // register_shutdown_function();
// register_tick_function();

$session=$_SESSION['session'];
$session_formatted=str_replace("/","_",$session);

$expense_id="expenses_".$session_formatted."_".date("M",time());

if (!$con->query("DESCRIBE `$expense_id`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `$expense_id`(
                        `expense_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `description` varchar(200) NOT NULL,
                        `supplier` varchar(400) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        `amount_paid` INT NOT NULL,
                        `balance` INT NOT NULL
                        );");
 
   if ($result){
     echo "<div style='color:red;'>expense record successfully created</div>";
   }else {
     echo "<div style='color:red;'>error creating expense record ".$con->error."</div>";
   }
 
} */




if (isset($_POST['submit'])) {
  include_once("sanitize.php");
  
  $product_name=ucwords(sanitize($_POST['product_name']));
  $price=sanitize($_POST['price']);
  $price_with_discount=sanitize($_POST['price_with_discount']);
  $quantity=sanitize($_POST['quantity']);
  $amount_bought=sanitize($_POST['amount_bought']);
  $discount=sanitize($_POST['discount']);
  $amount_expected=sanitize($_POST['amount_expected']);
  $profit=sanitize($_POST['profit']);


  // check if products already exist and update accordingly
  $result=$con->query("SELECT * FROM `products` WHERE `product_name`='$product_name'");
  if ($result->num_rows > 0 ) {
    while($row=$result->fetch_assoc()){
      $quantity_fetched=$row['quantity'];
    }

    $quantity_updated = $quantity + $quantity_fetched;

    $result=$con->query("UPDATE `products` SET
                        `quantity`='$quantity_updated',
                        `price`='$price',
                        `discount`='$discount',
                        `price_with_discount`='$price_with_discount'
                        WHERE `product_name`='$product_name'; ");
  
  // product does not exist, insert in product table
  }else {
    $result=$con->query("INSERT INTO `products`(
                      `product_name`,
                      `quantity`,
                      `price`,
                      `discount`,
                      `price_with_discount`
                      )VALUES(
                      '$product_name',
                      '$quantity',
                      '$price',
                      '$discount',
                      '$price_with_discount');");
  }

  
  if ($result) {
    echo "<div style='color:red;'>Record successfully inserted</div>";
  }else {
    echo "<div style='color:red;'>error could not record sales ".$con->error."</div>";
  }


  // insert record into stocks
  $result=$con->query("INSERT INTO `stocks`(
                        `product_name`,
                        `quantity`,
                        `amount_bought`,
                        `price`,
                        `discount`,
                        `price_with_discount`,
                        `amount_expected`,
                        `profit_expected`
                        )VALUES(
                          '$product_name',
                          '$quantity',
                          '$amount_bought',
                          '$price',
                          '$discount',
                          '$price_with_discount',
                          '$amount_expected',
                          '$profit');");
  if ($result) {
  echo "<div style='color:red;'>Record successfully inserted in stocks </div>";
  }else {
  echo "<div style='color:red;'>error could not record in stocks ".$con->error."</div>";
  }



 /*    // automaically insert record as an expense in expense table    
    $result=$con->query("INSERT INTO `$expense_id`(
                        `description`,
                        `date`,
                        `supplier`,
                        `quantity`,
                        `price`,
                        `amount_paid`,
                        `balance`)
                        VALUES(
                        'Bought $description',
                        '$date',
                        '$supplier',
                        '$quantity',
                        '$price',
                        '$amount_paid',
                        '$balance');");
    if ($result){
      echo "expense record successfully inserted<br/>";
    }else {
      echo "error inserting expense record ".$con->error."<br/>";
    }  */



}



?>


<div>
  <h2>Load Products Page</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>">
    <div class="form-group">
      <label>Product Name</label>
      <input list="products" type="text" name="product_name" class="form-control" />
    </div>

    <datalist id="products">

      <?php
        $result = $con->query("SELECT * FROM `products`");
        if ($result) {
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='".$row['product_name']."'>";
            }
          }
        }
      ?>

    </datalist>

    <div class="form-group">
      <label>Quantity</label>
      <input type="number" name="quantity" class="form-control" id="quantity" />
    </div>

    <div class="form-group">
      <label>Amount Bought</label>
      <input type="number" name="amount_bought" class="form-control" id="amount_bought" onchange="calculate_average_amount();"/>
    </div>

    <div class="form-group hidden">
      <label>Average Price Per Unit</label>
      <input type="number" name="average_price_per_unit" class="form-control" id="average_price_per_unit" readonly/>
    </div>
    
    <div class="form-group">
      <label>Discount (%)</label>
      <input type="number" name="discount" class="form-control" id="discount" />
    </div>
    
    <div class="form-group">
      <label>Price for Each</label>
      <input type="number" name="price" class="form-control" id="price" onchange="calculate_profit();" />
    </div>

    <div class="form-group hidden">
      <label>Price for Each With Discount</label>
      <input type="number" name="price_with_discount" class="form-control" id="price_with_discount" readonly/>
    </div>

    <div class="form-group">
      <label>Amount Expected</label>
      <input type="number" name="amount_expected" class="form-control" id="amount_expected" readonly/>
    </div>

    <div class="form-group hidden">
      <label>Profit</label>
      <input type="number" name="profit" class="form-control" id="profit" readonly/>
    </div>

    <div class="input-group">
      <input type="submit" name="submit" class="form-control btn-success" value="Submit" />
      <input type="submit" name="back" class="form-control btn-warning" value="Back" formaction="sales_demo.php"/>
    </div>

  </form>
</div>

<script>

  function calculate_average_amount() {
    var quantity=document.getElementById("quantity").value;
    var amount_bought=document.getElementById("amount_bought").value;  
    average_price_per_unit=amount_bought/quantity;
    document.getElementById("average_price_per_unit").value=average_price_per_unit;
  }

function calculate_profit() {
  var quantity=document.getElementById("quantity").value;
  var amount_bought=document.getElementById("amount_bought").value;  
  var price=document.getElementById("price").value;
  var discount=document.getElementById("discount").value;
  var amount_expected=document.getElementById("amount_expected").value;

  price_with_discount = price - price*discount/100;
  amount_expected = price_with_discount*quantity;
  profit = amount_expected - amount_bought;

  document.getElementById("price_with_discount").value=price_with_discount;
  document.getElementById("amount_expected").value=amount_expected;
  document.getElementById("profit").value=profit;
}
  
</script>
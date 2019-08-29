<?php
session_start();
require_once("connect.php");
include_once("head.php");

$month=strtolower(date("M",time()));
$session=$_SESSION['session'];

$session=str_replace("/","_",$session);

$sales_id="sales_".$session."_".$month;
if (!$con->query("DESCRIBE `$sales_id`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `$sales_id`(
                        `sales_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        /* `product_id` INT NOT NULL, FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`), */
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `product_name` varchar(200) NOT NULL,
                        `client` varchar(400) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        `discount` INT NOT NULL,
                        `price_with_discount` INT NOT NULL,
                        `amount_paid` INT NOT NULL
                        );");
 
   if ($result){
     echo "sales record successfully created<br/>";
   }else {
     echo "error creating sales record ".$con->error."<br/>";
   }
 
}

// create temporary table to hold sales record
if (!$con->query("DESCRIBE `tmp`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `tmp`(
                        `product_name` varchar(200) NOT NULL,
                        `client` varchar(400) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        `amount_paid` INT NOT NULL,
                        `balance` INT NOT NULL,
                        `receipt_no` INT
                        );");
 
   if ($result){
     echo "tmp table successfully created<br/>";
   }else {
     echo "error creating tmp table ".$con->error."<br/>";
   }
 
}

// create debtors list
if (!$con->query("DESCRIBE `sales_debtors`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `sales_debtors`(
                        `debtors_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        /* `product_id` INT NOT NULL, FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`), */
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `product_name` varchar(200) NOT NULL,
                        `client` varchar(400) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        `amount_paid` INT NOT NULL,
                        `balance` INT NOT NULL
                        );");
 
   if ($result){
     echo "sales record successfully created<br/>";
   }else {
     echo "error creating sales record ".$con->error."<br/>";
   }
 
}



if (isset($_POST['add'])) {
  
  $product_name=$_POST['product_name'];
  $quantity=$_POST['quantity'];
  $quantity_available=$_POST['quantity_available'];
  $price=$_POST['price'];
  $discount=$_POST['discount'];
  $price_with_discount=$_POST['price_with_discount'];
  $amount_expected=$_POST['amount_expected'];
  $amount_paid=$_POST['amount_paid'];
  $client=$_POST['client'];

  $balance=$amount_expected-$amount_paid;

  $quantity_available=$quantity_available-$quantity;
  $result=$con->query("UPDATE `products` SET `quantity`='$quantity_available' WHERE `product_name`='$product_name'");


  if ($balance != 0) {
    
    $result = $con->query("INSERT INTO `sales_debtors`(
                          `product_name`,
                          `client`,
                          `quantity`,
                          `price`,
                          `amount_paid`,
                          `balance`
                          )VALUES(
                          '$product_name',
                          '$client',
                          '$quantity',
                          '$price_with_discount',
                          '$amount_paid',
                          '$balance'
                          );");

    if (!$result) {
      echo "Error inserting record in sales_debtors record ".$con->error;
    }

  }



  $result=$con->query("INSERT INTO `$sales_id`(
                      `product_name`,
                      `client`,
                      `quantity`,
                      `price`,
                      `discount`,
                      `price_with_discount`,
                      `amount_paid`)
                      VALUES('$product_name',
                      '$client',
                      '$quantity',
                      '$price',
                      '$discount',
                      '$amount_expected',
                      '$amount_paid');");
  
  if ($result){
    echo "sales record successfully inserted<br/>";

    $receipt_no=$con->insert_id;

    // insert into tmp table
    $result = $con->query("INSERT INTO `tmp`(
                                              `product_name`,
                                              `client`,
                                              `quantity`,
                                              `price`,
                                              `amount_paid`,
                                              `balance`,
                                              `receipt_no`
                                              ) VALUES(
                                              '$product_name',
                                              '$client',
                                              '$quantity',
                                              '$price',
                                              '$amount_paid',
                                              '$balance',
                                              $receipt_no);");
    if ($result) {
      echo "<div>Record successfully added</div>      
            <div class='input-group'>
              <a href='print_sales_receipt.php' class='btn btn-success'>Generate Receipt</a>
              <a href='record_sales(copy1).php' class='btn btn-warning'>Continue</a>
            </div>;
           ";

    }else {
      echo "<div>Error adding record ".$con->error."</div>";
    }
  }
}else {
  echo "error inserting sales record ".$con->error."<br/>";
}

?>
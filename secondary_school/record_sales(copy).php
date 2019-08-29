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



if (isset($_POST['submit'])) {
  
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

    if ($receipt_no < 10) {
      $receipt_no = "000".$receipt_no;
    }elseif ($receipt_no < 100) {
      $receipt_no = "00".$receipt_no;
    }elseif ($receipt_no < 1000) {
      $receipt_no = "0".$receipt_no;
    }




    $remark="supplied";
    
    
    // design receipt
    ?>

    <div style="width:500px;" id="print_area">

      <div>
        <img src="../images/header.png" width="100%"/>
        <div style="display:flex;">
          <div align="right" style="width:50%;"><b>Sales Receipt</b></div>
          <div align='right' style="width:50%;">Receipt No.: <?php echo $receipt_no; ?></div>
        </div>
        <div align='right'>Date: <?php echo date("d/m/Y",time()); ?></div>
      </div>


      <div>
        <div style="display:flex;margin:50px 0;">
          <div>Name:</div>
          <div style="border-bottom: dotted 1px black; width:40%; margin-bottom: 20px;">
            &nbsp;&nbsp;&nbsp;<?php echo $client; ?>
          </div>
        </div>

      <table border="1" cellspacing="5" cellpadding="5" align="center">
        <tr>
          <th>S/N</th>
          <th>Description</th>
          <th>Quantity</th>
          <th>Amount (<span style="text-decoration:line-through double;">N</span>)</th>
          <th>Remarks</th>
        </tr>

        <tr>
          <td>1</td>
          <td><?php echo $product_name; ?></td>
          <td><?php echo $quantity; ?></td>
          <td><?php echo $amount_paid; ?></td>
          <td><?php echo $remark; ?></td>
        </tr>
      </table>


    <div style="display:flex;margin-top:50px;">
      <div>Amount in words</div>
      <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
        &nbsp;&nbsp;&nbsp;<?php $f = new NumberFormatter("en",NumberFormatter::SPELLOUT);
        $f->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-numbering-verbose"); 
        echo ucfirst($f->format($amount_paid))." naira only"; ?>
      </div>
    </div>

        <div style="display:flex;">
        <div>Balance</div>
          <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
            &nbsp;&nbsp;&nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo $balance; ?>&nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
          </div>
        </div>
        
        <div style="margin-top:50px;display:flex;"> 

          <div align="left" style="width:50%;">
            <div  style="border:solid 1px black;width:70%;">
              &nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo $amount_paid; ?> &nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
            </div>
          </div>

          <div align="right" style="width:50%;">
            <div style="width:70%;">
              <div align='center' style="border-bottom: solid 1px black;"></div>
              <div align='center'>Signature & Date</div>
            </div>
          </div>

        </div>

      <div>
        <a href="#" onclick="print_receipt();" id="btnPrint">print</a>
        <a href="#" onclick="history.back(2);" id="btnBack">Back</a>
      </div>

    </div>

    <script>

      function print_receipt(){

        document.getElementById("btnPrint").style.display="none";
        document.getElementById("btnBack").style.display="none";
        var print_content = document.getElementById("print_area");
        var window_print = window.open("","","left=0, top=0, width=800, height=900, toolbar=0, scrollbars=0, status=0");
        window_print.document.write(print_content.innerHTML);
        //window_print.document.write(cssLinkTag);
        window_print.document.close();
        window_print.focus();
        window_print.print();
        window_print.close();

        document.getElementById("btnPrint").style.display="block";
        document.getElementById("btnBack").style.display="block";

      }

    </script>


    <?php

    exit();

  }else {
      echo "error inserting sales record ".$con->error."<br/>";
  }



}


$result=$con->query("SELECT * FROM `products` ");
if ($result) {
  
  if ($result->num_rows > 0 ) {
  
    $x=0;
    while($row=$result->fetch_assoc()){
  
      $product_name[$x] = $row['product_name'];
      $product_id[$x] = $row['product_id'];
      $x++;
  
    }
  
  }
}



?>



<div>
    <h2>Sales Record Page</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?month=$month&session=$session";  ?>">
      <div class="form-group">
        <label>Products Available</label>
        <select name="product_name" class="form-control" onchange="get_data('load_prices.php?product_name='+this.value,'display');">
          <option value="">Choose one</option>
            <?php
              for($i=0; $i < count($product_name); $i++){
                echo "<option value='".$product_name[$i]."'>".$product_name[$i]."</option>";
              }

            ?>
        </select>
      </div>

      <div id="display"></div>
  
      <div class="input-group">
        <input type="submit" name="submit" class="form-control btn-success" value="Submit" />
        <input type="submit" name="back" class="form-control btn-warning" value="Back" formaction="fees_demo.php"/>
      </div>
  
    </form>
  </div>


  <script>
    
    function calculate_price() {
      var quantity=document.getElementById("quantity").value;  
      var price=document.getElementById("price_with_discount").value;
    
      amount_expected = price*quantity;
    
      document.getElementById("amount_expected").value=amount_expected;
    }
      
  </script>


<?php

include_once("footer.php");

?>
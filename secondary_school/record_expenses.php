<?php
session_start();
require_once("connect.php");
include_once("head.php");

$month=strtolower(date("M",time()));
$session=$_SESSION['session'];

$session=str_replace("/","_",$session);

$expense_id="expenses_".$session."_".$month;
if (!$con->query("DESCRIBE `$expense_id`")) {
  $result = $con->query("CREATE TABLE IF NOT EXISTS `$expense_id`(
                        `expense_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        /* `product_id` INT NOT NULL, FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`), */
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `description` varchar(200) NOT NULL,
                        `supplier` varchar(400) NOT NULL,
                        `quantity` INT NOT NULL,
                        `price` INT NOT NULL,
                        /* `discount` INT NOT NULL, */
                        /* `price_with_discount` INT NOT NULL,*/
                        `amount_paid` INT NOT NULL,
                        `balance` INT NOT NULL
                        );");
 
   if ($result){
     echo "<div style='color:red;'>expense record successfully created</div>";
   }else {
     echo "<div style='color:red;'>error creating expense record ".$con->error."</div>";
   }
 
}



if (isset($_POST['submit'])) {
  
  $description=$_POST['description'];
  $date=$_POST['date'];
  $quantity=$_POST['quantity'];
  $price=$_POST['price'];
  $amount_expected=$_POST['amount_paid'];
  $amount_paid=$_POST['amount_paid'];
  $supplier=$_POST['supplier'];
  $balance=$_POST['balance'];

  //$balance=$amount_expected-$amount_paid;

  $result=$con->query("INSERT INTO `$expense_id`(
                      `description`,
                      `date`,
                      `supplier`,
                      `quantity`,
                      `price`,
                      `amount_paid`,
                      `balance`)
                      VALUES('$description',
                      '$date',
                      '$supplier',
                      '$quantity',
                      '$price',
                      '$amount_paid',
                      '$balance');");
  if ($result){
    echo "expense record successfully inserted<br/>";


   /*  // design receipt
    ?>

    <div style="width:500px;" id="print_area">

      <div>
        <img src="../images/header.png" width="100%"/>
        <div style="display:inline-flex;">
          <div align="center" class="col-8"><b>Expense Fees Receipt</b></div>
          <div align='right'>Receipt No.: <?php echo $receipt_no; ?></div>
        </div>
        <div align='right'>Date: <?php echo date("d/m/Y",time()); ?></div>
      </div>


      <div>
        <div style="display:flex;">
          Name
          <div style="border-bottom: dotted 1px black; width:40%; margin-bottom: 20px;">
            &nbsp;&nbsp;&nbsp;<?php echo $full_name; ?>
          </div>
        </div>

        <div style="display:flex;">
          Name
          <div style="border-bottom: dotted 1px black; width:40%; margin-bottom: 20px;">
            &nbsp;&nbsp;&nbsp;<?php echo $full_name; ?>
          </div>
        </div>
      </div>

      <table class="table-bordered">
        <tr>
          <th>S/N</th>
          <th>Description</th>
          <th>Quantity</th>
          <th>Amount (N)</th>
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


    <div style="display:flex;">
      Amount in words
      <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
        &nbsp;&nbsp;&nbsp;<?php $f = new NumberFormatter("en",NumberFormatter::SPELLOUT);
        $f->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-numbering-verbose"); 
        echo ucfirst($f->format($amount))." naira only"; ?>
      </div>
    </div>

        <div style="display:flex;">
          Balance
          <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
            &nbsp;&nbsp;&nbsp;N&nbsp;<?php echo $balance; ?>&nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
          </div>
        </div>
        
        <div style="display:inline-flex;margin-top:50px;"> 

          <div align='left' style="border: solid 1px black;">
            &nbsp;N&nbsp;<?php echo $amount; ?> &nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
          </div>

          <div align='right'>
            <div align='center' style="border-bottom: solid 1px black;"></div>
            <div align='center'>Signature & Date</div>
          </div>

        </div>

      <a href="#" onclick="print_receipt();" id="btnPrint">print</a>
      <a href="#" onclick="history.back();" id="btnBack">Back</a>

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
    */

  }else {
      echo "error inserting expense record ".$con->error."<br/>";
  }



}





?>



<div>
    <h2>Expense Record Page</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?month=$month&session=$session";  ?>">
      <div class="form-group">
        <label>Description</label>
        <textarea col="20" rows="5" name="description" class="form-control" ></textarea>
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" />
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="float" name="price" class="form-control" id="price" />
      </div>

      <div class="form-group">
        <label>Supplier</label>
        <input type="text" name="supplier" class="form-control" />
      </div>

      <div class="form-group">
        <label>Date of Expense</label>
        <input type="date" name="date" class="form-control" />
      </div>

      <div class="form-group">
        <label>Amount Paid</label>
        <input type="text" name="amount_paid" class="form-control" oninput="calculate_balance(this.value)"/>
      </div>

      <div class="form-group">
        <label>Balance</label>
        <input type="text" name="balance" class="form-control" id="balance" />
      </div>
  
      <div class="input-group">
        <input type="submit" name="submit" class="form-control btn-success" value="Submit" />
        <input type="submit" name="back" class="form-control btn-warning" value="Back" formaction="fees_demo.php"/>
      </div>
  
    </form>
  </div>


  <script>
    
    function calculate_balance(amount_paid) {
      var quantity=document.getElementById("quantity").value;
      var price=document.getElementById("price").value;

     /*  average_price=price/quantity;
      document.getElementById("average_price").value=average_price;
 */

        
    
      balance = price-amount_paid;//price*quantity;    
      document.getElementById("balance").value=balance;
    }
      
  </script>


<?php

include_once("footer.php");

?>
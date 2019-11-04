<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "account" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
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
        <!-- <input type="submit" name="submit" class="form-control btn-success" formaction="print_sales_receipt.php" /> -->
        <input type="submit" name="add" class="form-control btn-success" value="Add" formaction="add_sales_record.php" />
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
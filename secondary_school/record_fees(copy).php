<?php
include_once("head.php");
require_once("connect.php");

$msg=array();




if (isset($_POST['pay'])) {
  include_once("sanitize.php");

  $amount=sanitize($_POST['amount']);
  $teller_no=sanitize($_POST['teller_no']);
  $bank=sanitize($_POST['bank']);
  $date_paid=sanitize($_POST['date_paid']);
  $session=sanitize($_POST['session']);
  $term=sanitize($_POST['term']);
  $std_id=sanitize($_GET['std_id']);
  $full_name=sanitize($_GET['full_name']);
  $class=sanitize($_GET['class']);
  $arm=sanitize($_GET['arm']);

  $data=explode(",",$full_name);
  $surname=trim($data[0]);
  $othernames=trim($data[1]);


  $session_formatted=str_replace("/","_",$session);


  // check if fees table has been created
  $fees_id="fees_".$session_formatted."_".$term;
  if (!$con->query("DESCRIBE `$fees_id`")) {
    echo "Fees table not created";
    exit();
  }


  // check if fees debtors table has been created
  if (!$con->query("DESCRIBE `fees_debtors`")) {
    echo "Fees debtors table not created";
    exit();
  }


  // get fees
  $result=$con->query("SELECT * FROM `fees` WHERE `session`='$session' AND `term`='$term'");
  if ($result && $result->num_rows > 0) {

    while ($row=$result->fetch_assoc()) {

      $ss_1_fees=$row['ss 1'];
      $ss_2_fees=$row['ss 2'];
      $ss_3_fees=$row['ss 3'];
      $jss_1_fees=$row['jss 1'];
      $jss_2_fees=$row['jss 2'];
      $jss_3_fees=$row['jss 3'];

    }
  }


  // get record of debts
  $result=$con->query("SELECT * FROM `fees_debtors` WHERE 
                    `session`='$session' AND `term`='$term' 
                    AND `std_id`='$std_id' AND `class`='$class' 
                    AND `arm`='$arm'");

  if ($result) {

    if ($result->num_rows > 0) {
      while ($row=$result->fetch_assoc()) {
        $amount_owed=$row['balance'];
        $fees=$row['fees'];
        $amount_paid=$row['amount_paid'];
      }

    }else {
      echo "No fee debt exists ";
    }
  }else {
    echo "Error getting fee debt record ".$con->error;
  }


  $balance = $amount_owed - $amount;
  $amount_paid += $amount;
  

  // insert into fees_id table

    $result=$con->query("INSERT INTO `$fees_id`(`std_id`,`surname`,`othernames`,`class`,`arm`,`amount_paid`,`bank`,`teller_no`,`date`)
                        VALUES('$std_id','$surname','$othernames','$class','$arm','$amount','$bank','$teller_no','$date_paid')");


    if ($result) {

      $receipt_no=$con->insert_id;

       // insert record into sales record
       $sales_id="sales_".$session_formatted."_".date("M",time());
       // check if sales record table exists
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
                                `amount_paid` INT NOT NULL,
                                `balance` INT NOT NULL
                                );");
        
          if ($result){
            echo "<div style='color:red;'>sales record successfully created</div>";       

          }else {
            echo "<div style='color:red;'>error creating sales record ".$con->error."</div>";
          }          
        
        }



        $result=$con->query("INSERT INTO `$sales_id`(`date`,`product_name`,`client`,`amount_paid`)
          VALUES('$date_paid','$term term $session school fees','$surname, $othernames','$amount')");

          if ($result) {

          // update debtors record
          $fees_debtors_id="fees_debtors";



          if ($balance == 0) {
            $result=$con->query("DELETE FROM `fees_debtors` WHERE `term`='$term' AND `session`='$session' 
                                AND `class`='$class' AND `arm`='$arm' AND `std_id`='$std_id'");

            if (!$result) {
              echo "error deleting debtors record ".$con->error;
            }
          
          
          }else {
            $result=$con->query("UPDATE `fees_debtors` SET `balance`='$balance',`amount_paid`='$amount_paid'
                              WHERE `term`='$term' AND `session`='$session' AND `std_id`='$std_id' AND `class`='$class' AND `arm`='$arm'");

            if (!$result) {
              echo "error updating debtors record ".$con->error;
            }
          }                  


          echo "<div style='color:red;'>Fees successfully inserted</div>";

          }else{

          echo "<div style='color:red;'>Error inserting fees in sales record ".$con->error."</div>";

          }


        if (strlen($receipt_no) == 1 ) {
          $receipt_no = "0000".$receipt_no;
        }elseif (strlen($receipt_no) == 2 ) {
          $receipt_no = "000".$receipt_no;
        }elseif (strlen($receipt_no) == 3 ) {
          $receipt_no = "00".$receipt_no;
        }elseif (strlen($receipt_no) == 4 ) {
          $receipt_no = "0".$receipt_no;
        }
      
      // design receipt
       ?>
      
        <div style="width:500px;" id="print_area">
      
          <div>
            <img src="../images/header.png" width="100%"/>
            <div style="display:flex;">
              <div align="right" style="width:50%;" style="text-align:right;"><b>School Fees Receipt</b></div>
              <div align="right" style="width:50%;" style="text-align:right;">Receipt No.: <?php echo $receipt_no; ?></div>
            </div>
            <div align='right'>Date: <?php echo date("d/m/Y",time()); ?></div>
          </div>
      
          <div>
            <div style="display:flex;border:50px 0;">
              Name:  
              <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
                &nbsp;&nbsp;&nbsp;<?php echo $full_name; ?>
              </div>
            </div>
      
            <div style="display:flex;">
              Amount:  
              <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
                &nbsp;&nbsp;&nbsp;<?php $f = new NumberFormatter("en",NumberFormatter::SPELLOUT);
                $f->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-numbering-verbose"); 
                echo ucfirst($f->format($amount))." naira only"; ?>
              </div>
            </div>
      
            <div style="display:flex;">
              Being:  
              <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
                &nbsp;&nbsp;&nbsp;<?php echo ucfirst($term)." term school fees for ".$session." academic session"; ?>
              </div>
            </div>
      
            <div style="display:flex;">
              Balance:  
              <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
                &nbsp;&nbsp;&nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo $balance; ?>&nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
              </div>
            </div>
            
            <div style="margin-top:50px;display:flex;"> 
      
              <div align="left" style="width:50%;">
                <div style="width:70%;">
                  <div style="border: solid 1px black;">
                    &nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo $amount; ?> &nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
                  </div>
                </div>
              </div>
      
              <div align="right" style="width:50%;">
                <div style="width:70%;">
                  <div style="border-bottom: solid 1px black;"></div>
                  <div style="text-align:centre;">Signature & Date</div>
                </div>
              </div>
      
            </div>
      
          </div>
      
          <a href="#" onclick="print_receipt();" id="btnPrint">print</a>
          <a href="javascript:history.back(2);" id="btnBack">Back</a>
      
        </div>
      
        <script>
      
      function print_receipt(){
      
        document.getElementById("btnPrint").style.display="none";
        document.getElementById("btnBack").style.display="none";
        var print_content = document.getElementById("print_area");
        var window_print = window.open("","","left=0, top=0, width=800, height=900, toolbar=0, scrollbars=0, status=0");
        window_print.document.write(print_content.innerHTML);
        //window_print.document.write(print_content.style);
        //window_print.document.write(print_content.title,"School fees receipt");
        window_print.document.close();
        window_print.focus();
        window_print.print();
        window_print.close();
      
        document.getElementById("btnPrint").style.display="block";
        document.getElementById("btnBack").style.display="block";
      
      }
      
      </script>
      
      
      <?php   
       

    }else{
      echo "<div style='color:red;'>Error inserting fees ".$con->error."</div>";
    }


  exit();
}






  
if (isset($_POST['submit'])) {
  $std_id=$_POST['std_id'];
  $full_name=$_POST['full_name'];

  $result=$con->query("SELECT * FROM `student_class` WHERE `std_id`='$std_id'");
  if ($result->num_rows == 1 ) {
    while ($row=$result->fetch_assoc()) {
      $class=strtoupper($row['class']);
      $arm=strtoupper($row['arm']);
    }
  }



?>

<div class="container">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?std_id=$std_id&full_name=$full_name&class=$class&arm=$arm"; ?>" >
    <table style="width:70%;">

      <tr>
        <td>
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>" disabled/>
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Class</label>
            <input type="text" name="class" class="form-control" value="<?php echo $class; ?>" />
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Arm</label>
            <input type="text" name="arm" class="form-control" value="<?php echo $arm; ?>" />
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Session</label>
            <select name="session" class="form-control" id="session" required
            onchange="var t=document.getElementById('term');str_text='get_fees_owed.php?term='+t.value+'&session='+this.value+'&std_id='+<?php echo $std_id; ?>;get_data(str_text,'amount_due');">
              <option value="2014/2015">2014/2015</option>
              <option value="2015/2016">2015/2016</option>
              <option value="2016/2017">2016/2017</option>
              <option value="2017/2018">2017/2018</option>
              <option value="2018/2019">2018/2019</option>
              <option value="2019/2020" selected>2019/2020</option>
              <option value="2020/2021">2020/2021</option>
              <option value="2021/2022">2021/2022</option>
              <option value="2022/2023">2022/2023</option>
              <option value="2023/2024">2023/2024</option>
              <option value="2024/2025">2024/2025</option>
              <option value="2025/2026">2025/2026</option>
            </select>
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Term</label>
            <select name='term' class="form-control" required id="term"
            onchange="var sess=document.getElementById('session');str_text='get_fees_owed.php?session='+sess.value+'&term='+this.value+'&std_id='+<?php echo $std_id; ?>;get_data(str_text,'amount_due');">
              <option value="first">FIRST</option>
              <option value="second">SECOND</option>
              <option value="third">THIRD</option>
            </select>
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            Amount Due: <div id="amount_due" style="font-weight:bolder;color:red;"></div>            
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group has-error has-feedback">
            <label>Amount Paid</label>
            <input type="number" name="amount" id="amount" class="form-control" onchange="return check_fees();" required/>
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Teller No</label>
            <input type="text" name="teller_no" class="form-control" required/>
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Date Paid</label>
            <input type="date" name="date_paid" class="form-control" />
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="form-group">
            <label>Bank</label>
            <input type="text" name="bank" class="form-control" />
          </div>
        </td>
      </tr>

      <tr>
        <td>
          <div class="input-group">
            <input type="submit" name="pay" class="btn btn-success form-control" Value="Pay" onclick="return check_fees();"/>
            <input type="submit" name="Back" class="btn btn-warning form-control" Value="Back" formaction="fees_demo.php" />
          </div>
        </td>
      </tr>

    </table>

  </form>


</div>


<script>
  function check_fees() {
    var amount_paid = document.getElementById("amount").value;
    var amount_due = document.getElementById("amount_due").innerHTML;
    amt_paid = parseInt(amount_paid);
    amt_due = parseInt(amount_due);
    if (amt_paid > amt_due) {
      alert("amount paid for selected term is higher than amount owed.");
      return false;
    }else{
      return true;
    }
  }


</script>

<?php

include_once("foot.php");

exit();
}
?>

<div class='container'>
  <h2 align='center'>Record Fees</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <p><!-- <form method='POST' action=''> -->
    <div class='form-control'>Search database for student
      <div class='input-group'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' placeholder="search for student here"
        oninput="javascript:var data=document.getElementById('search'); get_data('search_student.php?name='+data.value,'display_result');">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div>
  </p>
  <div id='display_result'></div>
</div>



<?php

include_once("footer.php");

?>
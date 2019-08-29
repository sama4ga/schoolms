<?php
require_once("connect.php");
include_once("head.php");

$result = $con->query("SELECT * FROM `tmp`");
if ($result) {
  $num_records = $result->num_rows;
  if ($num_records > 0) {
    while ($row = $result->fetch_assoc()) {
      $product_name[] = $row['product_name'];
      $client = $row['client'];
      $quantity[] = $row['quantity'];
      $amount_paid[] = $row['amount_paid'];
      $balance[] = $row['balance'];
      $receipt_no = $row['receipt_no'];
    }
    $total_amount = array_sum($amount_paid);
  }
}


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

<?php
  for ($i=0; $i < $num_records; $i++) { 
    $count = $i + 1;
    echo "<tr>
            <td>".$count."</td>
            <td>".$product_name[$i]."</td>
            <td>".$quantity[$i]."</td>
            <td>".$amount_paid[$i]."</td>
            <td>".$remark."</td>
          </tr>";
  }

?>
    <tr>
      <td colspan="3" style="font-weight:bold;">Total</td>
      <td><?php echo $total_amount; ?></td>
      <td></td>
    </tr>
  </table>


<div style="display:flex;margin-top:50px;">
  <div>Amount in words</div>
  <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
    &nbsp;&nbsp;&nbsp;<?php $f = new NumberFormatter("en",NumberFormatter::SPELLOUT);
    $f->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-numbering-verbose"); 
    echo ucfirst($f->format($total_amount))." naira only"; ?>
  </div>
</div>

    <div style="display:flex;">
    <div>Balance</div>
      <div style="border-bottom: dotted 1px black; width:100%; margin-bottom: 20px;">
        &nbsp;&nbsp;&nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo array_sum($balance); ?>&nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
      </div>
    </div>
    
    <div style="margin-top:50px;display:flex;"> 

      <div align="left" style="width:50%;">
        <div  style="border:solid 1px black;width:70%;">
          &nbsp;<span style="text-decoration:line-through double;">N</span>&nbsp;<?php echo $total_amount; ?> &nbsp;&nbsp;:&nbsp;00&nbsp;K&nbsp;
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
    <a href="record_sales(copy1).php" id="btnBack">Back</a>
  </div>

</div>


<?php
  $result = $con->query("TRUNCATE TABLE `tmp`");
?>

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
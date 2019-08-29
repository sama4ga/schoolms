<?php
require_once("connect.php");

$fees_id = $_REQUEST['fees_id'];
$record_id = $_REQUEST['record_id'];

$props = explode("_",$fees_id);
$term = $props[3];
$session = $props[1]."/".$props[2];

$result = $con->query("SELECT * FROM `$fees_id` WHERE `fees_id`='$record_id'");
if ($result) {
  if ($result->num_rows) {
    while ($row = $result->fetch_assoc()) {
      $receipt_no = $row['fees_id'];
      $date = $row['date'];
      $balance = $row['balance'];
      $amount = $row['amount_paid'];
      $surname = $row['surname'];
      $othernames = $row['othernames'];
    }

    $full_name = $surname.", ".$othernames;
  }
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
    <div align='right'>Date: <?php echo $date; ?></div>
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



?>
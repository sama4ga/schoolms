<?php
session_start();
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "account" && $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
include_once("head.php");

?>

<div>
  
  
  <div class="row">
  
    <div class="col-4">
      <div class="form-group">
        <label>Session</label>
        <select name="session" class="form-control" id="session">
          <option value="2014/2015">2014/2015</option>
          <option value="2015/2016">2015/2016</option>
          <option value="2016/2017">2016/2017</option>
          <option value="2017/2018">2017/2018</option>
          <option value="2018/2019" >2018/2019</option>
          <option value="2019/2020" selected>2019/2020</option>
          <option value="2020/2021">2020/2021</option>
          <option value="2021/2022">2021/2022</option>
          <option value="2022/2023">2022/2023</option>
          <option value="2023/2024">2023/2024</option>
          <option value="2024/2025">2024/2025</option>
          <option value="2025/2026">2025/2026</option>
        </select>
      </div>

      <ul style="list-style:none;">
        <li><a class="btn" style="padding-left:0px;" href="#" onclick="javascript: var session=document.getElementById('session').value; 
                           get_data('sales_record.php?month=jan&session='+session,'display');">January</a></li>
        <li><a class="btn" style="padding-left:0px;" href="#" value="february" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=feb&session='+session,'display');">February</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=mar&session='+session,'display');">March</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=apr&session='+session,'display');">April</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=may&session='+session,'display');">May</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=jun&session='+session,'display');">June</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=jul&session='+session,'display');">July</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=aug&session='+session,'display');">August</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=sep&session='+session,'display');">September</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=oct&session='+session,'display');">October</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=nov&session='+session,'display');">November</a></li>
        <li><a class="btn" href="#" onclick="javascript: var session=document.getElementById('session').value;
                           get_data('sales_record.php?month=dec&session='+session,'display');">December</a></li>
      </ul>
    </div>

    <div class="col-8" id="display" align="right">  
      
    </div>
  </div>

  <a href="javascript:history.back();" class="btn btn-warning btn-md">Back</a>

</div>


  <?php 


require_once("footer.php");



?>
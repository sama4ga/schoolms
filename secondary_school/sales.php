<?php
include_once("header.php");
require_once("connect.php");

 //echo $status;
if ($status !== "admin" && $status !== "account") {
  header("location:forbidden.php"); 
  exit();
}


?>

<h1 align='center'>Sales/Inventory Portal</h1>

<div id='info' style='color:red;'></div>

<div style="display: flex;height:1000px;">
  <nav class="navbar navbar-inverse" style="width:250px;align-content:start;">
    <div class="container-fluid" >
      <ul class='nav navbar-nav'>        
        <li><a href='#' onclick="javascript:document.getElementById('display').src='record_sales(copy1).php'">Record Sales</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='view_sales_record.php'">View Sales Record</a></li>
        <li><a href='#' onclick="javascript:document.getElementById('display').src='record_expenses.php'">Record Expenses</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='view_expenses.php'">View Expenses Record</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='load_products.php'">Load Products</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='sales_debtors(copy).php'">Show Debtors</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='end_of_year_summary.php'">View Summary Record</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='view_stocks.php'">View Stocks</a></li>
      </ul>
    </div>

    <div><a href='admin_portal.php' class='btn btn-warning form-control'>Exit Sales Portal</a></div>
  
  </nav>

  


  <div style="width:100%;height:100%;" align='right'>
    <iframe id="display" src="fees_demo.php" ></iframe>
  </div>

</div>
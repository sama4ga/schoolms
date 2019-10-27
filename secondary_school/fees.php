<?php
include_once("auth.php");
if ($priviledge !== "bursar" || $priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}
include_once("header.php");
require_once("connect.php");


?>

<h1 align='center'>Fees Portal</h1>

<div id='info' style='color:red;'></div>

<div style="display: flex;height:1000px;">
  <nav class="navbar navbar-inverse" style="width:250px;align-content:start;">
    <div class="container-fluid" >
      <ul class='nav navbar-nav'>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='setup_fees.php'">Setup Fees</a></li>
        <?php

          $session=strtolower($_SESSION['session']);
          $term=strtolower($_SESSION['term']);
          
          $session_format=str_replace("/","_",$session);
          
          $fees_id="fees_".$session_format."_".$term;

          if (!$con->query("DESCRIBE `$fees_id`")) {
            echo "<li><a href=\"javascript: get_data('create_fees_table(copy).php?session=$session_format','info');\">Create Fees Table</a></li>";
          }

        ?>
        <li><a href='#' onclick="javascript:document.getElementById('display').src='record_fees(copy).php'">Record Fees</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='view_fees_record.php'">View Fees Record</a></li>
        <li><a href="#" onclick="javascript:document.getElementById('display').src='debtors(copy).php'">Show Debtors</a></li>
      </ul>
    </div>

    <div><a href='admin_portal.php' class='btn btn-warning form-control'>Exit Fees Portal</a></div>
  
  </nav>

  


  <div style="width:100%;height:100%;" align='right'>
    <iframe id="display" src="fees_demo.php"></iframe>
  </div>

</div>

<?php

include_once("footer.php");

?>
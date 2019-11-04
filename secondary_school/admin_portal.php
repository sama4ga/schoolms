<?php
include_once("header.php");
include_once("connect.php");

include_once("auth.php");
if ($priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

?>

<div class='container menu' align='center' style="width:60%;align-self:center;">
  <div class="row" style="margin-bottom:100px;width:100%;">
    <a href="manage_students.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/students.jpeg" width="100%" height="90%" style="border-radius:25px;"/>Manage Student</div></a>
    <a href="misc.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/user.jpg" width="100%" height="90%" style="border-radius:25px;"/>Miscellenous</div></a>    
    <a href="manage_staff.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/teacher.jpg" width="100%" height="90%" style="border-radius:25px;background-color:white;"/>Manage Staff</div></a>
  </div>
  
  <div class="row" style="margin-bottom:100px;">
    <a href="message_portal.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/message.jpg" width="100%" height="90%" style="border-radius:25px;"/>Message/Email Portal</div></a>
    <a href="sales.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/payment_icon.png" width="100%" height="90%" style="border-radius:25px;background-color:white;"/>Sales and Inventory</div></a>    
    <a href="fees.php" class="col-4"><div style="width:100%;background-color:#9a9393;margin-right:20px;border-radius:25px;height:200px;border:#9a9393 solid 2px;color:white;font-weight:bold;"><img src="../images/money.jpg" width="100%" height="90%" style="border-radius:25px;"/>Fees Payment</div></a>
  </div>
</div>


<?php

include_once("footer.php");


?>
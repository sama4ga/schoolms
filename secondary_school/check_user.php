<?php

//echo session_status();
//var_dump($_SESSION);
  if (session_status() == 1 ) {
    session_start(); // 1=not running     2=running    
  }

  // check user details
  if (isset($_SESSION['user_id'])) {
    $priviledge = $_SESSION['priviledge'];
  }else {
    header("location:login.php");
  }

?>
<?php
session_start();
//ini_set('display_errors', 0); 
 
 setcookie("user", " ", time()-360000, "/");
 session_destroy();
 session_unset();
 
header("Location: index.php");

?>
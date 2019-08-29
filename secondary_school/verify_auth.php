<?php
include_once("auth.php");

if ($privildge != "admin") {
  header("Location:forbidden.php");
  exit();
}
?>
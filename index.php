<?php

if (file_exists("setup.php")) {
  include_once("setup.php");
}else {

  include_once("check_license.php");

  if ($cleared == "true") {    
    header("location:secondary_school/index.php");
  }
}

?>
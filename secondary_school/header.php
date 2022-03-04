<?php
session_start();

$name="";
$status="";

if (isset($_SESSION)) {
  $name=$_SESSION['name'];
  $status=ucwords(str_replace("_"," ",$_SESSION['priviledge']));
  $school_name=$_SESSION['school_name'];
  $school_address=$_SESSION['school_address'];
  $motto=$_SESSION['motto'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--    <meta name="icon" url="../images/icon.ico"> -->
    <!-- Bootstrap CSS >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"-->
    <link rel='stylesheet' href='../scripts/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' href='../scripts/bootstrap/css/main.css'>

</head>
<body>
  <div style="position:static; top:0;width: 100%;height: auto;">
    <div class="row" style="flex-wrap:nowrap;">
      <div style="width: 100px;">
        <img src="../images/logo.png" height="auto" width="100px">
      </div>
      <div class="col-6" style="min-width: 200px; overflow: hidden;">
        <div style="width:100%">
          <div style="font-size: 12pt;font-weight:bold"><?php echo $school_name; ?></div>
          <div style="font-size: 11pt;font-weight:bold;white-space:nowrap;"><?php echo $school_address; ?></div>
          <div style="font-size: 10pt;font-style:italic;font-weight:bold">motto: <?php echo $motto; ?></div>
        </div>
      </div>
      <div class="col-4">
        Welcome <b><?php echo $name; ?></b>
      </div>      
    </div>

    <div id="nav-bar" class="flex-wrap:nowrap;">
      <div align="right" class="col-12"  style="margin-bottom:40px;">
        Current&nbsp;User&nbsp;Status:&nbsp;<b><?php echo $status; ?></b>&nbsp;&#124;&nbsp;<a href="index.php" class="menu-item">Home</a>&nbsp;&#124;&nbsp;<a href="logout.php" class="menu-item">Logout</a>&nbsp;&#124;&nbsp;<a href="change_login_detail.php" class="menu-item">Change&nbsp;Passcode</a>
      </div>
    </div>
  </div>

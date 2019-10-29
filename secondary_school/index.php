<?php
session_start();
ob_start();
include_once("connect.php");
include_once("head.php");

include_once("config.php");


include_once("auth.php");

if ($auth !== 'true') {

   header("location:".$URL_ROOT."/login.php");
   exit();
   //include_once("login.php");

}else {
  if ($priviledge == 'teaching_staff') {

    header("Location:".$URL_ROOT."/class_portal.php");
    exit;

  }elseif ($priviledge == 'class_teacher') {

    header("Location:".$URL_ROOT."/class_teacher_portal.php");
    exit();

  }elseif ($priviledge == 'account') {

    header("Location:".$URL_ROOT."/sales.php");
    exit;

  }elseif ($priviledge == 'bursar') {

    header("Location:".$URL_ROOT."/fees.php");
    exit;

  }elseif ($priviledge == 'pro') {

    header("Location:".$URL_ROOT."/message_portal.php");
    exit;

  }elseif ($priviledge == 'non_teaching_staff') {

    header("Location:".$URL_ROOT."/non_admin_portal.php");
    exit;

  }elseif ($priviledge == 'admin') {

    header("Location:".$URL_ROOT."/admin_portal.php");
    exit;

  }else {
    
    header("location:".$URL_ROOT."/forbidden.php");
    exit;
  }

}
ob_end_flush();

 


?>
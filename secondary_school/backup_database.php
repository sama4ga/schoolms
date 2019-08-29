<?php
require("connect.php");
$upas ="";
$uname = "root";
$dbname = "managementsystem";
/* $upas= exo_get_protstring("str2");
$uname= exo_get_protstring("str1");
$dbname= exo_get_protstring("str0"); */

echo "<div>Backup in progress...</div>";

if (!file_exists("backup")) {
  mkdir("backup");
}

$dir = __DIR__."/backup/backup".date("ymdhis",time()).".sql";

// get backup files
$file = scandir(__DIR__."/backup/");


$res=system("mysqldump -u $uname $dbname > $dir ");
 //print_r($file);
 //echo ($res);
if ($res == "") {
  if (array_key_exists(2,$file) && is_file($file[2])) {
    unlink($file);  
  }
  echo "<div>Backup complete ".$res."</div>";
}


?>
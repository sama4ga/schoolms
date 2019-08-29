<?php
$host='localhost';
$dbname='managementsystem';
$uname='root';
$upas='';
/* $upas= exo_get_protstring("str2");
$uname= exo_get_protstring("str1");
$dbname= exo_get_protstring("str0");
$host= exo_get_protstring("str3"); */

// CREATE CONNECTION
$con=new mysqli($host,$uname,$upas,$dbname);
// check connection
if ($con -> connect_errno){
    die("could not connect to the database because: ". $con -> connect_error);
}

$site='schoolms.com.ng';
?>
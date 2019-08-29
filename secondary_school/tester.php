<?php
session_start();

//echo $_SESSION['session'];
/* $start=date_create("2018-03-15");//date('l, d M, Y',time());
echo date_format($start,'l, d M, Y');
date_add($start,date_interval_create_from_date_string("9weeks"));
echo "<br/>".date_format($start,'l, d M, Y'); */
//echo preg_replace("/[^A-Za-z0-9_-]/","_","3015/1205");
//$start=strtotime("1993-09-09");
//$today=time(); // preg_replace("/[^A-Za-z]/","","birth_certificate"); //substr(str_shuffle(time()),1,5);
//$next=date_add($today,date_interval_create_from_date_string("9weeks"));
//$re=floor(($today-$start)/(60*60*24*365));echo $re;

/* $f = new NumberFormatter("en",NumberFormatter::SPELLOUT);
$f->setTextAttribute(NumberFormatter::DEFAULT_RULESET,"%spellout-numbering-verbose"); 
echo $f->format(5542548); */

/* $fmt=numfmt_create("en_US",NumberFormatter::SPELLOUT);
$in_words=numfmt_format($fmt,'5487');
print_r($in_words); */

//$m=array(10,5); //$result = (empty($m)) ? "true" : "false" ; 
//if (empty($m)) {
//  echo "true";
//}
//echo $result;
//print_r($m);
//$ans=;
//echo $ans;
//print_r($m);
//echo time();

/* if (isset($_POST['submit'])) {
  $key=$_POST['security'];
  echo $key;
}

$m=[5,"",6,8,"","",9];
print_r($m);



?>

<form action="tester.php" method='POST'>
  Username: <input type='text' name='username' list='browsers'>
  Encryption:<keygen name='security'>
  <datalist id='browsers'>
    <option value='Internet Explorer'>
    <option value='Firefox'>
    <option value='Chrome'>
    <option value='Safari'>
  </datalist>
  <input type='submit' value='submit' name='submit'>
</form>

<code>
x = 5;
y = 6;
z = x + y;
</code>
 

array_splice($data,5,1);*/

echo $_SESSION['session'];

//echo($x);
?>
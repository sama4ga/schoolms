<?php
// session_start();
include_once("head.php");

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

//echo $_SESSION['session'];

//echo($x);
?>

<p>
<button type="button" class="btn btn-default">
<span class="glyphicon glyphicon-sort-by-attributes"></span>
<button type="button" class="btn btn-default">
<span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
</button>

<button type="button" class="btn btn-default">
<span class="glyphicon glyphicon-sort-by-order"></span>
</button>
<button type="button" class="btn btn-default">
<span class="glyphicon glyphicon-sort-by-order-alt"></span>
</button>
</p>
<button type="button" class="btn btn-default btn-lg">
<span class="glyphicon glyphicon-user"></span> User
</button>
<button type="button" class="btn btn-default btn-sm">
<span class="glyphicon glyphicon-user"></span> User
</button>
<button type="button" class="btn btn-default btn-xs">
<span class="glyphicon glyphicon-user"></span> User
</button>

<!-- nav tabs -->
<p>Tabs Example</p>
<ul class="nav nav-tabs">
<li class="active"><a href="#">Home</a></li>
<li><a href="#">SVN</a></li>
<li><a href="#">iOS</a></li>
<li><a href="#">VB.Net</a></li>
<li><a href="#">Java</a></li>
<li><a href="#">PHP</a></li>
</ul>

<ul class="pagination pagination-lg">
<li><a href="#">&laquo;</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul><br>
<ul class="pagination">
<li><a href="#">&laquo;</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul><br>
<ul class="pagination pagination-sm">
<li><a href="#">&laquo;</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul>


<ul class="pager">
<li class="previous"><a href="#">&larr; Older</a></li>
<li class="next"><a href="#">Newer &rarr;</a></li>
</ul>


<h4>Example for Active State in Pill </h4>
<ul class="nav nav-pills">
<li class="active"><a href="#">Home <span class="badge">42</span></a></li>
<li><a href="#">Profile</a></li>
<li><a href="#">Messages <span class="badge">3</span></a></li>
</ul>
<br>
<h4>Example for Active State in navigations</h4>
<ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
<li class="active">
<a href="#">
<span class="badge pull-right">42</span>
Home
</a>
</li>
<li><a href="#">Profile</a></li>
<li>
<a href="#">
<span class="badge pull-right">3</span>
Messages
</a>
</li>
</ul>



<div class="progress progress-striped active">
  <div class="progress-bar progress-bar-success" role="progressbar"
    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
    style="width: 40%;">
    <span class="sr-only">40% Complete</span>
  </div>
</div>


<div class="panel panel-default">
<div class="panel-heading">
Panel heading without title
</div>
<div class="panel-body">
Panel content
</div>
</div>


<?php
include_once("foot.php");
?>
<?php
//require_once("connect.php");
$host='localhost';
$dbname='managementsystem';
$uname='root';
$upas='';

/* $upas= exo_get_protstring("str2");
$uname= exo_get_protstring("str1");
$dbname= exo_get_protstring("str0");
$host= exo_get_protstring("str3");
 */

// CREATE CONNECTION
$con=new mysqli($host,$uname,$upas);
// check connection
if ($con->connect_errno){
    die("could not connect to the database because: ". $con->connect_error);
}




if (isset($_POST['submit'])) {
  include_once("sanitize.php");

  // drop database
  $result = $con->query("DROP DATABASE IF EXISTS `$dbname`");
  if(!$result){
    echo "Error occured while dropping database $dbname: ".$con->error."<br/>";
  }


  // create database
  $result = $con->query("CREATE DATABASE IF NOT EXISTS `$dbname`");
  if(!$result){
    echo "Error occured while creating database $dbname: ".$con->error."<br/>";
  }


  /*  // insert record into database
  $url = __DIR__;
  $url = str_replace("\\","/",$url);
  echo $url;
  print_r(scandir($url));
  exit(); */

  /* //system("mysql -u root dmc < $url");
  $res=system("mysql -u root managementsystem < $url/secondary_school/student.sql");
  $res=system("mysql -u root managementsystem < $url/secondary_school/student_class.sql");
  $res=system("mysql -u root managementsystem < $url/secondary_school/staff.sql");
  $res=system("mysql -u root managementsystem < $url/secondary_school/staff_class.sql");
  $res=system("mysql -u root managementsystem < $url/secondary_school/session_info.sql");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/jss 1.sql\"");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/jss 2.sql\"");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/jss 3.sql\"");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/ss 1.sql\"");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/ss 2.sql\"");
  $res=system("mysql -u root managementsystem < \"$url/secondary_school/ss 3.sql\"");
  $res=system("mysql -u root managementsystem < $url/secondary_school/arm.sql");

*/
  $res=system("mysql -u $uname $dbname < secondary_school.sql");
  if(!$res){
    echo "Error occured while importing sql data: ".$res."<br/>";
  }


  // show all tables
  // $result = $con->query("SHOW TABLES IN `managementsystem`");

    $no_of_std_per_class = sanitize($_POST['no_of_std_per_class']);
    $no_of_ca = 4;
    $ca_score = 40;
    $exam_score = 60;
    /* $no_of_ca = sanitize($_POST['no_of_ca']);
    $ca_score = sanitize($_POST['ca_score']);
    $exam_score = sanitize($_POST['exam_score']); */
    $session = sanitize($_POST['session']);
    $term = sanitize($_POST['term']);
    $start_date = date("Y-m-d",strtotime(sanitize($_POST['date_began'])));
    $end_date = date("Y-m-d",strtotime(sanitize($_POST['date_end'])));
//echo $start_date;

    $result = $con->query("CREATE TABLE IF NOT EXISTS $dbname.`school_info`(
      `id` INT PRIMARY KEY AUTO_INCREMENT,
      `school_name` varchar(200),
      `code_name` varchar(20),
      `school_address` varchar(100),
      `motto` varchar(100),
      `license_start` timestamp,
      `license_end` timestamp,
      `setup_date` timestamp DEFAULT CURRENT_TIMESTAMP,
      `no_of_students` int default 0,
      `password` varchar(40),
      `no_of_ca` INT(2),
      `no_of_std_per_class` INT(2),
      `ca_score` INT(2),
      `exam_score` INT(2))
      ");

  if($result){
  $result = $con->query("INSERT INTO $dbname.`school_info`(
            `school_name`,
            `code_name`,
            `school_address`,
            `motto`,
            `password`,
            `no_of_std_per_class`,
            `no_of_ca`,
            `ca_score`,
            `exam_score`,
            `license_start`,
            `license_end`
          )
          VALUES(
            'Detip Model College',
            'dmc',
            'Agueri, Atan, Ota, Ogun State, Nigeria',
            'learning is key',
            'detipcollege',
            '$no_of_std_per_class',
            '$no_of_ca',
            '$ca_score',
            '$exam_score',
            '2019/05/06',
            '2019/09/06'
          )");


    if ($result) {

      $result = $con->query("INSERT INTO $dbname.`session_info`(
                            `session`,
                            `term`,
                            `term_began`,
                            `term_ends`,
                            `next_term_begins`,
                            `next_term_ends`
                            ) VALUES(
                              '$session',
                              '$term',
                              '$start_date',
                              '$end_date',
                              '$end_date',
                              '$end_date'
                            )");


      if ($result) {

        rename("setup.php","setup_done.php");
        header("location:secondary_school/index.php");
        exit();
      }else {
        echo "Could not insert session data ".$con->error."<br/>";
      }

    }else {
      echo "Could not insert data in school_info table ".$con->error."<br/>";
    }




 }else {
  echo "Could not create table school_info ".$con->error."<br/>";
}

}



?>

<!Doctype html>
<html>
<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS >
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"-->
  <link rel='stylesheet' href='scripts/bootstrap/css/bootstrap.min.css'>
  <link rel='stylesheet' href='scripts/bootstrap/css/main.css'>


</head>
<body>

<div class="container">
  <div><h1>Setup School Management System</h1></div>
  <div style="font-style:italic;margin:10px;">
    This is a one time setup to get you started.<br/>
    Please supply the information below.
  </div>
  <div>
    <form method="POST" action="" class="form panel">
      
      <!-- <div class="form-group">
        <label>Number of continuous assessment</label>
        <input type="number" name="no_of_ca" class="form-control" value="4"/>
      </div> -->

      <div class="form-group">
        <label>Maximum Number of students per class</label>
        <input type="number" name="no_of_std_per_class" class="form-control" value="30"/>
      </div>

      <!-- <div class="form-group">
        <label>Continuous Assessment Score</label>
        <input type="number" name="ca_score" class="form-control" value="40"/>
      </div>

      <div class="form-group">
        <label>Exam Score</label>
        <input type="number" name="exam_score" class="form-control" value="60"/>
      </div> -->

      <div class="form-group">
        <label>Session</label>
        <select name="session" class="form-control">
          <option value="2014/2015">2014/2015</option>
          <option value="2015/2016">2015/2016</option>
          <option value="2016/2017">2016/2017</option>
          <option value="2017/2018">2017/2018</option>
          <option value="2018/2019" selected>2018/2019</option>
          <option value="2019/2020">2019/2020</option>
          <option value="2020/2021">2020/2021</option>
          <option value="2021/2022">2021/2022</option>
          <option value="2022/2023">2022/2023</option>
          <option value="2023/2024">2023/2024</option>
          <option value="2024/2025">2024/2025</option>
          <option value="2025/2026">2025/2026</option>
        </select>
      </div>

      <div class="form-group">
        <label>Term</label>
        <select name="term" class="form-control">
          <option value="first">First</option>
          <option value="second">Second</option>
          <option value="third">Third</option>
        </select>
      </div>

      <div class="form-group">
        <label>Date Term Began</label>
        <input type="date" name="date_began" class="form-control" required/>
      </div>

      <div class="form-group">
        <label>Expected Date Term Will End</label>
        <input type="date" name="date_end" class="form-control" required/>
      </div>

      <div>
        <input type="submit" name="submit" value="Submit" class="form-control btn-success"/>
      </div>
    </form>
  </div>
</div>
</body>
</html>
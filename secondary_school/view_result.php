<?php
require_once 'connect.php';
include_once "head.php";

$res_id=$_GET['resid'];
$class=$_GET['class'];
$term=$_GET['term'];
$session=$_GET['session'];
$temp=explode("_",$res_id);
$arm=end($temp);



if (!$con->query("DESCRIBE `$res_id`")) {
  echo "<div style='color:red;'>Result sheet not available for the selected class.<br/>
          Create result sheet to continue.<br/>
          <a href='javascript:history.back();' class='btn btn-warning'>Back</a>  
        </div>";
        exit();
}

$result=$con->query("SELECT * FROM `$res_id`");
if($result){

  $num_students=$result->num_rows;

  if ($num_students > 0) {

    echo "<table width='470' cellspacing='0' cellpadding='2' border='0' align='center'>			
            <tbody>";

    $x=0;
    while ($row=$result->fetch_assoc()) {

      $count=$x+1;
      $std_id[$x]=$row['std_id'];
      $uid[$x]=$row['uid'];
      $surname[$x]=$row['surname'];
      $othernames[$x]=$row['othernames'];
      $full_name[$x]=$surname[$x].", ".$othernames[$x];

      

      $x++;
    }



    echo "<h2>View Students' Computed Results</h2>
          <div align='center'><b>Results for ".strtoupper($class)." ".strtoupper($arm)." for ".strtoupper($term)." term $session academic session</b></div>
          <p>
          <table border='0' cellpadding='0' class='data'>";
      
    for ($i=0; $i < $num_students; $i++) {


      echo "  <tr>
                <td>".$full_name[$i]."</td>
                <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  <a href='view_detailed_result(copy).php?uid=$uid[$i]&class=$class&arm=$arm&result_id=$res_id' class='btn btn-success' target='_blank'>View Detailed Result</a></td>
              </tr>";

    }

    echo "</table>";

    echo "<a href='javascript:history.back();' class='btn btn-warning'>Back</a>";
  }

}else {
  echo "Error occured while reading student's data ".$con->error;
}
?>
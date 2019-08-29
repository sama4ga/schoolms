<?php
require_once 'connect.php';
include_once "head.php";

$res_id=$_GET['resid'];
$class=$_GET['class'];



if (!$con->query("DESCRIBE `$res_id`")) {
  echo "<div>Result sheet not available for the selected class.<br/>
          Create result sheet to continue.<br/>
          <a href='javascript:history.back();' class='btn-md btn-warning'>Back</a>  
        </div>";
        exit();
}


$result=$con->query("SELECT * FROM `$res_id`");
if($result){
  if ($result->num_rows > 0) {
    echo "<table width='470' cellspacing='0' cellpadding='2' border='0' align='center'>			
            <tbody>";
    $x=0;
    while ($row=$result->fetch_assoc()) {
      $count=$x+1;
      $std_id[$x]=$row['std_id'];
      $surname[$x]=$row['surname'];
      $othernames[$x]=$row['othernames'];
      $full_name[$x]=$surname[$x].", ".$othernames[$x];

      echo "<tr height='30'>
                <td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #C0C0C0' width='50' align='center'>".$count."</td>
                <td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #C0C0C0' valign='middle'>
                  ".$full_name[$x]."
                </td>
                <td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #C0C0C0' valign='middle' >
                  <a title='Click Here to Edit result of ".$full_name[$x]."' href='edit_result.php?stdid=$std_id[$x]&resid=$res_id&class=$class&name=$full_name[$x]' class='btn btn-success'> 
                      Edit Result
                  </a>
                </td>
            </tr>";

      $x++;
    }

    echo "    <tr>
                <td><a href='javascript:history.back();' class='btn btn-warning'>Back</a></td>
              </tr>
            </tbody>
          </table>";
  }

}else {
  echo "Error occured while reading student's data ".$con->error;
}
?>
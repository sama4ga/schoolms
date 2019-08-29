<?php
require_once 'connect.php';
include_once "header.php";

$class=$_GET['class'];
$arm=$_GET['arm'];

$result=$con->query("SELECT * FROM `student` s
                    LEFT JOIN `student_class` sc
                    ON s.`std_id`=sc.`std_id`
                    WHERE sc.`class`='$class'
                    AND sc.`arm`='$arm'");

if ($result->num_rows > 0) {
  echo "<h1 align='center'>Showing Class list for ".strtoupper($class)." ".strtoupper($arm)."</h1><p>
        <table width='470' cellspacing='0' cellpadding='2' border='0' align='center'>			
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
                <a title='Click Here to Edit details of ".$full_name[$x]."' href='edit_student_data.php?id=$std_id[$x]' class='btn btn-success'> 
                    Edit Student Data
                </a>
              </td>
          </tr>";
          $x++;
  }

  echo "  </tbody>
        </table>";
}
?>
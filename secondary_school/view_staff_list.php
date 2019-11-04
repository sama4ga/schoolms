<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "admin") {
  header("location:forbidden.php");
   exit();
}

  
  $result=$con->query("SELECT * FROM `staff` WHERE `staff_id`<>'1'");

if ($result) {
  
  if ($result->num_rows > 0) {
  
    echo "<h1 align='center'>Showing Staff list </h1><p>";
  
    echo "<table cellspacing='10' cellpadding='10' border='0' align='center' class='data'>			
            <tbody>
              <tr>
                <th>S/N</th>
                <th style='min-width:200px;'>Staff Name</th>
                <th>Staff Reg. No.</th>
                <th>Position</th>
                <th>Priviledge</th>
                <th></th>
              </tr>";
  
    $x=0;
    while ($row=$result->fetch_assoc()) {
  
      $count=$x+1;
      $staff_id[$x]=$row['staff_id'];
      $staff_reg_no[$x]=$row['staff_reg_no'];
      $surname[$x]=$row['surname'];
      $othernames[$x]=$row['othernames'];
      $full_name[$x]=$surname[$x].", ".$othernames[$x];
      $position=$row['position'];
      $priviledge=str_replace("_"," ",$row['priviledge']);
  
      echo "<tr>
                <td>".$count."</td>
                <td>
                  ".ucwords($full_name[$x])."
                </td>
                <td>".strtoupper($position)."</td>
                <td>".$staff_reg_no[$x]."</td>
                <td>".strtoupper($priviledge)."</td>
                <td class='input-group'>
                  <a title='Click Here to Edit details of ".$full_name[$x]."' href='edit_staff_record.php?id=$staff_id[$x]' class='btn btn-success'> 
                      Edit Staff Data
                  </a>
                  <a title='Click Here to View details of ".$full_name[$x]."' href='view_staff_data.php?id=$staff_id[$x]' class='btn btn-warning'> 
                      View Staff Data
                  </a>
                </td>
            </tr>";
            $x++;
    }
  
    echo "  </tbody>
          </table>";
  }else {
    echo "No staff record found in database";
  }
}else{
  echo "We had a technical problem and we're trying to resolve it.<br/>Try running the query again.";
}





?>
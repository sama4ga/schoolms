<?php
session_start();
require_once("connect.php");
include_once("head.php");

include_once("auth.php");
if ($priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

if (isset($_GET['class'])) {

  $_class=$_GET['class'];

  $result=$con->query("SELECT * FROM `student` s
                    JOIN `student_class` sc
                    ON s.`std_id`=sc.`std_id`
                    WHERE sc.`class`='$_class'
                    AND s.`status`='active'
                    ORDER BY sc.`arm` ");

}else {

  $_class = "All";
  
  $result=$con->query("SELECT * FROM `student` s
                      JOIN `student_class` sc
                      ON s.`std_id`=sc.`std_id`
                      WHERE s.`status`='active'
                      ORDER BY sc.`class` ");

}

if ($result) {
  
  if ($result->num_rows > 0) {
  
      
  
    $x = 0;
    $male = 0;
    while ($row=$result->fetch_assoc()) {
  
      $std_id[$x]=$row['std_id'];
      $surname[$x]=$row['surname'];
      $othernames[$x]=$row['othernames'];
      $full_name[$x]=$surname[$x].", ".$othernames[$x];
      $class[$x]=$row['class'];
      $arm[$x]=$row['arm'];
      $std_reg_no[$x]=$row['student_reg_no'];
      $gender[$x]=$row['gender'];
  
      if ($gender[$x] == "Male") {
        $male++;
      }
     
      $x++;
    }

    $female = $x - $male;

    echo "<div style='margin-bottom:25px;'>
          <h2 align='center'>Showing List of Students</h2><p>
          <div style='margin-bottom:30px;'>
            <div>Class: <b style='color:red;'>".strtoupper($_class)."</b></div>
            <div>Total in Class: <b style='color:red;'>".$x."</b></div>
            <div>Male: <b style='color:red;'>".$male."</b></div>
            <div>Female: <b style='color:red;'>".$female."</b></div>
          </div>";

    echo " <table width='100%' cellspacing='0' cellpadding='2' border='0' alig class='data'>			
            <tbody>
              <tr>
                <th>S/N</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Reg. No.</th>
                <th>Class</th>
                <th>Arm</th>
                <th></th>
              </tr>";

    for ($i=0; $i < $x; $i++) { 
      $count = $i + 1;
      echo "<tr>
              <td>".$count."</td>
              <td>
                ".$full_name[$i]."
              </td>
              <td>".$gender[$i]."</td>
              <td>".$std_reg_no[$i]."</td>
              <td>".strtoupper($class[$i])."</td>
              <td>".strtoupper($arm[$i])."</td>
              <td >
                <div class='btn-group'>
                  <a title='Click Here to Edit details of ".$full_name[$i]."' href='edit_student_data.php?id=$std_id[$i]' class='btn btn-success form-control'> 
                      Edit Student Data
                  </a>
                  <a title='Click Here to View details of ".$full_name[$i]."' href='view_student_data.php?id=$std_id[$i]' class='btn btn-warning form-control'> 
                      View Student Data
                  </a>
                </div>
              </td>
          </tr>";
    }
  
    echo "  </tbody>
          </table>
          
          <a href='back.php' class='btn btn-warning form-control'>Back</a>
        </div>";
  }else{
    echo "<div>No student found in the database</div>";
  }
}else{
  echo "<div>An error occured while fetching student list.<br/>
          We are working on the problem. Try running the query again.
        </div>";
}






?>
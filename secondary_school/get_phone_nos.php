 <?php
require_once("connect.php");

$to=$_REQUEST['to'];

if ($to == 'some_staffs') {
  $result=$con->query("SELECT `staff_id`, `phone 1`, `phone 2`,`surname`,`othernames`,`email` FROM `staff` WHERE `staff_id` <> 1");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

        $x=0;
        echo "<div>Select Staffs to send message to here</div>
              <table class='table-bordered' style='width:100%;'>
                <tr>
                <th><input type='checkbox' onchange=\"mark_all('phone_nos[]');\" class='checkbox' title='mark all'></th>
                <th>Phone No. 1</th>
                <th>Phone No. 2</th>
                <th style='min-width:250px;'>Staff Name</th>                    
                <th>Staff Email</th>                    
              </tr>"; 
        while ($row=$result->fetch_assoc()) {

            $contact1[$x] = $row['phone 1'];          
            $contact2[$x] = $row['phone 2'];  
            $client_name[$x] = $row['surname'].", ".$row['othernames'];   
            $client_email[$x] = $row['email'];   
            $staff_id[$x] = $row['staff_id'];   

            echo "<tr>
                  <td><input type='checkbox' name='phone_nos[]' value='$staff_id[$x]' class='checkbox' form='message' /></td>
                  <td>".$contact1[$x]."
                  <td>".$contact2[$x]."
                  <td>".$client_name[$x]."
                  <td>".$client_email[$x]."
                </tr>";
            
            $x++;

        }

        
        echo "</table>";
      }else {
        echo "No staff found";
      }
    
    
    }else{echo "Error encountered while fetching staff record ".$con->error;}
}else{

  $result=$con->query("SELECT `std_id`, `phone 1`, `phone 2`, `parent/guardian`,`email` FROM `student`");
  if ($result) {

    $no_of_parents_contact=$result->num_rows;

    if ($no_of_parents_contact > 0) {

      $x=0;

      echo "<div>Select Parents to send message to here</div>
            <table class='table-bordered' style='width:100%;'>
                <tr>
                <th><input type='checkbox' onchange=\"mark_all('phone_nos[]');\" class='checkbox' title='mark all'></th>
                <th>Phone No. 1</th>
                <th>Phone No. 2</th>
                <th style='min-width:250px;'>Parent name</th>
                <th>Parent email</th>                    
              </tr>"; 
      while ($row=$result->fetch_assoc()) {

          $contact1[$x] = $row['phone 1'];          
          $contact2[$x] = $row['phone 2'];
          $client_name[$x] = $row['parent/guardian'];  
          $client_email[$x] = $row['email'];
          $std_id[$x] = $row['std_id'];
          
          echo "<tr>
                  <td><input type='checkbox' name='phone_nos[]' value='$std_id[$x]' class='checkbox' form='message' /></td>
                  <td>".$contact1[$x]."
                  <td>".$contact2[$x]."
                  <td>".$client_name[$x]."
                  <td>".$client_email[$x]."
                </tr>";
          
          $x++;

      }

      echo "</table>";
    }else {
      echo "No student found";
    }
  }else{echo "Error encountered while fetching student record ".$con->error;}

}

  


?>

<script>

count = 0;
function mark_all(div){
  count++;
  var box = document.getElementsByName(div);
  if (count%2 == 0) {
    box.forEach(val => {
      val.checked = true;
    });
  }else{
    box.forEach(val => {
      val.checked = false;
    });
  }
  
}


</script>
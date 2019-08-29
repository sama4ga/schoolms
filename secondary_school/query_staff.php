<?php
require_once("connect.php");
include_once("head.php");

$msg=array();


if (isset($_POST['query'])) {
  
  $to=$_POST['to'];
  $type=$_POST['type'];
  $body=$_POST['message'];
  $subject=$_POST['subject'];




    $result=$con->query("SELECT `phone 1`, `phone 2`,`surname`,`othernames`,`email` FROM `staff`");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

        while ($row=$result->fetch_assoc()) {

            $contact1 = $row['phone 1'];          
            $contact2 = $row['phone 2'];  
            $client_name = $row['surname'].", ".$row['othernames'];   
            $client_email = $row['email'];   
            
            $x++;

        }
      }
    


  }


  switch ($type) {

    case 'text_message':

      include_once("send_text_message.php");

        if(send_text_message($value,$body,$subject,$client_name) != 'true'){
          $msg[]="Could not send text message to ".$client_name;
        }

      break;

    case 'email':
      
      include_once("send_email.php");


        if(send_email($client_email,$body,$subject,$client_name) != 'true'){
          $msg[]="Could not send email to ".$client_name;
        }

      break;

    default:    
      $msg[]="Choose type of query message to send";
      break;
  }


  $msg[]= "Mesage successfully sent";


}


if (isset($_POST['submit'])) {
  
  $full_name=$_POST['submit'];
  $staff_id=$_POST['staff_id'];
  
  echo "

  <h2 align='center'>Staff Query Portal</h2>
  
  <div class='container'>
    <form action='message_portal.php' method='POST' class='form-control'>
      <ul style='color:red;'>";  
          for ($i=0; $i < count($msg); $i++) { 
            echo "<li style='list-style:none;'>'.$msg[$i].'</li>";
          }
  echo "    </ul>
  
      <div>To
        <div>
          <input type='text' name='staff_name' value='$full_name' class='form-control' />
        </div>
      </div>
  
      <div>Type
        <div>
          <select name='type' class='form-control'>
            <option value='default' selected>Choose One</option>
            <option value='text_message'>Text Message</option>
            <option value='email'>Email</option>
          </select>
        </div>
      </div>
  
      <div>Subject
        <div>
          <input type='text' name='subject' class='form-control'>
        </div>
      </div>
  
      <div>Message
        <div>
          <textarea name='message' class='form-control' cols='20' rows='10'></textarea>
        </div>
      </div>
  
      <div style='display:flex;'>
        <div><input type='submit' name='query' value='Query' class=' btn btn-success form-control'></div>
        <div><input type='submit' name='back' value='Back' class=' btn btn-warning form-control' formaction='back.php'></div>
      </div>
    </form>
  </div>
  ";

  
exit();

}

?>

<div class='container'>
  <h2 align='center'>Staff Query Portal</h2>

  <ul style='color:red;'>
      <?php 
        for ($i=0; $i < count($msg) ; $i++) { 
          echo "<li style='list-style:none;'>".$msg[$i]."</li>";
        }  
      ?>
    </ul>

  <p><!-- <form method='POST' action=''> -->
    <div class='form-control'>Search database for Staff
      <div class='btn-group' style='width:100%;'>
        <input type='search' name='search' id='search' class='form-control' style='width:90%;' oninput="javascript:
        var data=document.getElementById('search'); get_data('search_for_staff.php?name='+data.value,'display_result');">
        <!-- <input type='submit' name='btn_search' id='btn_search' class='btn btn-primary form-control' style='width:100px;' value='Search'> -->
      </div>
    </div></p>
		<div id='display_result'></div>
		
		<div>
		<a href='back.php' class='btn btn-warning form-control'>Back</a>
		</div>

</div>



<?php

include_once("footer.php");

?>
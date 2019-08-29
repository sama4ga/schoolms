<?php
include_once("header.php");
require_once("connect.php");
include_once("sanitize.php");

$msg=array();


if (isset($_POST['submit'])) {
  
  $to=sanitize($_POST['to']);
  $type=sanitize($_POST['type']);
  $body=sanitize($_POST['message']);
  $subject=sanitize($_POST['subject']);


  if (isset($_POST['additional_nos'])) {

    $additional_nos=$_POST['additional_nos'];

    $additional_contact=explode("\r\n",$additional_nos);

    
  }


  if (isset($_POST['additional_emails'])) {

    $additional_email=$_POST['additional_emails'];

    $additional_emails=explode("\r\n",$additional_email);

    
  }

  //var_dump($additional_contact);exit();



  if ($to == "all") {

    $result=$con->query("SELECT `phone 1`, `phone 2`,`parent/guardian`,`email` FROM `student`");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

        $x=0;
        while ($row=$result->fetch_assoc()) {

            $contact1[$x] = $row['phone 1'];          
            $contact2[$x] = $row['phone 2'];
            $client_name[$x] = $row['parent/guardian']; 
            $client_email[$x] = $row['email'];  
            
            $x++;

        }
      }
    }


    $result=$con->query("SELECT `phone 1`, `phone 2`,`surname`,`othernames`,`email` FROM `staff` WHERE `staff_id` <> 1");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

       // $x=0;
        while ($row=$result->fetch_assoc()) {

            $contact1[$x] = $row['phone 1'];          
            $contact2[$x] = $row['phone 2'];   
            $client_name[$x] = $row['surname'].", ".$row['othernames'];  
            $client_email[$x] = $row['email'];    

            $x++;

        }
      }
    } 
    

  }elseif($to == "staffs"){

    $result=$con->query("SELECT `phone 1`, `phone 2`,`surname`,`othernames`,`email` FROM `staff`  WHERE `staff_id` <> 1");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

        $x=0;
        while ($row=$result->fetch_assoc()) {

            $contact1[$x] = $row['phone 1'];          
            $contact2[$x] = $row['phone 2'];  
            $client_name[$x] = $row['surname'].", ".$row['othernames'];   
            $client_email[$x] = $row['email'];   
            
            $x++;

        }
      }
    
    
    }


  }elseif($to == "parents"){

    $result=$con->query("SELECT `phone 1`, `phone 2`, `parent/guardian`,`email` FROM `student`");
    if ($result) {

      $no_of_parents_contact=$result->num_rows;

      if ($no_of_parents_contact > 0) {

        $x=0;
        while ($row=$result->fetch_assoc()) {

            $contact1[$x] = $row['phone 1'];          
            $contact2[$x] = $row['phone 2'];
            $client_name[$x] = $row['parent/guardian'];  
            $client_email[$x] = $row['email'];     
            
            $x++;

        }
      }
    }

  }elseif($to == "some_staffs"){

    $id=$_POST['phone_nos'];

    for ($i=0; $i < count($id); $i++) { 

      $result=$con->query("SELECT `phone 1`, `phone 2`, `surname`,`othernames`,`email` FROM `staff` WHERE `staff_id`='$id[$i]'");
      if ($result) {

        $no_of_parents_contact=$result->num_rows;

        if ($no_of_parents_contact > 0) {

          
          while ($row=$result->fetch_assoc()) {

              $contact1[$i] = $row['phone 1'];          
              $contact2[$i] = $row['phone 2'];
              $client_name[$x] = $row['surname'].", ".$row['othernames'];  
              $client_email[$i] = $row['email']; 

          }
        }
      }
    }


    

  }elseif($to == "some_parents"){

    $id=$_POST['phone_nos'];

    for ($i=0; $i < count($id); $i++) { 

      $result=$con->query("SELECT `phone 1`, `phone 2`, `parent/guardian`,`email` FROM `student` WHERE `std_id`='$id[$i]'");
      if ($result) {

        $no_of_parents_contact=$result->num_rows;

        if ($no_of_parents_contact > 0) {

          while ($row=$result->fetch_assoc()) {

              $contact1[$i] = $row['phone 1'];          
              $contact2[$i] = $row['phone 2'];
              $client_name[$i] = $row['parent/guardian'];  
              $client_email[$i] = $row['email']; 

          }
        }
      }
    }

  }else {
    $msg[]="Choose whom to send message to";
  }


  if (isset($additional_contact)) {
    $contact1=array_merge($contact1,$additional_contact);
  }

  if (isset($additional_emails)) {
    $client_email=array_merge($client_email,$additional_emails);
  }

//var_dump($contact1);exit();

  /* switch ($type) {

    case 'text_message':

      include_once("send_text_message.php");

      foreach ($contact1 as $key => $value) {

        if (!isset($client_name[$key])) {
          $client_name[$key]="";
        }

        if(send_text_message($value,$body,$subject,$client_name[$key]) != 'true'){
          $msg[]="Could not send text message to ".$client_name[$key];
        }

      }

      break;

    case 'email':
      
      include_once("send_email.php");

      for($i=0; $i < count($client_email); $i++) {

        if (!isset($client_name[$i])) {
          $client_name[$i]="";
        }

        if(send_email($client_email[$i],$body,$subject,$client_name[$i]) != 'true'){
          $msg[]="Could not send email to ".$client_name[$i];
        }
        
      }

      break;

    default:    
      $msg[]="Choose type of message to send";
      break;
  } */


  if (empty($msg)) {
    $con->query("CREATE TABLE IF NOT EXISTS `sent_messages`(
                  `msg_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                  `type` varchar(20),
                  `subject` varchar(100),
                  `to` varchar(100),
                  `data` text,
                  `body` text,
                  `date` datetime DEFAULT CURRENT_TIMESTAMP,
                  `status` varchar(20)
                )");


    if ($type == "text_message") {      
      $data = "";
      foreach ($contact1 as $key => $value) {
        $data .= $value.",";
      }
    }else{
      $data = "";
      foreach ($client_email as $key => $value) {
        $data .= $value.",";
      }
    }
//var_dump($data);exit();
    $result = $con->query("INSERT INTO `sent_messages`(
                           `type`,`subject`,`to`,`data`,`body`,`status` 
                          ) VALUES(
                            '$type','$subject','$to','$data','$body','sent'
                          );");
    
    $msg[]= "Mesages successfully sent";
  }else {
    echo "Could not sent text messages";
  }
  

}




?>

<div class="container">

  <h1 align='center'><b>Message/Email Portal</b></h1>

  <div style="display:flex;">

    <div style="width:50%;">
      <form action="message_portal.php" method="POST" id="message">
        <ul style='color:red;'>
          <?php   
            for ($i=0; $i < count($msg); $i++) { 
              echo "<li style='list-style:none;'>".$msg[$i]."</li>";
            }
          ?>
        </ul>

        <div class="form-group">
          <label>To</label>
            <select name="to" class="form-control" onchange="get_list(this.value);">
              <option value="" selected>Choose One</option>
              <option value="all">Parents and Staffs</option>
              <option value="parents">Parents</option>
              <option value="staffs">Staffs</option>
              <option value="some_staffs">Some Staffs</option>
              <option value="some_parents">Some Parents</option>
            </select>
        </div>

        <div class="form-group">
          <label>Type</label>
            <select name="type" class="form-control">
              <option value="" selected>Choose One</option>
              <option value="text_message">Text Message</option>
              <option value="email">Email</option>
            </select>
        </div>

        <div class="form-group">
          <label>Subject</label>
            <input type='text' name="subject" class="form-control">
        </div>

        <div class="form-group">
          <label>Message</label>
            <textarea name="message" class="form-control" cols='20' rows='10'></textarea>
        </div>

        <div class="form-group">
          <label>Add Numbers not in selected list (one per line)</label>
            <textarea name="additional_nos" class="form-control" cols='20' rows='10'></textarea>
        </div>

        <div class="form-group">
          <label>Add Emails not in selected list (one per line)</label>
            <textarea name="additional_emails" class="form-control" cols='20' rows='10'></textarea>
        </div>

        <div class="input-group" style='display:flex;padding-top:10px;'>
          <input type="submit" name="submit" value="Send" class="btn btn-success form-control">
          <input type="submit" name="back" value="Back" class="btn btn-warning form-control" formaction="admin_portal.php">
        </div>
      </form>
    </div>

    <div id="display" style='width:50%;'></div>

  </div>

</div>



<script>

  
function get_list(value){
  //alert(value);
  if (value == 'some_staffs') {
    //window.location='get_phone_nos_staffs.php?to='+value;<option value='$std_id[$x]'>
    get_data("get_phone_nos.php?to="+value,"display");
  }else if (value == 'some_parents') {
    //window.location='get_phone_nos_parents.php?to='+value;
    get_data("get_phone_nos.php?to="+value,"display");
  }
}





</script>


<?php

include_once("footer.php");

?>
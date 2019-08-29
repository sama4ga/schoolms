<?php
require_once("connect.php");

$result = $con->query("SELECT count(`std_id`) AS 'num_of_std' FROM `student`");
if ($result) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $num_of_students = $row['num_of_std'];
    }
  }
}



if (isset($num_of_students)) {
  $result = $con->query("UPDATE `school_info` SET `no_of_students`='$num_of_students'");
  if (!$result) {
    echo "Could not update number of students ".$con->error;
  }
}



// attempt annonimous hidden connection to the online portal
$url = "localhost/schoolms/samaservices/update_school_info.php";  
// initialize the curl var
  $ch = curl_init();
	
  // get the response form curl
  $state = curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

  // set the url
  $url_state = curl_setopt($ch, CURLOPT_URL,$url);

  // create a post array with the file init
  $postData = array(
    'data' => $num_of_students,
  );
  $post_state = curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

  // execute the request
  $response = curl_exec($ch);
  //print($response);
  if ($response == "done") {						
    echo "Number of students has been successfully updated<br/>";
  }else {
    echo "There was an error updating number of students in online record ".$response."<br/>";
  }
?>
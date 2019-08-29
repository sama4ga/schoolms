<?php
  require_once("secondary_school/connect.php");
  include_once("secondary_school/head.php");

  $cleared = "false";

  $result = $con->query("SELECT * FROM `school_info`");
  if ($result) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $license_start = $row['license_start'];
        $license_end = $row['license_end'];
      }

      $today = date("Y-m-d",time());
      $today_time = time();
      $expiry_time = strtotime($license_end);
      $time_left = $expiry_time - $today_time;
      //$time_left = date("d",$time_left);
      $time_left_days = floor($time_left/(60*60*24))+1;

      // if ($today_time > $expiry_time) {
      if ($time_left < 0) {
        echo "<div class='container'>
                <div>
                  Sorry!!! Your license for the software has expired.
                  <p>
                    You will need to update the software to continue using it.
                    <br/>Click on the button below to update.
                  </p>
                </div>

                <div>
                  <a href='secondary_school/update_license.php' class='btn-success'>Update License</a>
                </div>
              </div>";
        $cleared = 'false';
      }elseif ($time_left_days < 14 ){
        echo "<div style='font-weight:bolder;color:red;'>Your software will expire in ".$time_left_days." days</div>";
        sleep(20);
        $cleared = 'true';
      }else {
        $cleared = 'true';
      }

/* echo $time_left_days;
exit(); */


    }else {
      echo "<div>No license record found</div>";
    }


  }else {
    echo "Error fetching license details ".$con->error;
  }



?>
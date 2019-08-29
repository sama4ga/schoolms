<?php
require "encrypt_decrypt.php";
  require_once("connect.php");
  include_once("head.php");
  include_once("sanitize.php");
  


  /* $cleared = "false";
  $result = $con->query("SELECT * FROM `school_info`");
  if ($result) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $license_start = $row['license_start'];
        $license_end = $row['license_end'];
      }

      
    }
  } */


  // decrypt licence key
  

  /* $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
  $message = "2019/09/06";
  $ciphertext = safeEncrypt($message,$key);
  $plaintext = safeDecrypt($ciphertext,$key);

  var_dump($ciphertext);
  var_dump($plaintext); */



 /* $message = "2019/09/06";
 var_dump(fnDecrypt("2ae75961098fe2fbf207025ebb75dc87:cd564ca932e66eb672a50229bb293c40:bc952a03efeef3b11aee7d6256930769bba9d1f7cc4bd5ce26aa011f4afe6b21"));
 */

 /* include_once("hashing_algorithm.php");
 $hash = hash_password("okon");
 echo $hash."<br/>";
 echo verify_hash("okon",$hash); */
 

  if (isset($_POST['submit'])) {

    $license_key = sanitize($_POST['license_key']);
    $lic_key = fnDecrypt($license_key);
    
    $result = $con->query("UPDATE `school_info` SET `license_end`='$lic_key',`license_start`='$license_end' WHERE `id`=1");
    
    if ($result) {
      echo "<div>License successfully updated.</div>";
      exit();
    }else {
      //throw new Exception("Error Processing Request ".$con->error, 1);
      echo "Could not update licence ".$con->error;
    }
  }

  
  /* $today = date("Y-m-d",time());
  $today_time = time();
  $expiry_time = strtotime($license_end);
  
  if ($today_time < $expiry_time) {
    echo "<div>
            Your license has not expired yet. <br/>
            You can continue using the software until your license expires.
            <p>
              If however, you still want to update the license, fill the form below.
            </p>
          </div>";
  } */


?>

<div class="container">
  <h2>License Update Page</h2>
  <div style="margin:40px 0 20px 0;">
    Enter the licence key obtained from the administrator
  </div>
  <div>
    <form method="POST" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"> <!--  -->
      <div class="form-control">
        <div class="form-group">
          <label>License Key</label>
          <input type="text" name="license_key" class="form-control" placeholder="copy and paste licence key here" required />
        </div>

        <div class="input-group">
          <input type="submit" name="submit" value="Update" class="btn-success" />
          <a href="javascript:history.back();" class="btn btn-warning" width="50px" height="50px">Back</a>
        </div>
      </div>
    </form>

    <div style="margin:20px 0;" class="text-muted">
      Don't have a license key? Contact software administrator at <a href="/samaservices/samaservices/contact.php">samaservices</a> for license key.
    </div>
  </div>
</div>



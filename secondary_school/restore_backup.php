<?php
require_once("connect.php");


echo "<div id='display'></div>";
?>
<script type="text/javascript">
ans = confirm("Do you really want to restore the database?"+
               "\r\n\r\nThis will overwrite existing record and rewind database to last record."+
               "\r\n\r\nThe consequence is that recent data after the last backup will be permanently lost and unrecoverable."+
               "\r\n\r\nClick Ok to proceed.");
if (ans) {

  <?php
  $dir = __DIR__."/backup/";
  
  if (file_exists($dir)) {
    
    $files = scandir($dir);
    $dir = end($files);
    //echo $dir;exit();
    if (is_file($dir)) {
      
      // create database
      $result = $con->query("CREATE DATABASE IF NOT EXISTS `managementsystem`");
    
    
      $res=system("mysql -u root managementsystem < $dir");
  
      if ($res) {
        $msg = "Database successfully restored";
      }else{
        $msg = "Error restoring database ";
      }
  
  
    }else {
      $msg = "No backup file found";
    }

  }else {
    mkdir("backup");
    $msg = "No backup file found";
  }



  ?>

  document.getElementById("display").innerHTML="<?php echo $msg; ?>";
}
</script>




<?php
/* call to file and dir and changing system temp dir
echo __DIR__."<br/>";    returns only directory
echo __FILE__."<br/>";   returns complete path to file
echo sys_get_temp_dir(); returns system temp dir
putenv("TMP=$temp");
putenv("TEMP=$temp");
putenv("TMPDIR=$temp"); */


?>
<?php
	session_start();
	include_once("head.php");
	require_once("connect.php");

	if (isset($_POST['btnProceed'])) {

		$msg = array();

		$host='localhost';
		$dbname='managementsystem';
		$uname='root';
		$upas='';
		
		
		echo "Result upload in progress.<br/>Please wait....<br/>";
		
		/* $upas= exo_get_protstring("str2");
	$uname= exo_get_protstring("str1");
	$dbname= exo_get_protstring("str0");
 */

function send_file($dir,$url,$filename){

	// initialize the curl var
	$ch = curl_init();

	// get the response form curl
	$state = curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

	// set the url
	$url_state = curl_setopt($ch, CURLOPT_URL,$url);

	// create a post array with the file init
	$postData = array(
		$filename => $dir,
	);
	$post_state = curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

	// execute the request
	$response = curl_exec($ch);
	return $response;


}





	if (isset($_REQUEST['session'])) {
		$session = $_REQUEST['session'];
	}else{
		$session = $_SESSION['session'];		
	}
	$session_formatted = str_replace("/","_",$session);
	
	if (isset($_REQUEST['term'])) {
		$term = $_REQUEST['term'];
	}else{
		$term = $_SESSION['term'];		
	}

	session_write_close();
	

		// scan for old backup files
		if (!file_exists("backup")) {
			mkdir("backup");
		}
		if (!file_exists("dump/result")) {
			mkdir("dump/result");
		}

		$old_backup_files = scandir(__DIR__."/backup/");
		$old_dump_files = scandir(__DIR__."/dump/result/");
		


	
	//$class_data = ["jss 1","jss 2","jss 3","ss 1","ss 2","ss 3"];
	//$arm = ["a","b","c"];
	
	//for ($i=0; $i < count($class); $i++) {

		
		$prefix = "res_id_".$session_formatted."_".$term."_";
		$result = $con->query("SHOW TABLES FROM `$dbname` LIKE '$prefix%'");
		if ($result) {
			$x = 0;
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_row()) {
					//echo "<pre> Table : {$row[0]}\n</pre>";
					//$title=str_replace(" ","_",$row[0]);
					$file[$x] = $row[0];

					$x++;
				}

			}else {
				echo "<div>Results do not exist.<br/></div> ";
				exit();
			}
		}else {
			echo "<div>Results have not been prepared for $term term $session academic session ".$con->error."</div>";
			exit();
		}

		
		// add other tables to be uploaded
		$others = ["arm","jss 1","jss 2","jss 3","ss 1","ss 2"," ss 3","baa_orig","psychomotor","session_info","existing_result_sheets","student","student_class","staff","staff_class"];
		$file = array_merge($file,$others);

		$dir = __DIR__."/dump/result/result".date("ymdhis").".sql";

		$file_to_upload = "";
		for ($i=0; $i < count($file); $i++) {

			$file_to_upload .= "\"".$file[$i]."\" ";
			
		}

		//echo $file_to_upload;
//exit();

		// send result
		$url = "localhost/samaservices/samaservices_new/secondary/ijins/upload_result.php";
		$res=system("mysqldump -u root $dbname $file_to_upload > \"$dir\"");
		//echo("mysqldump -u root $dbname $file_to_upload > \"$dir\"");
//exit();
		$status = send_file($dir,$url,"result");
		
	if ($status == "done") {						
		echo "Results have been successfully uploaded<br/>";
	}else {
		echo $status."<br/>";
	}


//exit();

		// send passports
		$dir = __DIR__."/data/passport";
		//echo $dir;exit();
		$file = scandir($dir);
		foreach ($file as $key => $value) {
			if ($key > 1) {				
				$status = send_file($dir."/".$value,$url,"passport");
				if ($status !== "done"){
					echo $status."<br/>";
				}else {
					echo "Passport $value has been successfully uploaded<br/>";
				}
			}
		}


	
		// backup the database
		$dir = __DIR__."/backup/backup".date("ymdhis",time()).".sql";
		$res=system("mysqldump -u $uname $dbname > $dir ");
		

		// delete old backup files
		if ($res == "") {
			
			for ($i=2; $i < count($old_backup_files); $i++) {				
				unlink("backup/".$old_backup_files[$i]);  
			}
			for ($i=2; $i < count($old_dump_files); $i++) {				
				unlink("dump/result/".$old_dump_files[$i]);  
			}


		}	
		
		



	

		

	}else{

		echo "<div class='container'>
					<div>
						<img src='../images/online.jpg' alt='internet connection required' />
					</div>
					<div>
						Uploading results require access to the internet.<br/>
						Ensure you're connected to the internet before continuing with this execution.
					</div>
					<div>
						<form method='post' action='upload_result.php'>
							<input type='submit' class='btn-success' value='Click here to Proceed' name='btnProceed' formaction='upload_result.php'>
						</form>
					</div>
				</div>";
	}
	


?>
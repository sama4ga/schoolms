<?php
	session_start();
	include_once("head.php");
	require_once("connect.php");

	if (isset($_POST['btnProceed'])) {


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
			//print($response);
			return $response;

			

		}





		$msg = array();

		$host='localhost';
		$dbname='managementsystem';
		$uname='root';
		$upas='';
		
		
		echo "<div>Attendance upload in progress.<br/>Please wait....</div>";
		
		/* $upas= exo_get_protstring("str2");
	$uname= exo_get_protstring("str1");
	$dbname= exo_get_protstring("str0");
 */

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
		if (!file_exists("dump/attendance")) {
			mkdir("dump/attendance");
		}
		$old_dump_files = scandir(__DIR__."/dump/attendance/");
		

		
		$prefix = "atd_student_".$session_formatted."_".$term."_";
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
				echo "No attendance sheet found for $term term $session academic session .<br/> ";
				exit();
			}
		}else {
			echo "Attendance have not been prepared for $term term $session academic session ".$con->error;
			exit();
		}

		
		// add other tables to be uploaded
		//$others = ["baa_orig","psychomotor","existing_result_sheets","student","student_class","staff","staff_class"];
		$others = ["session_info","student","student_class"];
		$file = array_merge($file,$others);

		//$dir = __DIR__."/dump/attendance/atd.sql";
		
		//$file_to_upload = "";
		$url = "localhost/samaservices/samaservices_new/secondary/ijins/upload_attendance.php";
		
		$file_to_upload = "";
		for ($i=0; $i < count($file); $i++) {

			$file_to_upload .= "\"".$file[$i]."\" ";
			
		}

		$dir = __DIR__."/dump/attendance/attendance".date("ymdhis").".sql";
		$res=system("mysqldump -u root $dbname $file_to_upload > \"$dir\"");
		//$file_to_upload .= "'".$file[$i]."'"." ";
		$status = send_file($dir,$url,"attendance");
		if ($status == "done") {						
			echo "Attendance has been successfully uploaded<br/>";
		}else {
			echo $status."<br/>";
		}



		/* for ($i=0; $i < count($file); $i++) {
			// send result
			$dir = __DIR__."/dump/attendance/$file[$i].sql";
			$res=system("mysqldump -u root $dbname \"$file[$i]\" > \"$dir\"");
			//$file_to_upload .= "'".$file[$i]."'"." ";
			echo send_file($dir,$url,"attendance");
		} */
//echo $file_to_upload;exit();

		
		
	
		//$res=system("mysqldump -u root $dbname $file_to_upload > \"$dir\"");
		


		// delete old backup files
		if ($res == "") {
			
			for ($i=2; $i < count($old_dump_files); $i++) {				
				unlink("dump/attendance/".$old_dump_files[$i]);  
			}


		}	
		
		



	

		

	}else{

		echo "<div class='container'>
					<div>
						<img src='../images/online.jpg' alt='internet connection required' />
					</div>
					<div>
						Uploading attendance require access to the internet.<br/>
						Ensure you're connected to the internet before continuing with this execution.
					</div>
					<div>
						<form method='post'>
							<input type='submit' class='btn-success' value='Click here to Proceed' name='btnProceed' formaction='upload_attendance.php'>
						</form>
					</div>
				</div>";
	}
	


?>
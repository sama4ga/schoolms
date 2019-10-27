<?php
	session_start();
	require_once("connect.php");

	if (isset($_POST['btnProceed'])) {

		
		$host='localhost';
		$dbname='managementsystem';
		$uname='root';
		$upas='';
		
		
		echo "Result upload in progress.<br/>Please wait....";
		
		$url = "localhost/samaservices/samaservices_new/secondary/ijins/upload_result.php";
		$dir = __DIR__."/data/";
		send_file($dir,$url);


		// scan for old backup files
		$file = scandir(__DIR__."/backup");
//var_dump($file);

		// backup the database
		$dir = __DIR__."/backup/backup".date("ymdhis",time()).".sql";
		$res=system("mysqldump -u $uname -p $upas $dbname > $dir ");
		

		// delete old backup files
		if ($res) {
			if (array_key_exists(2,$file) && is_file($file[2])) {
				unlink($file);  
			}
			
		send_file($dir,$url);
			//echo $res;
		}	
		
		

		function curl_handle($url){
			// initialize the curl var
			$ch = curl_init();
	
			// get the response form curl
			$state = curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	
			// set the url
			$url_state = curl_setopt($ch, CURLOPT_URL,$url);
	
		}



		function send_file($dir,$url){

			// initialize the curl var
			$ch = curl_init();
	
			// get the response form curl
			$state = curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	
			// set the url
			$url_state = curl_setopt($ch, CURLOPT_URL,$url);
	
			// create a post array with the file init
			$postData = array(
				'data' => $dir,
			);
			$post_state = curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	
			// execute the request
			$response = curl_exec($ch);
			var_dump($response);

			/* if ($response == "done") {						
				echo "Result has been successfully uploaded<br/>";
			}else {
				echo "There was an error uploading result ".$response."<br/>";
			} */

		}

		

	}else{

		echo "<div>
					<div>
						<img src='../images/online.jpg' alt='internet connection required' />
					</div>
					<div>
						Uploading results require access to the internet.<br/>
						Ensure you're connected to the internet before continuing with this execution.
					</div>
					<div>
						<input type='submit' class='btn-success' value='Click here to Proceed' name='btnProceed' formaction='upload_result.php'>
					</div>
				</div>";
	}
	


	/* $upas= exo_get_protstring("str2");
	$uname= exo_get_protstring("str1");
	$dbname= exo_get_protstring("str0");
 */

	/* if (isset($_REQUEST['session'])) {
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

	
	$class_data = ["jss 1","jss 2","jss 3","ss 1","ss 2","ss 3"];
	//$arm = ["a","b","c"];
	
	//for ($i=0; $i < count($class); $i++) {

		
		$prefix = "res_id_".$session_formatted."_".$term."_";
		$result = $con->query("SHOW TABLES FROM `managementsystem` LIKE '$prefix%'");
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
				echo "Results do not exist.<br/> ";
			}
		}else {
			echo "Results have not been prepared for $term term $session academic session ".$con->error;
		}

		// add other tables to be uploaded
		$others = ["baa_orig","psychomotor","existing_result_sheets","student","student_class","staff","staff_class"];
		$file = array_merge($file,$class_data,$others);

		for ($i=0; $i < count($file); $i++) {

			$dir = "c:/xampp/htdocs/schoolms/secondary_school/dump/$file[$i].sql";

					$res=system("mysqldump -u root managementsystem \"$file[$i]\" > \"$dir\"");
					$data = explode("_",$file[$i]);
					if (is_array($data) && count($data) > 3) {						
						$class = strtoupper($data[5]);
					}else {
						$class = strtoupper($file[$i]);
					}

					$url = "localhost/schoolms/samaservices/secondary/backup_result.php";

					// initialize the curl var
					$ch = curl_init();

					// get the response form curl
					$state = curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

					// set the url
					$url_state = curl_setopt($ch, CURLOPT_URL,$url);

					// create a post array with the file init
					$postData = array(
						'testData' => $dir,
					);
					$post_state = curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

					// execute the request					
					$response = curl_exec($ch);


					//print($response);
					if ($response == "done") {						
						echo "$class result has been successfully uploaded<br/>";
					}else {
						echo "There was an error uploading $class result ".$response."<br/>";
					}
		}
 */
		
		
	//}

	// to dump a set of one or more tables
//shell>mysqldump [options] db_name [tbl_name ...]
// to dump a set of one or more complete databases
//shell> mysqldump [options] --databases db_name ...
// to dump an entire server
//shell> mysqldump [options] --all-databases
// options =  -u username -p password
// eg mysqldump -u root managementsystem t1 t2 t3 > mydb.sql
// eg mysqldump -u root managementsystem --ignore-table=t1 > mydb.sql
// to import a database
// mysql -u username -p -D db_name < table_name.sql        remember to prepend the table name with the absolute path to the file


	//$res=system("notepad.exe");
	

	//system("backup(copy).bat");	
	//exec("backup(copy).bat");

//echo $res;

?>
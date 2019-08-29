<?php
session_start();
ini_set("max_execution_time","300");
include_once("head.php");

	//$sid=$_GET['sid'];
	$class = strtolower($_GET['class']);
	$arm = strtolower($_GET['arm']);
	if (isset($_GET['session'])) {
		$session=$_GET['session'];
	}else{
		$session=strtolower($_SESSION['session']);
	}
	
	if (isset($_GET['term'])) {
		$term=strtolower($_GET['term']);
	}else{
		$term=strtolower($_SESSION['term']);
	}

	$session_format= str_replace("/", "_", $session);
	//$arm_alt = strtolower(str_replace(" ", "_", $_POST['arm_alt']));
	
	$x=0;
	
	require_once("connect.php");
 

/* if(strlen($arm_alt)>=1){ $arm=$arm_alt;}
if($arm == '-----'){$arm='';} */
	$res_id = "res_id_".strtolower($session_format)."_".strtolower($term)."_".$class."_".$arm;

	if ($con->query("DESCRIBE `$res_id`")) {

		echo "Result sheet already created.<br/>
					<a href='javascript:history.back();' class='btn btn-warning'>Back</a>";
					exit();
	}

	/* if(strlen($arm_alt) >= 1)
		{	
			$con->query("INSERT INTO `arms` (arm) VALUES ('$arm_alt')");
    }
    $con->query("ALTER TABLE `existing_result_sheets` ADD `arm` VARCHAR( 10 ) NOT NULL ");
 
 */
	
	$con->real_query( "CREATE TABLE IF NOT EXISTS `$res_id`(
							`std_id` INT(10) NOT NULL ,
							`surname` varchar(250) NOT NULL,
							`othernames` varchar(400) NOT NULL
							
							) ENGINE = MyISAM;");
 
 
 
	$get_subs = $con->query("SELECT * FROM `$class` ");
	
	if($get_subs)
		{
			$no_of_subs = $get_subs->num_rows;
			while($row = $get_subs->fetch_array())
				{
				
					$x++;
					$subjects[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['subjects']));
					$subject_type[$x]=$row['type'];
					$subjects_ca_1[$x] = $subjects[$x]."_ca_1";
					$subjects_ca_2[$x] = $subjects[$x]."_ca_2";
					$subjects_ca_3[$x] = $subjects[$x]."_ca_3";
					$subjects_ca_4[$x] = $subjects[$x]."_ca_4";
					$subjects_total[$x] = $subjects[$x]."_total";
					$subjects_average[$x] = $subjects[$x]."_average";
					$subjects_exam[$x] = $subjects[$x]."_exam";
					$subjects_position[$x] = $subjects[$x]."_position";
					// $subjects_average[$x] = $subjects[$x]."_average";
					
				}
				
				
				
		for($x=1; $x<=$no_of_subs; $x++)
			{
				
				/* $con->query("UPDATE $class
						SET  max_score = '100' 
													
							WHERE sid ='$x'");				
				 */

				$con->multi_query("ALTER TABLE `$res_id` ADD `$subjects[$x]` VARCHAR(50) NOT NULL,
										ADD `$subjects_ca_1[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_ca_2[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_ca_3[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_ca_4[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_exam[$x]` INT(3) NOT NULL DEFAULT 0,
										ADD `$subjects_total[$x]` INT(4) NOT NULL DEFAULT 0,
										ADD `$subjects_average[$x]` DOUBLE NOT NULL DEFAULT 0,
										ADD `$subjects_position[$x]` VARCHAR(4) NOT NULL");
      }
		}


		
		
		$x=0;
		$z=0;
		
		
		
		
		
		
	$get_psy = $con->query("SELECT * FROM `psychomotor` ");
	
	if($get_psy)
		{
			$no_of_psy = $get_psy->num_rows;
			while($row = $get_psy->fetch_array())
				{
					$z++;
					$behaviour_orig_psy[$z] =  $row['behaviour'];
					$behaviour_psy[$z] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
				}
		
		}



	$affective='baa_orig';		
		
			$get_baa = $con->query("SELECT * FROM $affective ");
	
	if($get_baa)
		{
			$no_of_baa = $get_baa->num_rows;
			while($row = $get_baa->fetch_array())
				{
					$x++;
					$behaviour[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
				}
				
				
		for($x=1; $x<=$no_of_baa; $x++)
			{
				
				$con->query("ALTER TABLE `$res_id` ADD `$behaviour[$x]` VARCHAR(3) NOT NULL");
				
			}		
		
		for($z=1; $z<=$no_of_psy; $z++)
			{
				
				$con->real_query("ALTER TABLE `$res_id` ADD `$behaviour_psy[$z]` VARCHAR(4) NOT NULL");
				
			}		
			
				
		
		}
		
		$con->multi_query("ALTER TABLE `$res_id` ADD `total_score` DOUBLE NOT NULL DEFAULT 0, 
											ADD `position` VARCHAR(5) NOT NULL, 
											ADD `average` DOUBLE NOT NULL,
											ADD `class_average` DOUBLE NOT NULL,
											ADD `age` VARCHAR(4) NOT NULL,
											ADD `uid` INT NOT NULL AUTO_INCREMENT,
											ADD PRIMARY KEY (`uid`),
											ADD `phone_no` VARCHAR(26) NOT NULL,
											ADD `reg_no` VARCHAR(26) NOT NULL,
											ADD `passport` VARCHAR(200) NOT NULL,
											ADD `atd` INT(2) NOT NULL,
											ADD `status` varchar(10) NOT NULL,
											ADD UNIQUE (`std_id`)");


		$con->query("CREATE TABLE IF NOT EXISTS `existing_result_sheets` (
									`result_id` varchar(100) UNIQUE NOT NULL,
									`class` varchar(5) NOT NULL,
									`term` varchar(10) NOT NULL,
									`session` varchar(10) NOT NULL,
									`arm` varchar(2) NOT NULL,
									`term_began` date NOT NULL,
									`term_ends` date NOT NULL,
									`next_term_begins` date NOT NULL,
									`next_term_ends` date NOT NULL,
									`max_atd` varchar(10) NOT NULL,
									`status` varchar(10) NOT NULL
									)");


$result=$con->query("SELECT * FROM `session_info` WHERE `session`='$session' AND `term`='$term'");
if ($result->num_rows > 0) {

  while ($rows=$result->fetch_assoc()) {

    $term_began=$rows['term_began'];
    $term_ends=$rows['term_ends'];
    $next_term_begins=$rows['next_term_begins'];
		$next_term_ends=$rows['next_term_ends'];
		
		$con->query("INSERT INTO `existing_result_sheets` (`result_id`,`class`,`term`,`session`,`arm`,
							`term_began`,`term_ends`,`next_term_begins`,`next_term_ends`) VALUES (
							'$res_id', '$class', '$term', '$session_format', '$arm',
							'$term_began','$term_ends','$next_term_begins','$next_term_ends')");

  }

}else {
	echo "You have not started new session and/or term.<br/>
				Consequently, the session and/or term details will not be updated. ";
}
	
	

		$result=$con->query("SELECT * FROM `student` s LEFT JOIN `student_class` sc on sc.`std_id`=s.`std_id` WHERE sc.`class`='$class' AND sc.`arm`='$arm'");
		if ($result) {
			$x=0;
			while ($row=$result->fetch_assoc()) {
				$surname[$x]=$row['surname'];
				$othernames[$x]=$row['othernames'];
				$std_id[$x]=$row['std_id'];
				$specialization[$x]=$row['specialization'];
				$x++;
			}
		}
		for ($i=0; $i < $x; $i++) { 

			$con->query("INSERT INTO `$res_id`(`std_id`,`surname`,`othernames`) VALUES('$std_id[$i]','$surname[$i]','$othernames[$i]')");
	



			if ($specialization[$i] == "science") {	
				
				for ($j=1; $j <= $no_of_subs; $j++) {
					
					if ($subject_type[$j] == 'art' || $subject_type[$j] == 'commercial' || $subject_type[$j] == 'art & commercial') {
						
						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id[$i]'");
						
					}elseif ($subject_type[$j] == 'art & science' || $subject_type[$j] == 'commercial & science' || $subject_type[$j] == 'science' ){

						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id[$i]'");

					}


				}
			}elseif ($specialization[$i] == "art") {	
				
				for ($j=1; $j <= $no_of_subs; $j++) {
					
					if ($subject_type[$j] == 'science' || $subject_type[$j] == 'commercial' || $subject_type[$j] == 'commercial & science') {
						
						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id[$i]'");
						
					}elseif ($subject_type[$j] == 'art & science' || $subject_type[$j] == 'art & commercial' || $subject_type[$j] == 'art' ){
						
						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id[$i]'");

					}


				}
			}elseif ($specialization[$i] == "commercial") {	
				
				for ($j=1; $j <= $no_of_subs; $j++) {
					
					if ($subject_type[$j] == 'science' || $subject_type[$j] == 'art' || $subject_type[$j] == 'art & science') {
						
						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id[$i]'");
						
					}elseif ($subject_type[$j] == 'art & commercial' || $subject_type[$j] == 'commercial & science' || $subject_type[$j] == 'commercial' ){
						
						$con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id[$i]'");

					}


				}
			}
			


		}



		
	// add details for cumulative
	if (preg_match("/third/",$res_id)) {

		for($x=1; $x<=$no_of_subs; $x++)
			{

				$subjects_first_term[$x] = $subjects[$x]."_first_term";
				$subjects_second_term[$x] = $subjects[$x]."_second_term";
				$subjects_cumulative[$x] = $subjects[$x]."_cumulative";
				/* $con->query("UPDATE $class
						SET  max_score = '100' 
													
							WHERE sid ='$x'");				
				 */

				$con->query("ALTER TABLE `$res_id` ADD `$subjects_first_term[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_second_term[$x]` INT(2) NOT NULL DEFAULT 0,
										ADD `$subjects_cumulative[$x]` INT(2) NOT NULL DEFAULT 0
										");


				

      }

	}


		
echo "Result sheet successfully created.<br/><a href='javascript:history.back();' class='btn btn-warning'>Back</a>";
//header ("Location: class_portal.php?sid=2&msg=done&class=$class&session=$session&term=$term&arm=$arm");
$con->close();
?>
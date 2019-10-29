<?php
// session_start();
// ini_set('display_errors', 0);

$username = 'Guest';
$user = 'Guest';
$auth= 'false';
	
	//if(isset($_COOKIE['user']) && isset($_SESSION['priviledge']))
	if(isset($_SESSION['user_id']) && isset($_SESSION['priviledge']))
		{

			//$staff_id = $_COOKIE["user"];
			$staff_id = $_SESSION["user_id"];
			//$auth = "true";
			
			//check if user is registered properly
				$get_user = mysqli_query($con,"SELECT * FROM `staff` WHERE `staff_id`='$staff_id'");
				
					
				if(mysqli_num_rows($get_user) ==1)
					{
						//user is logged in properly
							while($row=mysqli_fetch_array($get_user))
								{
									$name = $row['surname'].", ".$row['othernames'];
									$auth = 'true';
									$class = strtolower($row['class']);
									$priviledge = strtolower($row['priviledge']);
									
								}
							
							
					}
		}



//flush();
//mysqli_close($con);
?>
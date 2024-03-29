<?php
session_start();
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "class_teacher" && $priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}
$today = date('d M, Y');

 // Header('Cache-Control: no-cache');
 // Header('Pragma: no-cache');

	$arm = $_GET['arm'];
	
	$uid=$_GET['uid'];
	$result_id = $_GET['result_id'];
	$class=$_GET['class'];
	$class_formatted=strtoupper($class." ".$arm);

	$count=0;
	
	$y=0;
	$x=0;
	
	$bsat_total=0;
	$bsat_avg=0;

	
	$ranv_total=0;
	$ranv_avg=0;

	
	$pvs_total=0;
	$pvs_avg=0;
	
 
 $aoi='';
/* 
	$lvl='';
	if(preg_match("/kg/", $result_id)){$lvl = 'kg';}
	if(preg_match("/primary/", $result_id)){$lvl = 'PRIMARY';}
	if(preg_match("/jss/", $result_id)){$lvl = 'SECONDARY';}
	if(preg_match("/sss/", $result_id)){$lvl = 'SECONDARY';}

 */

	
  

 //include "update.php";
 //include "update_pos_per_subject.php";


	$y=0;
	$x=0;
	$z=0;
	
	$total_age = 0;
	$no_of_res=0;

	//calculate average age
	$get_all_res = $con->query("SELECT * FROM `$result_id` ");

	
if($get_all_res)
	{
		$no_of_res = $get_all_res->num_rows;
			
			while($row = $get_all_res->fetch_array())
				{
					
					$total_age = $total_age + $row['age'];
					
				}
				
				$average_age = $total_age / $no_of_res;
				$average_age = number_format($average_age, 1, '.','');
	
	}


	// get term data
	$get_term_data = $con->query("SELECT * FROM `existing_result_sheets` WHERE result_id='$result_id'");
	
	if($get_term_data)
		{
		
			while($row = $get_term_data->fetch_array())
				{
				
					$term = strtoupper(str_replace("_", " ", $row['term']));
					$session =  strtoupper(str_replace("_", " / ", $row['session']));
					$term_began = $row['term_began'];
					$term_ends = $row['term_ends'];
					$next_term_begins = $row['next_term_begins'];
					$next_term_ends = $row['next_term_ends'];
					//$ntf = $row['ntf'];
 
					$max_atd = $row['max_atd'];
					//$atd_max = $row['max_atd'];

					//$show_pos = $row['show_pos'];
					//$show_pos_sub = $row['show_pos_sub'];
					
				}
		
		}
	
	
	
	
	
	$combined_max_total = 0;
	
	
		$affective='baa_orig';
	
 
		//$affective='behaviour_and_activities';
 
		
		
	
	// get behaviour and activities
	$get_baa = $con->query("SELECT * FROM $affective  order by behaviour");
	
	if($get_baa)
		{
		
			$no_of_baa = $get_baa->num_rows;
			
				while($row = $get_baa->fetch_array())
					{
						$y++;
						$behaviour_orig[$y] =  $row['behaviour'];
						$behaviour[$y] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
					 // $behaviour_orig[$y] =  substr($row['behaviour'], 0, 1).substr(strtolower($row['behaviour']), 1, 35);
						$behaviour_orig[$y] = strtolower($behaviour_orig[$y]);
						$behaviour_orig[$y] = ucwords($behaviour_orig[$y]);
					}
		
		}




	// get psychomotor
	$get_psy = $con->query("SELECT * FROM `psychomotor` order by behaviour");
	
	if($get_psy)
		{
			$no_of_psy = $get_psy->num_rows;
			while($row = $get_psy->fetch_array())
				{
					$z++;
					$behaviour_orig_psy[$z] =  $row['behaviour'];
					$behaviour_psy[$z] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
					$behaviour_orig_psy[$z] =  substr($row['behaviour'], 0, 1).substr(strtolower($row['behaviour']), 1, 33);

				}	
		}





// get subjects	
	$get_subs = $con->query("SELECT * FROM `$class` ORDER BY `subjects` ASC");
	
	if($get_subs)
		{
			$no_of_subs = $get_subs->num_rows;
			while($row = $get_subs->fetch_array())
				{
					$x++;
					$subject_orig[$x] = $row['subjects'];
				//	$max_score[$x] = $row['max_score'];
				//	$category[$x] = $row['category'];

					$subjects[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['subjects']));
					$subjects_ca_1[$x] = $subjects[$x]."_ca_1";
					$subjects_ca_2[$x] = $subjects[$x]."_ca_2";
					$subjects_ca_3[$x] = $subjects[$x]."_ca_3";
					$subjects_ca_4[$x] = $subjects[$x]."_ca_4";
					$subjects_exams[$x] = $subjects[$x]."_exam";
					// $subjects_ca_5[$x] = $subjects[$x]."_ca_5";
					// $subjects_ca_6[$x] = $subjects[$x]."_ca_6";
					$subjects_position[$x] = $subjects[$x]."_position";
					$subjects_average[$x] = $subjects[$x]."_average";
					$subjects_total[$x] = $subjects[$x]."_total";
				//	$max_score[$x] = $row['max_score'];
					
					//$subject_orig[$x] = substr($subject_orig[$x], 0, 1).substr(strtolower($subject_orig[$x]), 1, 32);
					$subject_orig[$x] = ucwords(strtolower($subject_orig[$x]));
					

				//	$subjects_chs[$x] = $subjects[$x]."_chs";
				//	$subjects_cls[$x] = $subjects[$x]."_cls";
					
					//$subjects_cas[$x] = $subjects[$x]."_cas";
					
					
				$subjects_cumulative[$x] = $subjects[$x]."_cumulative";					
				$subjects_ca_first_term[$x] = $subjects[$x]."_first_term";					
				$subjects_ca_second_term[$x] = $subjects[$x]."_second_term";					
					
				//	$subjects_ca_first_term[$x] = $subjects[$x]."_ca_first_term";
				//	$subjects_ca_second_term[$x] = $subjects[$x]."_ca_second_term";
				//	$subjects_ca_third_term[$x] = $subjects[$x]."_ca_third_term";
				
				

				 				

  
				}
				
		}

	
	
	//$total_max = ($no_of_subs) * 100;

	$no_on_rolls = $con->query("SELECT * FROM `$result_id`")->num_rows;
	
	$get_res = $con->query("SELECT * FROM `$result_id` WHERE uid='$uid' ");

	
if($get_res)
	{
		
		
		while($row = $get_res->fetch_array())
			{
				$surname = strtoupper($row['surname']);
				$other_names = strtoupper($row['othernames']);
				//$height = $row['height'];
				//$weight = $row['weight'];
				$age = $row['age'];
				//$sex = $row['sex'];
				$position = $row['position'];
				$adm_no = $row['reg_no'];
				$exam_no = $adm_no;
				//$exam_no = $row['exam_no'];
				$average_score = $row['average'];
				$class_average_score = $row['class_average'];
				$atd = $row['atd'];
								
				//$comment = $row['comment'];
				//$fees_owed = $row['fees_owed'];
				$status = $row['status'];
				$pp = $row['passport'];
				
			$student_id = $row['std_id'];	

								
				if(file_exists($pp) && file($pp))
					{
					
					}else{
					
						$pp = '../images/passport.png';
					
					}
				
				
				//var_dump($subjects_total);exit();
				
				$my_total = $row['total_score'];
				
				
				$no_of_sub_std=0;
				$no_of_sub_failed=0;
					for($x=1; $x<=$no_of_subs; $x++)
						{
							$score_ca_1[$x] = $row[$subjects_ca_1[$x]];
							$score_ca_2[$x] = $row[$subjects_ca_2[$x]];
							$score_ca_3[$x] = $row[$subjects_ca_3[$x]];
							$score_ca_4[$x] = $row[$subjects_ca_4[$x]];
							$score_exams[$x] = $row[$subjects_exams[$x]];
						//	$score_ca_5[$x] = $row[$subjects_ca_5[$x]];
						//	$score_ca_6[$x] = $row[$subjects_ca_6[$x]];
							$total[$x] = $row[$subjects_total[$x]];
							$subjects_position_score[$x] = $row[$subjects_position[$x]];
							$subjects_average_score[$x] = $row[$subjects_average[$x]];

							if (preg_match("/third/",$result_id)) {
								$score_ca_first_term[$x] = $row[$subjects_ca_first_term[$x]];
								$score_ca_second_term[$x] = $row[$subjects_ca_second_term[$x]];
								$cumulative[$x] = $row[$subjects_cumulative[$x]];
							}
							
							if ($row[$subjects[$x]] != "N/A") {
								$no_of_sub_std++;
							}
							
							
include 'grading.php';
		
																		
									if($total[$x] > 0)
										{
										
											$combined_max_total ++;
										
										}else{

											$score_ca_1[$x] = "";
											$score_ca_2[$x] = "";
											$score_ca_3[$x] = "";
											$score_ca_4[$x] = "";
											$score_exams[$x] = "";
											$subjects_average_score[$x] = "";
											$grade[$x] = '';
											$subjects_position_score[$x] = '';
											$total[$x] = '';
											$remark[$x] = '';
										}
									
									

if($total[$x] > 0 && $total[$x] < 40 && $total[$x] != '')
	{
		$no_of_sub_failed++;
		$aoi .=  $subject_orig[$x].", ";

	}

	$no_of_sub_passed=$no_of_sub_std-$no_of_sub_failed;

// $aoi= area of improvement

	//if($category[$x] == 'BSAT')
	//		{
	//			$bsat_total = $bsat_total + $total[$x];
	//		}




	//if($category[$x] == 'RANV')
	//		{
	//			$ranv_total = $ranv_total + $total[$x];
	//		}



	//if($category[$x] == 'PVS')
	//		{
	//			$pvs_total = $pvs_total + $total[$x];
	//		}


		
							
						}
						
						
						
					
					for($y=1; $y<=$no_of_baa; $y++)
						{
							$mark[$y] = $row[$behaviour[$y]];
							
							$tick5[$y] = "<font color='white'>.</font>";
							$tick4[$y] = "<font color='white'>.</font>";
							$tick3[$y] = "<font color='white'>.</font>";
							$tick2[$y] = "<font color='white'>.</font>";
							$tick1[$y] = "<font color='white'>.</font>";
							
							
							
							if($mark[$y] == 'A')
								{
									$tick5[$y] = "<img src='../images/tick.png'>";
								
								}else if($mark[$y] == 'B')
											{
												$tick4[$y] = "<img src='../images/tick.png'>";
											
											}else if($mark[$y] == 'C')
													{
														$tick3[$y] = "<img src='../images/tick.png'>";
													
													}else if($mark[$y] == 'D')
															{
																$tick2[$y] = "<img src='../images/tick.png'>";
															
															}else if($mark[$y] == 'E')
																	{
																		$tick1[$y] = "<img src='../images/tick.png'>";
																	
																	}
																	
																	
						}
						
						
						
						
						
						
						
						
						
						
						
						
						
						for($z=1; $z<=$no_of_psy; $z++)
						{
							$mark_psy[$z] = $row[$behaviour_psy[$z]];
							
							$tick5_psy[$z] = "<font color='white'>.</font>";
							$tick4_psy[$z] = "<font color='white'>.</font>";
							$tick3_psy[$z] = "<font color='white'>.</font>";
							$tick2_psy[$z] = "<font color='white'>.</font>";
							$tick1_psy[$z] = "<font color='white'>.</font>";
							
							
							
							if($mark_psy[$z] == 'A')
								{
									$tick5_psy[$z] = "<img src='../images/tick.png'>";
								
								}else if($mark_psy[$z] == 'B')
											{
												$tick4_psy[$z] = "<img src='../images/tick.png'>";
											
											}else if($mark_psy[$z] == 'C')
													{
														$tick3_psy[$z] = "<img src='../images/tick.png'>";
													
													}else if($mark_psy[$z] == 'D')
															{
																$tick2_psy[$z] = "<img src='../images/tick.png'>";
															
															}else if($mark_psy[$z] == 'E')
																	{
																		$tick1_psy[$z] = "<img src='../images/tick.png'>";
																	
																	}
																	
																	
						}

		
						
						
						

		
			}
	
	
	}

	$average = $average_score;
	$average = number_format($average, 1, '.','');
	$max_total = $combined_max_total * 100;
	






// principal's comment

if(strlen($aoi) > 4){$aoi = "The student needs to improve in ".$aoi;}		
		else
			{	
			
				/* if(rand(1,3)==1){$aoi = 'Well Done!';}else
				if(rand(1,3)==2){$aoi = 'Very good. Keep it up!';}else
				if(rand(1,3)==3){$aoi = 'Excellent!';}
				*/

				if($average >=85)
								{
									$grade_overall = ' A ';
									$aoi = 'Excellent result. ';
									
								}else	
								
								
							if($average >=71)
								{
									$grade_overall = ' B ';
									$aoi = 'A very good result.  ';
									
								}else
							 
							if($average >=60)
								{
									$grade_overall = ' C ';
									$aoi = 'You can do better. ';

								}else
								
							if($average >=50)
								{
									$grade_overall = ' P ';
									$aoi = 'You need to put in more effort. ';

								}else
							
									{
									$grade_overall = ' F ';
									$aoi = "Don't  be discouraged. There's still room for improvement. ";
									

								}
				
			}

							
					 
								// form master's comment
							
							if($average >=85)
								{
									$grade_overall = ' A ';
									$remark_overall = 'An excellent performance!! Keep it up! ';
									
								}else	
								
								
							if($average >=71)
								{
									$grade_overall = ' B ';
									$remark_overall = 'A very good result!!  ';
									
								}else
							 
							if($average >=60)
								{
									$grade_overall = ' C ';
									$remark_overall = 'An average result. Please work harder. ';

								}else
								
							if($average >=50)
								{
									$grade_overall = ' P ';
									$remark_overall = 'A border-line pass. ';

								}else
							
									{
									$grade_overall = ' F ';
									$remark_overall = 'Fair. You need to improve. ';
									

								}




//$remark_overall = $remark_overall." ".$aoi;




/**

	  
	$pm_cd = $_GET['pm_cd'];
	$match_key = strlen($surname).strlen($other_names);
									$match_key  = $match_key * 7;

	if($pm_cd != $match_key){  include "ydnhptvtp.php"; die("  "); };
	
	  
**/	
	
	
	
	
	
	



//get class highest score and lowest score
								
		
	$subjects_chs_value[$x]=0;
	$subjects_cls_value[$x]=0;

	for($x=1; $x<=$no_of_subs; $x++)
			{
 
			
			
			  
				
				$get_chal[$x] = $con->query("SELECT `$subjects_total[$x]` FROM `$result_id` ORDER BY $subjects_total[$x] DESC");
				$no_of_chal[$x] = $get_chal[$x]->num_rows;
				
				 
				 
				 $dft=0;
				while($row = $get_chal[$x]->fetch_array())
					{
						$la_score[$dft] = $row[$subjects_total[$x]];						
						$dft++; 						
 						//break;
					}
									
		  	

					$subjects_chs_value[$x] = $la_score[0];
					$subjects_cls_value[$x] = end($la_score);
 						
				

				/* 	if($subjects_chs_value[$x]==0){$subjects_chs_value[$x]='';}		
					if($subjects_cls_value[$x]==0 || $subjects_cls_value[$x]==100){$subjects_cls_value[$x]='';}		
 				*/
				
				

			}
 
	
	
	
			
	
	
	//determine group average
	//	$bsat_avg = $bsat_total / 4;
	//	$ranv_avg = $ranv_total / 3;
	//	$pvs_avg = $pvs_total / 2;
 


	//	$bsat_avg = number_format($bsat_avg, 1, '.','');
	//	$ranv_avg = number_format($ranv_avg, 1, '.','');
	//	$pvs_avg = number_format($pvs_avg, 1, '.','');

	//include "det_std_for_res.php";
	

	//$max_atd = $no_of_atd;
	//$max_atd =20;

		//render html
	echo("<html   xmlns='http://www.w3.org/1999/xhtml'
			      xmlns:og='http://ogp.me/ns#'
			      xmlns:fb='http://www.facebook.com/2008/fbml'>
			
			<head>
				<title>
				--</title>
			
				<meta http-equiv='Content-Language' content='en-us'>
				<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>
				<link rel='stylesheet' href='print.css' type='text/css' media='screen'>
				<link rel='stylesheet' href='print_2.css' type='text/css' media='print'>
				<script src='scripts/extra_commands.js' type='text/javascript' language ='javascript'></script>
			</head>
			
	<body style=\"width:800px;  background-image:url('../images/bg_res.jpg');\">

 
	<div >
 
	");
	

 

echo("
<div align='center'>




<div align='center' style=\"width:150px; height:100px; float:right; \">

	<div align='center' style='width:150px; height:200px; float:right; overflow:hidden; background-color: #DFDFDF' valign=middle>
		
		<table border='0' width='100%' cellspacing='0' cellpadding='1' height='100%'>
			<tr>
				<td valign='middle' align='center'>
					<img src='$pp' border='0' height='200' width='150'>
				</td>
			</tr>
		</table>
		
	</div>
	
</div>


<div align=center style='width:650px; height:100px; float:left;'>
	<img src='../images/header.png'>
</div>



<div style='width:800px; height:100px;' align='left'>

<div style='width:450px; height:94px; float:RIGHT;' align=left>

<table border='0' width='298' cellspacing='1' cellpadding='3' style='border: 1px solid #EBEBEB' height='70'>
	<tr>
		<td   bgcolor='#F5F5F5'><b>Reg. No.</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='264' >
		<b>$adm_no</b></td>
	</tr>
	<tr>
		<td   bgcolor='#F5F5F5'><b>Exam No.</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='264' >
		<b>$exam_no</b></td>
	</tr>

 
	<tr>
		<td bgcolor='#F5F5F5'><b>Attendance:</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='155' >
		<b>$atd out of $max_atd</b></td>
	</tr>
	
<!--<tr>
		<td   bgcolor='#F5F5F5'><b>Term Ends</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='155' >
		<b>$term_ends</b></td>
	</tr>-->
	
	<tr>
		<td bgcolor='#F5F5F5' width=220><b>Next Term Begins</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='155' >
		<b>$next_term_begins</b></td>
	</tr>
	
</table>

</div>

<div style='width:350px; height:94px; float:left; ' align=left>

	<table border='0' width='348' cellspacing='1' cellpadding='3' style='border: 1px solid #EBEBEB' height='70'>
		<tr>
			<td width='67' bgcolor='#F5F5F5'><b>Name:</b></td>
			<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='264' >
			<b>$surname,&nbsp; $other_names</b></td>
		</tr>
		<tr>
			<td  bgcolor='#F5F5F5'><b>Class:</b></td>
			<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='138'>
			<b>$class_formatted</b></td>
		 
		</tr>
		<tr>
			<td  bgcolor='#F5F5F5'><b>Term:</b></td>
			<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='138'>
			<b>$term</b></td>
		 
		</tr>
		
	<tr>
		<td  bgcolor='#F5F5F5'><b>Session:</b></td>
		<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #EBEBEB' width='264' >
		<b>$session</b></td>
	</tr>	
	
		
	</table>

</div>
</div>


 
&nbsp;
  <br>
 
 
-
</div>
 
<div align='center'>

<table border='0' cellpadding=1 cellspacing=0 >
	<tr>
		<td  valign=top>
	
	<table cellspacing=0  border='0' style='border: 1px solid #3A3A3A' id=grade_table width='800px'>
		<tr style='border: 1px solid #3A3A3A'>
			<td style='border: 1px solid #3A3A3A' colspan=2   HEIGHT=100 align=center> <b>PART A: <BR>COGNITIVE</b> </td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/ca_1.png'></td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/ca_2.png'></td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/ca_3.png'></td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/ca_4.png'></td>

			<td valign=bottom width='5'  >&nbsp;</td>
			
			<!-- td valign=bottom style='border: 1px solid #3A3A3A' width='20'><div align='center' style='width:1px; height:1px; transform:rotate(270deg);'>Exam</div></td -->
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/exam.png'></td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/total.png'></td>
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/position.png'></td>
 
 
 
 		   <td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/chs.png' height='100' width='25'></td>
			   <td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/cls.png' height='100' width='25'></td>

			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/cas.png' height='100' width='25'></td>
		 
					");
			 
			
			
			
									
if(preg_match("/third/", $result_id))	
	{						
					
		echo("	


			<td valign=bottom width='5'  rowspan='20'>&nbsp;</td>
					
				<td bgcolor='#FFFFD2' valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/fts.png' height='100' width='25'></td>
				<td bgcolor='#D2FFFF'  valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/sts.png' height='100' width='25'></td>
				<td bgcolor='#FFD2FF' valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/tts.png' height='100' width='25'></td>
				<td bgcolor='#EFEFEF' valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/cs.png' height='100' width='25'></td>
			
			<td valign=bottom width='5'  rowspan='20'>&nbsp;</td>
			
			");
	}
		
			
			
			
			
			
		echo("
			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/grade.png'></td>

			<td valign=bottom style='border: 1px solid #3A3A3A' width='20'><img src='../images/remarks.png'></td>
 
			
		</tr>	
		
 
		
		");
	




//first category
	
	for($x=1; $x<=$no_of_subs; $x++)
		{
			if($total[$x] < 40)
				{
				
					$color[$x] = '<font color=red>';
					
				}else{
						$color[$x] = '';
					}
		
	
			
	//if($total[$x] > 0)
	//		{
			
			$count++;
			//$bsat_total = $bsat_total + $total[$x];
			
			//if($subject_orig[$x] == 'Hhandwriting'){$subject_orig[$x] = 'Handwriting';}
			
				echo("
					
							<tr height=22  >
							 	<td align=right width=15>
							 	$count.
							 	</td>					
								<td style='border: 1px solid #3A3A3A' >
								<div style='width:180px; overflow:visible;'>&nbsp;$subject_orig[$x]</div></td>
	 
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$score_ca_1[$x]</td>
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$score_ca_2[$x]</td>
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$score_ca_3[$x]</td>
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$score_ca_4[$x]</td>

								
								<td valign=bottom width='5'  align='center'>&nbsp;</td>
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$score_exams[$x]</td>
								<td style='border: 1px solid #3A3A3A' align='center'><b>$color[$x]$total[$x]</b></td>
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$subjects_position_score[$x]</td>



								<td style='border: 1px solid #3A3A3A' align='center'>$subjects_chs_value[$x]</td>
								<td style='border: 1px solid #3A3A3A' align='center'>$subjects_cls_value[$x]</td>

			 
 								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$subjects_average_score[$x]</td>
 
								");
								
								
								
 if(preg_match("/third/", $result_id))	
	{										
		echo("	
			<td bgcolor='#FFFFD2' valign=bottom style='border: 1px solid #3A3A3A' width='25' align='center'>$score_ca_first_term[$x]</td>
			<td  bgcolor='#D2FFFF' valign=bottom style='border: 1px solid #3A3A3A' width='25' align='center'>$score_ca_second_term[$x]</td>
			<td  bgcolor='#FFD2FF' valign=bottom style='border: 1px solid #3A3A3A' width='25' align='center'>$color[$x]$total[$x]</td>
			<td  bgcolor='#EFEFEF' valign=bottom style='border: 1px solid #3A3A3A' width='25' align='center'><b>$color[$x]$cumulative[$x]</b></td>
			");
								
	}				
	

echo("
								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$grade[$x]</td>

								<td style='border: 1px solid #3A3A3A' align='center'>$color[$x]$remark[$x]</td>
							</tr>
					
					");
//			}
 

 
 }


 


 
		
	echo("
		</tr>
		
	</table>
</div><br><br>
<!--<img src='../images/key2.png'>-->
	
		</td>

	</tr>
	<tr>
		<td valign=top >
		
			

		");
		













		
		
	//place affective here	
	echo("
	 <tr height=23>
	<td colspan=17 style='border: 1px solid #3A3A3A' align=justify width=20><br>
	<img src='../images/caption.png'>
	
	
	<div></div>
<div style='width:265px; height:280px; float:left'> 
	<table border='0' id='grade_table' cellspacing='0'  style='border: 1px solid #3A3A3A'>
			<tr>
				<td width='95' height=50 style='border-style: solid; border-width: 1px' rowspan='2' align='center'>
					 TRAITS
				</td>
				<td style='border-style: solid; border-width: 1px' colspan='5' align='center'>
				<p align='center'><b>RATINGS</td>
			</tr>
			
			<tr>
				<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>A</td>
				<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>B</td>
				<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>C</td>
				<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>D</td>
				<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>E</td>
			</tr>
	
	");
	
	
	

		
		for($y=1; $y<=$no_of_baa; $y++)
			{
			if($behaviour_orig[$y] != '-')
							
				echo("
				
					<tr height=23>
						
						<td style='border: 1px solid #3A3A3A'  align='left'><div style='width:165px;'>&nbsp;$behaviour_orig[$y]</div></td>
						
						<td style='border: 1px solid #3A3A3A'  align='center'> $tick5[$y]</td>
						<td style='border: 1px solid #3A3A3A'   align='center'> $tick4[$y]</td>
						<td style='border: 1px solid #3A3A3A' align='center'> $tick3[$y]</td>
						<td style='border: 1px solid #3A3A3A'   align='center'> $tick2[$y]</td>
						<td style='border: 1px solid #3A3A3A'  align='center'> $tick1[$y]</td>
					</tr>
					
				");
				
				
				
				if($y==8 || $y==18)
					{
					if($behaviour_orig[$y] != '-')

						
						echo("
						</table>
						</div>
						<div style='width:265px; height:280px; float:left'> 
							<table border='0' id='grade_table' cellspacing='0'  style='border: 1px solid #3A3A3A'>
								<tr>
									<td width='95' height=50 style='border-style: solid; border-width: 1px' rowspan='2' align='center'>
										TRAITS
									</td>
									<td style='border-style: solid; border-width: 1px' colspan='5' align='center'>
									<p align='center'><b>RATINGS</td>
								</tr>
								
								<tr>
								 
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>A</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>B</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>C</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>D</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>E</td>
								</tr>

						
						");					
					
					}
				
				
			}

 

	 

echo("
						</table>
						</div>
						<div style='width:265px; height:280px; float:left'> 
							<table border='0' id='grade_table' cellspacing='0'  style='border: 1px solid #3A3A3A'>
								<tr>
									<td width='95' height=50 style='border-style: solid; border-width: 1px' rowspan='2' align='center'>
										TRAITS
									</td>
									<td style='border-style: solid; border-width: 1px' colspan='5' align='center'>
									<p align='center'><b>RATINGS</td>
								</tr>
								
								<tr>
								 
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>A</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>B</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>C</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>D</td>
									<td style='border: 1px solid #3A3A3A' width='25' align='center'><b>E</td>
								</tr>

						
					");



		
		for($z=1; $z<=$no_of_psy; $z++)
			{
			
							
				echo("<tr height=23>
						
						<td style='border: 1px solid #3A3A3A'  align='left'><div style='width:165px;'>&nbsp;$behaviour_orig_psy[$z]</div></td>
						 
						<td style='border: 1px solid #3A3A3A'  align='center'> $tick5_psy[$z]</td>
						<td style='border: 1px solid #3A3A3A'   align='center'> $tick4_psy[$z]</td>
						<td style='border: 1px solid #3A3A3A' align='center'> $tick3_psy[$z]</td>
						<td style='border: 1px solid #3A3A3A'   align='center'> $tick2_psy[$z]</td>
						<td style='border: 1px solid #3A3A3A'  align='center'> $tick1_psy[$z]</td>
					</tr>
					
				");
				
				
				
				
				
			}

 

		 
	
	
echo("	
		</table>
	</div>
");







//if($show_pos == '0'){ $position = '-'; }
	

echo("

		
		</td>
		<td>
		

		
		</td>
	</tr>
</table>

</div>

 
<div >

 
<table border='0' width='100%'>
		<tr height=35>
			<td  width=120><b>Total Score:</td>
			<td width=40 style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px' align='center'>$my_total</td>
			<td width='10'>&nbsp;</td>

			<td width='45'>
			<p align='right'><b>Average</b></td>
			<td  align=center style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px' width='60'>$average %</td>

			<td width='10'>&nbsp;</td>
			<td width='130'>
			<p align='right'><b> Class Average</b></td>
			<td  align=center style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px' width='60'>$class_average_score %</td>
			
			
			<td width='10' align='right'><b>Position:</td>
			<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px' width='130'>
			<p align='center'><b>$position</b> out of $no_on_rolls</td>
			
 
			
			<td width='5'>&nbsp;</td>
			<td width='50' align='right'><b>Grade:</td>
			<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px' width='20'>
			<p align='center'>$grade_overall</td>
			
			
			
			
			<td width='40'>
			<p align='right'><b>Date:</b></td>
			<td align=center style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px'><div style='width:100px;'>$today</div>
			</td>
		</tr>
	</table>
	
<div style='display:flex;'>
		<table border='0' width='70%'>

				<tr height=35>
					<td width=20><b>Form Master's Comments:</b></td>
					<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px'  align='justify'>
					<font face='lhnd'>$remark_overall</font></td>
				</tr>

				<tr height=35>
					<td width=20><b>Principal's Comments:</b></td>
					<td style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px'  align='justify'>
						<font face='lhnd'>$aoi</font>
					</td>
				</tr>
				
		</table>
	
	<div align='right' style='align-content:center;'>		
		<img src='../images/sign_sec1.jpg'>
	</div>

</div>

	
</div>



<div style='display:flex;'>

	<table border='0' cellspacing='0'  style='border: 1px solid #3A3A3A'>
		<tr>
			<th colspan='3' width='25' height='25' style='border-style: solid; border-width: 1px' align='center'>
				Grading Table
			</th>
		</tr>
		<tr>
			<th width='25' height='25' style='border-style: solid; border-width: 1px' align='center'>Grade</th>
			<th width='95' height='25' style='border-style: solid; border-width: 1px' align='center'>Score</th>
			<th width='95' height='25' style='border-style: solid; border-width: 1px' align='center'>Remark</th>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>A</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>80 - 100</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Excellent</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>B</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>70 - 80</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Very Good</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>C</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>60 - 70</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Good</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>D</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>50 - 60</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Fair</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>E</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>45 - 50</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Weak</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>F</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>0 - 45</td>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>Fail</td>
		</tr>
	</table>


	<table border='0' cellspacing='0'  style='border: 1px solid #3A3A3A'>
		<tr>
			<th width='50' height=25 style='border-style: solid; border-width: 1px' align='center' colspan='3'>
				Traits Grade
			</th>
		</tr>
		
		<tr>
			<th width='25' height='25' style='border-style: solid; border-width: 1px' align='center'>Grade</th>
			<th height='25' style='border-style: solid; border-width: 1px' align='center'>Remark</th>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>A</td>
			<td style='border: 1px solid #3A3A3A' align='center'>
				Maintains an excellent degree of observable trait
			</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>B</td>
			<td style='border: 1px solid #3A3A3A' align='center'>
				Maintains high level of observable trait	
			</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>C</td>
			<td style='border: 1px solid #3A3A3A' align='center'>
				Acceptable level of observable trait
			</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>D</td>
			<td style='border: 1px solid #3A3A3A' align='center'>
				Show minimal regard fro observable trait
			</td>
		</tr>
		<tr>
			<td style='border: 1px solid #3A3A3A' width='25' align='center'>E</td>
			<td style='border: 1px solid #3A3A3A' align='center'>
				Has no ragard for observable trait
			</td>
		</tr>

	</table>


	<table border='0' cellspacing='5' cellpadding='5'>
		<tr>
			<th colspan='2'>Subject Statistics</th>
		</tr>

		<tr>
			<td>Subjects Taken</td>
			<td>$no_of_sub_std</td>
		</tr>
		<tr>
			<td>Subjects Passed</td>
			<td>$no_of_sub_passed</td>
		</tr>
		<tr>
			<td>Subjects Failed</td>
			<td>$no_of_sub_failed</td>
		</tr>

	</table>

</div>
<a id='btn_print' href='#' onclick='print_result()'>PRINT</a></p>
 

</div>
");


//include "share_bar.php";
//include "msg_bar.php";


	flush();
	$con->close();

?>

<script>
	function print_result(){
		document.getElementById("btn_print").style.display="none";
		window.print();
		document.getElementById("btn_print").style.display="block";
	}

</script>

<?php

	$atd_id = str_replace("res_id", "atd_student", $result_id);
	$this_atd=0;
		
		//get state of atd
			$get_state = mysqli_query($con,"SELECT `$student_id` FROM `$atd_id` ");
			
			$no_of_atd = mysqli_num_rows($get_state);
			
			while ($row=mysqli_fetch_array($get_state))
				{
					if($row[$student_id] ==1){$this_atd++;}										
				}



//	if($this_atd==0){$this_atd='-';}else{$this_atd=$this_atd." / ".$no_of_atd;}
	
?>
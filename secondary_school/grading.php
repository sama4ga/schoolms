<?php
if(preg_match("/third/", $result_id))
			{
	 
	 
							if($cumulative[$x] >=80)
									{
										$grade[$x] = ' A ';
										$remark[$x] = 'Excellent';
										
									}else
								
						 
								
								 
								if($cumulative[$x] >=70)
									{
										$grade[$x] = ' B ';
										$remark[$x] = 'Very Good';
										
									}else
								
								if($cumulative[$x] >=60)
									{
										$grade[$x] = ' C ';
										$remark[$x] = 'Good';
										
									}else
								
								 
								 
								
								if($cumulative[$x] >=50)
									{
										$grade[$x] = ' D ';
										$remark[$x] = 'Fair';
										
									}else 
										
								 

								if($cumulative[$x] >=45)
									{
										$grade[$x] = ' E ';
										$remark[$x] = 'Weak';
										
										
									}else{
									
									
												$grade[$x] = ' F ';
												$remark[$x] = 'Fail';
												
												
											}
	
	
	
		}else{
		
		
		
		
							if($total[$x] >=80)
									{
										$grade[$x] = ' A ';
										$remark[$x] = 'Excellent';
										
									}else
								
						 
								
								 
								if($total[$x] >=70)
									{
										$grade[$x] = ' B ';
										$remark[$x] = 'Very Good';
										
									}else
								
								if($total[$x] >=60)
									{
										$grade[$x] = ' C ';
										$remark[$x] = 'Good';
										
									}else
								
								 
								 		
								if($total[$x] >=50)
									{
										$grade[$x] = ' D ';
										$remark[$x] = 'Fair';
										
									}else
								
								if($total[$x] >=45)
									{
										$grade[$x] = ' E ';
										$remark[$x] = 'Weak';
										
									}else 
									

											{
									
												$grade[$x] = ' F ';
												$remark[$x] = 'Fail';
												
			
											}
		
		
		
		
		}
		
?>
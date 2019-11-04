<?php




$get_subs = $con->query("SELECT * FROM `$class_admitted` ");
	
if($get_subs)
  {
    $no_of_subs = $get_subs->num_rows;
    $x = 0;
    while($row = $get_subs->fetch_array())
      {
      
        $x++;
        $subjects[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['subjects']));
        $subject_type[$x]=$row['type'];
        
      }

  }



if ($specialization == "science") {	
				
  for ($j=1; $j <= $no_of_subs; $j++) {
    
    if ($subject_type[$j] == 'art' || $subject_type[$j] == 'commercial' || $subject_type[$j] == 'art & commercial') {
      
      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id'");
      
    }elseif ($subject_type[$j] == 'art & science' || $subject_type[$j] == 'commercial & science' || $subject_type[$j] == 'science' ){

      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id'");

    }


  }
}elseif ($specialization == "art") {	
  
  for ($j=1; $j <= $no_of_subs; $j++) {
    
    if ($subject_type[$j] == 'science' || $subject_type[$j] == 'commercial' || $subject_type[$j] == 'commercial & science') {
      
      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id'");
      
    }elseif ($subject_type[$j] == 'art & science' || $subject_type[$j] == 'art & commercial' || $subject_type[$j] == 'art' ){
      
      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id'");

    }


  }
}elseif ($specialization == "commercial") {	
  
  for ($j=1; $j <= $no_of_subs; $j++) {
    
    if ($subject_type[$j] == 'science' || $subject_type[$j] == 'art' || $subject_type[$j] == 'art & science') {
      
      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='N/A' WHERE `std_id`='$std_id'");
      
    }elseif ($subject_type[$j] == 'art & commercial' || $subject_type[$j] == 'commercial & science' || $subject_type[$j] == 'commercial' ){
      
      $con->real_query("UPDATE `$res_id` SET `$subjects[$j]`='applied' WHERE `std_id`='$std_id'");

    }


  }
}





?>
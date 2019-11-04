<?php
include_once "header.php";
require_once("connect.php");

include_once("auth.php");
if ($priviledge !== "class_teacher" && $priviledge !== "admin" ) {
  header("location:forbidden.php");
   exit();
}

$std_id=$_GET['stdid'];
$res_id=$_GET['resid'];
$full_name=$_GET['name'];


$get_psy = $con->query("SELECT * FROM `psychomotor` ");
	
	if($get_psy)
		{
      $z=0;
			$no_of_psy = $get_psy->num_rows;
			while($row = $get_psy->fetch_array())
				{
					$z++;
					$behaviour_psy[$z] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
				}
		
    }
    
    $affective='baa_orig';		
		
			$get_baa = $con->query("SELECT * FROM $affective ");
	
	if($get_baa)
		{
      $x=0;
			$no_of_baa = $get_baa->num_rows;
			while($row = $get_baa->fetch_array())
				{
					$x++;
					$behaviour[$x] =  strtolower(preg_replace("/[^A-Za-z0-9_-]/", "_", $row['behaviour']));
				}
						
		
    }
    

if (isset($_POST['submit'])) {

  $sql="";

  for($z=1; $z<=$no_of_baa; $z++){
    if (isset($_POST[$behaviour[$z]])) {      
      $behaviour_value[$z] = $_POST[$behaviour[$z]];
      $sql .="`".$behaviour[$z]."` = '".$behaviour_value[$z]."',";
    }
  }


  for($z=1; $z<=$no_of_psy; $z++){
    if (isset($_POST[$behaviour_psy[$z]])) {      
      $behaviour_psy_value[$z]=$_POST[$behaviour_psy[$z]];
      if ($z == $no_of_psy) {
        $sql .="`".$behaviour_psy[$z]."` = '".$behaviour_psy_value[$z]."'";      
      }else{
      $sql .="`".$behaviour_psy[$z]."` = '".$behaviour_psy_value[$z]."',";
      }
    }
  }

  /* for ($i=0; $i < count($_POST) ; $i++) { 
    $attendance=$_POST['attendance'];
    $attentiveness=$_POST['attentiveness'];
    $cooperation=$_POST['cooperation'];
    $creativity=$_POST['creativity'];
    $curiousity=$_POST['curiousity'];
    $diligence=$_POST['diligence'];
    $honesty=$_POST['honesty'];
    $initiative=$_POST['initiative'];
    $neatness=$_POST['neatness'];
    $organization=$_POST['organization'];
    $perseverance=$_POST['perseverance'];
    $punctuality=$_POST['punctuality'];
    $reliability=$_POST['reliability'];
    $responsibility=$_POST['responsibility'];
    $self_control=$_POST['self_control'];
    $legibility=$_POST['legibility'];
    $dexterity=$_POST['dexterity'];
    $drawing_and_painting=$_POST['drawing_and_painting'];
    $musical_skills=$_POST['musical_skills'];
    $sports_and_games=$_POST['sports_and_games'];
    $accuracy=$_POST['accuracy'];
  }  */

  $sql="UPDATE `$res_id` SET ".$sql." WHERE `std_id`='$std_id'";

  /* $result=$con->query("UPDATE `$res_id` SET `attendance`='$attendance',`attentiveness`='$attentiveness',
                        `cooperation`='$cooperation',`creativity`='$creativity',
                        `curiousity`='$curiousity',`diligence`='$diligence',
                        `honesty`='$honesty',`initiative`='$initiative',
                        `neatness`='$neatness',`organization`='$organization',
                        `perseverance`='$perseverance',`punctuality`='$punctuality',
                        `reliability`='$reliability',`responsibility`='$responsibility',
                        `self_control`='$self_control',`legibility`='$legibility',
                        `dexterity`='$dexterity',`drawing_and_painting`='$drawing_and_painting',
                        `musical_skills`='$musical_skills',`sports_and_games`='$sports_and_games',
                        `accuracy`='$accuracy' WHERE `std_id`='$std_id'");
 */

 $result=$con->query($sql);
  if ($result) {
    echo "Record successfully inserted.";
    //echo "<a href='psychomotor.php?stdid=$std_id&resid=$res_id' class='btn btn-success'>Continue</a>";
    echo "<a href='javascript:history.back();' class='btn btn-warning'>Back</a>";

          exit();
  }else{
    echo "An error occured ".$con->error;
  }
}



if (!$con->query("DESCRIBE `$res_id`")) {
  echo "<div>Result sheet not available for the selected class.<br/>
          Create result sheet to continue.<br/>
          <a href='javascript:history.back();' class='btn-md btn-warning'>Back</a>  
        </div>";
        exit();
}


$result=$con->query("SELECT * FROM `$res_id` WHERE `std_id`='$std_id'");
if ($result->num_rows > 0 ) {

  while ($rows=$result->fetch_assoc()) {

    for($z=1; $z<=$no_of_baa; $z++){
      $behaviour_value[$z] = $rows[$behaviour[$z]];
    }
  
  
    for($z=1; $z<=$no_of_psy; $z++){
      $behaviour_psy_value[$z]=$rows[$behaviour_psy[$z]];
    }

  }
}
        
  echo "<h2>Record Student Behaviour</h2>
        <div style='font-weight:bold;'>Student Name: <font color='red'>$full_name</font></div>
        
        <div style='width:265px; height:280px; float:left;padding-top:20px'>
          <form method='POST' action='psychomotor.php?resid=$res_id&stdid=$std_id&name=$full_name'>
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
              </tr>";
				
		for($x=1; $x<=$no_of_baa; $x++)
			{
				echo "<tr height=23>
						
                <td style='border: 1px solid #3A3A3A'  align='left'><div style='width:165px;'>&nbsp;".ucwords(str_replace('_',' ',$behaviour[$x]))."</div></td>";
                
                if ($behaviour_value[$x] == "A") {
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='E'></font></td>";
                }elseif($behaviour_value[$x] == "B"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='E'></font></td>";
                }elseif($behaviour_value[$x] == "C"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='E'></font></td>";
                }elseif($behaviour_value[$x] == "D"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='E'></font></td>";
                }elseif($behaviour_value[$x] == "E"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour[$x]' value='E'></font></td>";
                }else{
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour[$x]' value='E'></font></td>";
                }

        echo "       </tr>";
			}		
		
		for($z=1; $z<=$no_of_psy; $z++)
			{
      
        echo "<tr height=23>
						
                <td style='border: 1px solid #3A3A3A'  align='left'><div style='width:165px;'>&nbsp;".ucwords(str_replace('_',' ',$behaviour_psy[$z]))."</div></td>";
                
                if ($behaviour_psy_value[$z] == "A") {
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='E'></font></td>";
                }elseif($behaviour_psy_value[$z] == "B"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='E'></font></td>";
                }elseif($behaviour_psy_value[$z] == "C"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='E'></font></td>";
                }elseif($behaviour_psy_value[$z] == "D"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='E'></font></td>";
                }elseif($behaviour_psy_value[$z] == "E"){
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' checked name='$behaviour_psy[$z]' value='E'></font></td>";
                }else{
                  echo "<td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='A'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='B'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='C'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='D'></font></td>
                        <td style='border: 1px solid #3A3A3A'  align='center'> <font color='white'><input type='checkbox' name='$behaviour_psy[$z]' value='E'></font></td>";
                }

        echo "       </tr>";
				//$con->query("ALTER TABLE `$res_id` ADD `$behaviour_psy[$z]` VARCHAR(4) NOT NULL");
				
			}		
			
        echo "          
                  </table>

                  <div class='input-group'>
                    <input type='submit' name='submit' value='submit' class='btn btn-success form-control'>
                    <a href='javascript:history.back();' class='btn btn-warning form-control'>Back</a>
                  </div>

                </form>
                
              </div>"; 


?>
<?php
include_once("head.php");
include_once("sanitize.php");
require_once("connect.php");

$msg=array();

echo "<h2>Statistics Page</h2>";

$filter=sanitize($_REQUEST['filter']);
$group=sanitize($_REQUEST['group']);

if ($group == 'staff') {  
  $result=$con->query("SELECT `$filter` FROM `$group` WHERE `staff_id` <> '1' ORDER BY `$filter`");
}else {  
  $result=$con->query("SELECT `$filter` FROM `$group` ORDER BY `$filter`");
}


if ($result) {

  $i=0;
  while ($row=$result->fetch_assoc()) {
    
    $data[$i]=$row[$filter];

    $i++;

  }



  if($filter == "gender"){    

    $male=0;
    for ($i=0; $i < count($data); $i++) {

      if ($data[$i] == "Male") {

        $male +=1;

      }

      

    }

    $female=count($data) - $male;

    $x=json_encode(array("Male","Female"));
    $y=json_encode(array($male,$female));
    $title="Gender Statistics for all ".$group."s";
    //$values=array_combine($x,$y);
//var_dump($y);
    //bar_graph($x,$y,'Gender statistics');

      //plot($values,$filter);



      echo("<img src='show_graph.php?x=$x&y=$y&title=$title' />");

  }elseif ($filter == "dob") {

    // calculate age from date of birth (dob)
    for ($i=0; $i < count($data); $i++) { 

      $age[$i]=Age($data[$i]);


    }

    $oldest=$age[0];
    //var_dump($age);

    $index=0;
    for ($i=0; $i < $oldest; $i+=5) { 
      $start=$i;
      $end=$i+5;
      $x[$index]=$start." - ".$end;

      
      $y[$index]=0;
      for ($j=0; $j < count($age); $j++) {

        if ($age[$j] >= $start  && $age[$j] <= $end ) {

          $y[$index]++;
          array_splice($age,$j,1);
          
        }
        
      }
      //echo $x[$index]." : ".$y[$index]."<br/>";

      $index++;

    }

    //var_dump($x);
    if (empty($x)) {
      $x = ['10-15','16-20'];
    }
    if (empty($y)) {
      $y = [0,0];
    }
    $x=json_encode($x);
     $y=json_encode(array_values($y));//var_dump($y);
     $title="Age Statistics for all ".$group."s";
     echo("<img src='show_graph.php?x=$x&y=$y&title=$title' />");

    
  }elseif ($filter == "state_of_origin") {

    if ($result) {

      $i=0;
      $states=["Abia",
              "Adamawa",
              "Akwa Ibom",
              "Anambra",
              "Bauchi",
              "Bayelsa",
              "Benue",
              "Borno",
              "Cross River",
              "Delta",
              "Ebonyi",
              "Edo",
              "Ekiti",
              "Enugu",
              "Gombe",
              "Imo",
              "Jigawa",
              "Kaduna",
              "Kano",
              "Katsina",
              "Kebbi",
              "Kogi",
              "Kwara",
              "Lagos",
              "Nassarawa",
              "Niger",
              "Ogun",
              "Ondo",
              "Osun",
              "Oyo",
              "Plateau",
              "Rivers",
              "Sokoto",
              "Taraba",
              "Yobe",
              "Zamfarawa",
              "Abuja"];
     
     foreach ($states as $key => $value) {
       $state[$value]=0;
       for ($j=0; $j < count($data); $j++) { 

         if ($data[$j] == $value) {
           $state[$value]++;
           array_splice($data,$j,1);
         }
         
       }
     }

     $x=json_encode($states);
     $y=json_encode(array_values($state));
     $title="State of Origin Statistics for all ".$group."s";
     echo("<img src='show_graph.php?x=$x&y=$y&title=$title' />");

    
    }





  }

}else {
  echo "error ".$con->error;
}



function Age($dob){
  $start=strtotime($dob);
  $today=time();
  $age=floor(($today-$start)/(60*60*24*365));
  return $age;
}

 
function plot($values,$filter){

  ?>

  <h2 align='center'><?php echo $filter; ?> Statistics</h2>
	
  <div align='center'>
  <table border='0' height='338' cellspacing='0' width='850'  background='images/grid.png'>
    <tr>
      <td height='40'>&nbsp;</td>
      <td colspan='2' align='center' valign='bottom' height='40'>0<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>20<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>40<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>60<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>80<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>100<br>|</td>
      <td align='center' colspan='2' valign='bottom' height='40'>&nbsp;</td>
    </tr>
    <tr height=10px>
      <td width='122' height='21'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21' style='border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom-width: 1px'>&nbsp;</td>
      <td width='50' height='21'>&nbsp;</td>
      <td width='50' height='21'>&nbsp;</td>
    </tr>

    <?php

      $i=0;
      foreach ($values as $key => $value) {

        $color="#". $i+ 990000 ."";
        
       echo "<tr>
          <td width='172' height='45' colspan='2' align='left' style='border-left-width: 1px; border-right: 1px solid #000000; border-top-width: 1px; border-bottom-width: 1px'>$key
          </td>
          <td width='517' height='45' colspan='10' align='left'>
          
          
            <table  height=25 cellpadding=0 cellspacing=0  border=0 width='".$value."%'>
              <tr>
                <td bgcolor=$color></td>
              </tr>
            </table>
            
          </td>
          <td width='152' height='45' colspan='3'>$key: $value</td>
        </tr>";

        $i+=2000;

      }

    ?>

    
                      
  <?php

}

?>
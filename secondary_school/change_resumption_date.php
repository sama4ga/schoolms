<?php
session_start();
require_once("connect.php");
include_once("head.php");

//$msg=array();

$session=$_SESSION['session'];
$term=$_SESSION['term'];

$session_formatted=str_replace("/","_",$session);


if (isset($_POST['submit'])) {
	
	$term_began=$_POST['term_began'];
	$term_ends=$_POST['term_ends'];
	$next_term_begins=$_POST['next_term_begins'];
	$next_term_ends=$_POST['next_term_ends'];

	if ($con->real_query("UPDATE `session_info` SET 
										`term_began`='$term_began',
										`term_ends`='$term_ends',
										`next_term_begins`='$next_term_begins',
										`next_term_ends`='$next_term_ends'
										WHERE `session`='$session'
										AND `term`='$term'")){};

if ($con->real_query("UPDATE `existing_result_sheets` SET 
										`term_began`='$term_began',
										`term_ends`='$term_ends',
										`next_term_begins`='$next_term_begins',
										`next_term_ends`='$next_term_ends'
										WHERE `session`='$session_formatted'
										AND `term`='$term'")){};

	echo "Resumption date successfully updated";

	echo "<a class='btn btn-warning form-control' href='javascript:history.back();'>Back</a>";
	exit();
}



$result=$con->query("SELECT * FROM `session_info` WHERE `session`='$session' AND `term`='$term'");
if ($result->num_rows > 0) {

  while ($rows=$result->fetch_assoc()) {

    $term_began=$rows['term_began'];
    $term_ends=$rows['term_ends'];
    $next_term_begins=$rows['next_term_begins'];
		$next_term_ends=$rows['next_term_ends'];
		
    
  }

}else {
	echo "No data found ";
}

?>

<div class="container form-control">

	<h1 align='center'>Change Resumption Date Portal</h1>

	<form method="POST" action="change_resumption_date.php">

		<div class="form-control">
			<div align='center'>Current Term Details</div>

			<div class="form-group">
				<label>Term began</label>
				<input type="date" name="term_began" value="<?php echo $term_began; ?>" class="form-control" />
			</div>

			<div class="form-group">
				<label>Term Ends</label>
				<input type="date" name="term_ends" value="<?php echo $term_ends; ?>" class="form-control" />
			</div>

		</div>


		<div class="form-control">
			<div align='center'>Next Term Details</div>

			<div class="form-group">
				<label>Next Term begins</label>
				<input type="date" name="next_term_begins" value="<?php echo $next_term_begins; ?>" class="form-control" />
			</div>

			<div class="form-group">
				<label>Next Term Ends</label>
				<input type="date" name="next_term_ends" value="<?php echo $next_term_ends; ?>" class="form-control" />
			</div>

			<div class="form-group" style="display:flex;">
				<input type="submit" name="submit" class="btn btn-success form-control" value="Submit" />
				<input type="submit" name="back" class="btn btn-warning form-control" value="Back" formaction="javascript:history.back();"/>
			</div>

	</div>

	</form>
</div>
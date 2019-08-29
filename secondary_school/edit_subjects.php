<?php
require_once("connect.php");
include_once("head.php");
include_once("sanitize.php");

$class=strtolower($_GET['class']);

if (isset($_POST['add'])) {

  $subject=strtoupper(sanitize($_POST['subject']));
  $type=strtoupper(sanitize($_POST['type']));

  $result=$con->query("INSERT INTO `$class`(`subjects`,`type`) VALUES('$subject','$type')");
  if ($result) {
    echo "<div style='color:red;'>".$subject." successfully added<br/></div>";
  }
  
}elseif (isset($_POST['delete'])) {
  $subject=$_POST['subject'];
  $subject_id=$_POST['subject_id']; 

  $result=$con->query("DELETE FROM `$class` WHERE `subject_id`='$subject_id'");
  if ($result) {
    echo "<div style='color:red;'>".$subject." successfully deleted<br/></div>";
  }


 
  
}

?>



<?php 
  echo "<div class='container'>
          <h2 align='center'>Edit subjects for ".strtoupper($class)."</h2>";
  $result=$con->query("SELECT * FROM `$class`");

  if ($result->num_rows > 0) {
?>

  <table cellspacing='5' cellpadding='5'>
          <tr>
            <th>S/N</th>
            <th>Subject</th>
            <th>Type</th>
            <th></th>
          </tr>

<?php  $count=0;
  while ($subjects=$result->fetch_array()) {
    $subject=$subjects['subjects'];
    $count++;
    echo "<form method='POST' action='edit_subjects.php?class=$class'>
          <tr>
          
            <td>$count</td>

            <td>".strtoupper($subjects['subjects'])."
              <input type='hidden' value='".$subjects['subjects']."' name='subject' id='subject$count'>            
            </td>

            <td>".strtoupper($subjects['type'])."
              <input type='hidden' value='".$subjects['type']."' name='type'>            
            </td>

            <td>
              <input type='hidden' value='".$subjects['subject_id']."' name='subject_id'>
              <input type='submit' class='btn btn-danger btn-sm' value='Delete' name='delete' onclick=\"return delete_subject('subject$count');\">
            </td>

          </tr>
          </form>";
  }
}

  ?>

      </table>
  
      <div class='form-control'>

        <h3>New Subject Details<h3>

        <table>
        <form method='POST' action="edit_subjects.php?class=<?php echo $class ?>">
        <tr>

          <td>
            <input type='text' class='form-control' name='subject' id='add_subject_div' placeholder='Enter new subject here'>
          </td>

        </tr>

        <tr>
          <td>
            <select class='form-control' name='type'>
              <option value='default' selected>Choose subject type here</option>
              <option value='general'>General</option>
              <option value='science'>Science</option>
              <option value='arts'>Arts</option>
              <option value='commercial'>Commercial</option>
              <option value='art & commercial'>Art and Commercial</option>
              <option value='art & science'>Art and Science</option>
              <option value='commercial & science'>Commercial and Science</option>
            </select>
          </td>

        </tr>

        <tr>

          <td>
            <input type='submit' class='btn btn-success form-control btn-sm' value='Add' name='add' onclick="return add_subject('add_subject_div');">
          </td>

        </tr>
        </form>

      </table>
      
      </div>
    </div>


<script>

function delete_subject(subject_div){
  var subject=document.getElementById(subject_div).value;
  var result=confirm("Are you sure you want to delete "+ subject +"?");
  if(result){
   return true;
  }else{     
     return false;
  }
}

function add_subject(subject_div){
  var subject=document.getElementById(subject_div).value;
  var result=confirm("Are you sure you want to add "+ subject +"?");
  if(result){
   return true;
  }else{     
     return false;
  }
}

</script>
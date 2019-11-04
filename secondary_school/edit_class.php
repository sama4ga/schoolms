<?php
require_once("connect.php");
include_once("head.php");
include_once("sanitize.php");


if (isset($_POST['add'])) {

  $class=strtoupper(sanitize($_POST['class']));

  $result=$con->query("INSERT INTO `class`(`class`) VALUES('$class')");
  if ($result) {
    echo "<div style='color:red;'>".$class." successfully added<br/></div>";
  }
  
}elseif (isset($_POST['delete'])) {
  $class=$_POST['class'];
  $class_id=$_POST['class_id']; 

  $result=$con->query("DELETE FROM `class` WHERE `class_id`='$class_id';");
  if ($result) {
    echo "<div style='color:red;'>".$class." successfully deleted<br/></div>";
  }


 
  
}

?>



<?php 
  echo "<div class='container'>
          <h2 align='center'>Edit subjects for ".strtoupper($class)."</h2>";
  $result=$con->query("SELECT * FROM `class`");

  if ($result->num_rows > 0) {
?>

  <table cellspacing='5' cellpadding='5'>
          <tr>
            <th>S/N</th>
            <th>Class</th>
            <th></th>
          </tr>

<?php  $count=0;
  while ($row=$result->fetch_array()) {
    $count++;
    echo "<form method='POST' action='edit_subjects.php?class=$class'>
          <tr>
          
            <td>$count</td>

            <td>".strtoupper($row['class'])."
              <input type='hidden' value='".$row['class']."' name='subject' id='class$count'>            
            </td>

            <td>
              <input type='hidden' value='".$row['class_id']."' name='class_id'>
              <input type='submit' class='btn btn-danger btn-sm' value='Delete' name='delete' onclick=\"return delete_class('class$count');\">
            </td>

          </tr>
          </form>";
  }
}

  ?>

      </table>
  
      <div class='form-control'>

        <h3>New Class Details<h3>

        <table>
        <form method='POST' action="edit_class.php">
        <tr>

          <td>
            <input type='text' class='form-control' name='class' id='add_class_div' placeholder='Enter new Class here'>
          </td>

        </tr>

        <tr>

          <td>
            <input type='submit' class='btn btn-success form-control btn-sm' value='Add' name='add' onclick="return add_class('add_class_div');">
          </td>

        </tr>
        </form>

      </table>
      
      </div>
    </div>


<script>

function delete_class(subject_div){
  var subject=document.getElementById(subject_div).value;
  var result=confirm("Are you sure you want to delete "+ subject +"?");
  if(result){
   return true;
  }else{     
     return false;
  }
}

function add_class(subject_div){
  var subject=document.getElementById(subject_div).value;
  var result=confirm("Are you sure you want to add "+ subject +"?");
  if(result){
   return true;
  }else{     
     return false;
  }
}

</script>
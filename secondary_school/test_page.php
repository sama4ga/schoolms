<?php
/* require_once("connect.php");
$test_id = $_GET['test_id'];
$subject = "mathematics";


$result = $con->query("SELECT * FROM `tests` WHERE `test_id`='$test_id';");
if($result){
  if($result->num_rows == 1){
    while($row = $result->fetch_assoc()){
      $active = $row['active'];
      $show_hint = $row['show_hint'];
      $timed = $row['timed'];
      $duration = $row['duration'];
      $test_name = $row['test_name'];
    }

    if($active == 'false'){
      echo("
         <div class='info'>
            Requested test is no longer active
         </div>
        ");
      exit();
    }
  }else{
    echo("
         <div class='info'>
            Requested test not found
         </div>
        ");
    exit();
  }
}else{
  echo("
       <div class='error'>
         An error occurred while fetching test: ".$con->error."
       </div>
       ");
  exit();
}


$subj = preg_replace("[^A-za-z]","_",$subject);
$tbl_name = $subj."_questions";
$result = $con->query("SELECT c.`comp_id`,c.`passage`,c.`instruction`,c.`graph`,t.`test_id`,t.`question`,t.`option_a`,t.`option_b`,t.`option_c`,t.`option_d`,t.`answer`,t.`hint`,t.`ques_id`
                      FROM `$tbl_name` t
                      LEFT JOIN `comprehension_passages` c
                      ON t.`comp_id`=t.`comp_id`
                      WHERE t.`test_id`='$test_id';");
if ($result) {
  $num_questions = $result->num_rows;
  if ($num_questions > 0) {
    while($row = $result->fetch_assoc()){
      $questions[] = $row;
    }
  }else {
    echo("
         <div class='info'>
           No questions found for selected test
         </div>
        ");
    exit();
  }
} else {
  echo("
       <div class='error'>
         An error occurred while fetching questions: ".$con->error."
       </div>
       ");
  exit();
}

?>

<!Doctype HTML>
<html>
  <head>
    <link rel="stylesheet" href="styles/main.css" />

  </head>
  <body>

    <div>
      <h1 align="center">Test Page</h1>

      <div>
        <h2><?php echo($test_name); ?> </h2>
      </div>

      <div align="right" id="time-left" class="timer">
        00 : 00 : 00
      </div>

      <div>
        <form method="POST" action="" id="frmTest" name="frmTest" >   <!-- onLoad="JavaScript:CheckRefresh()"; -->

          <input type="hidden" name="visited" value="" />

          <div id="div-passage">
            <label for="lblPassage"><b>Passage:</b></label>
            <textarea name="lblPassage" id="lblPassage" rows="10" cols="80" disabled></textarea>
          </div>
          <div id="div-graph">
            <label for="picGraph"><b>Graph:</b></label>
            <img src="" width="80%" height="200px" id="picGraph" name="picGraph"/>
          </div>
          <div id="div-instruction">
            <label for="lblInstruction"><b>Instruction:</b></label>
            <label name="lblInstruction" id="lblInstruction"></label>
          </div>
          <div id="div-question">
            <label for="lblQuestion" id="lblQuestionNo" style="font-weight:bold;">Question</label>
            <label name="lblQuestion" id="lblQuestion"></label>
          </div>
          <div id="div-options">
            <input type="radio" name="rdOption" id="rdOptionA" onchange="Score(this.value);" value="A"/><span><label for="rdOptionA" id="optionA"></label></span>
          </div>
          <div>
            <input type="radio" name="rdOption" id="rdOptionB" onchange="Score(this.value);"  value="B"/><span><label for="rdOptionB" id="optionB"></label></span>
          </div>
          <div>
            <input type="radio" name="rdOption" id="rdOptionC" onchange="Score(this.value);" value="C"/><span><label for="rdOptionC" id="optionC"></label></span>
          </div>
          <div>
            <input type="radio" name="rdOption" id="rdOptionD" onchange="Score(this.value);" value="D"/><span><label for="rdOptionD" id="optionD"></label></span>
          </div>
          <div id="div-hint">
            <label for="lblHint"><b>Hint</b></label>
            <label name="lblHint" id="lblHint"></label>
          </div>
        </form>
      </div>

      <div style="display:flex; margin:30px 0;">
        <div class="pagination-wrapper">
          <ul class="pagination">
            <li>
              <a href="javascript:GetPreviousQuestion();" title="Previous">&lt;&lt;</a>
            </li>
          </ul>
        </div>
        <div class="pagination-wrapper">
          <ul class="pagination">
<?php
          for ($i = 1; $i <= count($questions); $i++) {
            echo("
                  <li><a href='javascript:GetDirectQuestion($i);' id='$i'>".$i."</a></li>
                ");
          }
?>
          </ul>
        </div>
        <div class="pagination-wrapper">
          <ul class="pagination">
            <li>
              <a href="javascript:GetNextQuestion();" title="Next">&gt;&gt;</a>
            </li>
          </ul>
        </div>
      </div>

      <div>
        <input type="button" onclick="Submit()" value="submit" name="btnSubmit" />
      </div>
    </div>

    <script src="scripts/main.js"></script>
    <script>
      var chosen_options = {};
      var current_question = {};
      var current_question_no = 0;
      var questions = <?php echo json_encode($questions) ?>;
      var ques_id = 0;
      var answer = "";
      var scores = {};

      GetQuestions(current_question_no);

      function Score(chosen_option){
        document.getElementById((current_question_no + 1).toString()).style = "background-color:#00ff00";
        chosen_options[ques_id.toString()] = chosen_option;
        if(answer == chosen_option){
          scores[ques_id.toString()] = 1;
        }else{
          scores[ques_id.toString()] = 0;
        }
      }

      function GetQuestions(question_no){
        var current_question = questions[question_no];

        var passage = current_question['passage'];
        if(passage !== null){
          document.getElementById("lblPassage").innerHTML = passage;
          document.getElementById("div-passage").style.display = "block";
        }else{
          document.getElementById("div-passage"). style.display = "none";
        }

        var instruction = current_question['instruction'];
        if(instruction !== null){
          document.getElementById("lblInstruction").innerHTML = instruction;
          document.getElementById("div-instruction").style.display = "block";
        }else{
          document.getElementById("div-instruction").style.display = "none";
        }

        var graph = current_question['graph'];
        if(graph !== null){
          document.getElementById("picGraph").src = graph;
          document.getElementById("div-graph").style.display = "block";
        }else{
          document.getElementById("div-graph").style.display = "none";
        }

        var question = current_question['question'];
        document.getElementById("lblQuestion").innerHTML = question;

        document.getElementById("lblQuestionNo").innerHTML = "Question " + (question_no + 1) + ":";

        var option_a = current_question['option_a'];
        document.getElementById("optionA").innerHTML = option_a;

        var option_b = current_question['option_b'];
        document.getElementById("optionB").innerHTML = option_b;

        var option_c = current_question['option_c'];
        document.getElementById("optionC").innerHTML = option_c;

        var option_d = current_question['option_d'];
        document.getElementById("optionD").innerHTML = option_d;

        answer = current_question['answer'];

        show_hint = "<?php echo($show_hint); ?>" ;
        var hint = current_question['hint'];
        document.getElementById("lblHint").innerHTML = hint;
        if(show_hint !== "false"){
          document.getElementById("div-hint").style.display = "block";
        }else{
          document.getElementById("div-hint").style.display = "none";
        }

        ques_id = current_question['ques_id'];
        var comp_id = current_question['comp_id'];
        var test_id = current_question['test_id'];

        ClearSelection();
        CheckIfAnswered(ques_id);
      }

      function GetNextQuestion(){
        current_question_no++;
        GetQuestions(current_question_no);
        document.getElementById((current_question_no + 1).toString()).focus(); //style = "background-color:#4affcc";
      }

      function GetPreviousQuestion(){
        current_question_no--;
        GetQuestions(current_question_no);
        document.getElementById((current_question_no + 1).toString()).focus(); 
      }

      function GetDirectQuestion(question_no){
        current_question_no = question_no -1;
        GetQuestions(current_question_no);
      }

      function ClearSelection(){
        document.getElementsByName("rdOption").forEach(option =>{
          option.checked = false;
        });
      }

      function CheckIfAnswered(ques_id){
       //alert(Object.keys(chosen_options).findIndex("1"));
        if(Object.keys(chosen_options).indexOf(ques_id.toString()) > -1){
          option = chosen_options[ques_id.toString()];
          document.getElementById("rdOption"+option).checked = true;
        }
      }

      function Submit(){
        var total_score = 0;
        var ques_count = questions.length;
        for(var ques_id in scores){
          if(scores[ques_id] !== 0){
            total_score++;
          }
        }alert(total_score + " / " + ques_count);
      }

      timed = "<?php echo($timed); ?>";
      if(timed == "true"){
        interval = "<?php echo($duration); ?>"; //interval = 1;
        document.getElementById("time-left").style.display = "block";

        seconds = 0, minutes = 0, hours = 0;

        interval = parseInt(interval) * 60;  //alert(interval);
        my_interval = setInterval(CheckTimeLeft,1000);

        //submit_test = setTimeout(Submit, interval);
      }

      function CheckTimeLeft(){

        interval--;

        if(interval == 0){
          clearInterval(my_interval);
          Submit();
        }

        hours = Math.floor(interval / 3600);
        minutes = Math.floor((interval - (hours * 60)) / 60);
        seconds = interval - (hours * 3600) - (minutes * 60);

        hrs = hours > 9 ? hours : "0" + hours;

        mins = minutes > 9 ? minutes : "0" + minutes;

        secs = seconds > 9 ? seconds : "0" + seconds;

        document.getElementById("time-left").innerHTML = hrs + " : " + mins + " : " + secs;

      }
*/
?>
<script>
      window.addEventListener('beforeunload', function (e) {
        //var answer = confirm("This action will submit the test.\n\nSure to continue?");
        //if(answer){Submit();}
       // Cancel the event
        e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
       // Chrome requires returnValue to be set
        e.returnValue = '';
       // the absence of a returnValue property on the event will guarantee the browser unload happens
        //delete e['returnValue'];
      });
      window.addEventListener('onunload', function (e) {alert("Ending");
        //Submit();
      });

      function checkRefresh() {
        if (document.forms['frmTest'].visited.value == "") {
          // This is a fresh page load
          document.frmTest.visited.value = "1";
        } else {alert("refreshed");
          //Submit();
        }
      }

      function navigationType(){

        var result;
        var p;

        if (window.performance.navigation) {
            result=window.performance.navigation;
            if (result==255){result=4} // 4 is my invention!
        }

        if (window.performance.getEntriesByType("navigation")){
           p=window.performance.getEntriesByType("navigation")[0].type;

           if (p=='navigate'){result=0}
           if (p=='reload'){result=1}
           if (p=='back_forward'){result=2}
           if (p=='prerender'){result=3} //3 is my invention!
        }
        return result;
      }

      // var type = navigationType();//alert(type);
      // if(type !== 0){
      //   if(confirm("This action will automatically submit the test\n\nSure to continue?")){
      //     Submit();
      //   }
      // }


    </script>
  </body>
</html>
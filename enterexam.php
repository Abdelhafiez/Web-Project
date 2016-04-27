<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization('student');
connect();

?>

<?php

$exam_name = $_GET['exam_name'];
$exam_id = $_GET['exam_id'];

?>

<?php

if (isset($_POST['submit_exam'])){
	$correct_answers = 0;
	$total_questions = 0;
	$removed = array();
	foreach($_SESSION as $key => $value){
		$arr = explode('_',$key);
		if ($arr[0] != 'question')continue;
		$id = $arr[1];
		$post_variable = 'radio_'.$id;
		$total_questions++;
		if (isset($_POST[$post_variable]) && $value == $_POST[$post_variable])
			$correct_answers++;
		$removed[] = $key;
	}
	foreach($removed as $key)
		unset($_SESSION[$key]);
	$result = ($correct_answers/$total_questions)*100;
	add_result($result,$_SESSION['user_id'],$exam_id);
	header("Location: exams.php");
	echo "Result: ".$result."%<br/>\n";
}

?>

<html>
	<head>
		<title> Enter Exam </title>
	</head>
	<body>
		<h3><?php echo $exam_name;?></h3>
		<hr/>
		<form name = "exam_form" method = "post">
		<h3>
			<?php
				$questions = get_exam_questions($exam_id);
				foreach($questions as $i => $question){
					echo ($i+1).") ";
					echo $question['Question']."<p/>\n";
					$answer_tags = array('CorrectAnswer','Distractor1','Distractor2','Distractor3');
					shuffle($answer_tags);
					foreach($answer_tags as $j => $answer_tag){
						echo "<input type = 'radio' name = 'radio_".$question['ID']."' value = '".$j."'> ".$question[$answer_tag]
						."<br/>\n";
						if ($answer_tag == 'CorrectAnswer')
							$_SESSION['question_'.$question['ID']."_correctindex"] = $j;
					}
					echo "<br/><br/>\n";
				}
			?>
			</h3>
			<input type = "submit" name = "submit_exam" value = "Submit">
		</form>
		<a href = "exams.php">Back to Exams</a>
		
	</body>
</html>

<?php include("footer.php");?>
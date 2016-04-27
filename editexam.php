<?php

include("designtemplate.php");
include("database.php");
include("functions.php");
include("validation.php");
verify_authorization("admin");

connect();

?>

<?php

if (isset($_POST['delete_exam'])){
	delete_exam($_POST['exam_id']);
	header("Location: examinations.php");
}

?>

<?php


$exam_name = $_GET['exam_name'];
$exam_id = $_GET['exam_id'];
$in_exam = array();
$questions = get_questions();
$exam_questions = get_exam_questions($exam_id);

foreach($exam_questions as $i => $quest)
	$in_exam[$quest['ID']] = true;

foreach($questions as $i => $quest)
	if (!isset($in_exam[$quest['ID']]))
		$in_exam[$quest['ID']] = false;


?>


<?php


if (isset($_POST['submit_exam'])){
	clear_exam($exam_id);
	foreach($_POST as $key => $value){
		$arr = explode("_",$key);
		if ($arr[0] == 'checkbox'){
			$question_id = $arr[1];
			add_question_to_exam($question_id,$exam_id);
		}
	}
	header("Location: ".pageURL());
}



?>


<html>
	<head>
		<title>Edit Exam</title>
	</head>
	<body>
		
		<h3><?php echo $exam_name;?></h3>
		<hr/>
			<form name = "question_form" method = "post">
			<?php
				foreach($questions as $i => $question){
					$val = 'unchecked';
					if ($in_exam[$question['ID']])
						$val = 'checked';
					echo "<input type = 'checkbox' name = 'checkbox_".$question['ID']."' value = 'question_".$question['ID']."' ".$val.">";
					echo " &nbsp | &nbsp";
					echo $question['Question'];
					echo "<br/>\n";
				}
			?>
			<input type = "submit" name = "submit_exam" value = "Update Exam Questions">
			</form>
		<hr/>
		<form method = "post">
			<input type = "hidden" name = "exam_id" value = "<?php echo $exam_id; ?>">
			<input type = "submit" name = "delete_exam" value = "Delete Exam">
		</form>
		<a href = "examinations.php">Back to Examination</a>
	</body>
</html>

<?php include("footer.php");?>
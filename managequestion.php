<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization("admin");

function write_question_details()
{
	$question = "";
	$correct = "";
	$distractor1 = "";
	$distractor2 = "";
	$distractor3 = "";
	$type = "Add";
	$url = "managequestion.php";
	
	if (isset($_GET['question_id'])){
		connect();
		$id = $_GET['question_id'];
		$question_record = get_question($id);
		$question = $question_record['Question'];
		$correct = $question_record['CorrectAnswer'];
		$distractor1 = $question_record['Distractor1'];
		$distractor2 = $question_record['Distractor2'];
		$distractor3 = $question_record['Distractor3'];
		$type = "Edit";
		$url.= "?question_id=".$id;
	}
	
	echo "<form name = 'add_question_form' method = 'post' action = '".$url."'>
			Question <br/>
			<textarea rows = '4' cols = '50' name = 'question'>".$question."</textarea>
			<br/>
			Correct Answer <br/>
			<textarea cols = '50' name = 'correct'>".$correct."</textarea>
			<br/>
			Distractor 1 <br/>
			<textarea cols = '50' name = 'distractor1'>".$distractor1."</textarea>
			<br/>
			Distractor 2 <br/>
			<textarea cols = '50' name = 'distractor2'>".$distractor2."</textarea>
			<br/>
			Distractor 3 <br/>
			<textarea cols = '50' name = 'distractor3'>".$distractor3."</textarea>
			<br/>
			<input type = 'submit' name = 'submit_question' value = '".$type."'>
		</form>
		";
	
}


?>

<?php

if (isset($_POST['submit_question'])){
	connect();
	$question = $_POST['question'];
	$correct = $_POST['correct'];
	$distractor1 = $_POST['distractor1'];
	$distractor2 = $_POST['distractor2'];
	$distractor3 = $_POST['distractor3'];
	if ($_POST['submit_question'] == 'Add'){
		add_question($question,$correct,$distractor1,$distractor2,$distractor3);
		header("Location: questionbank.php");
	}
	else 
		edit_question($_GET['question_id'],$question,$correct,$distractor1,$distractor2,$distractor3);
	
}

?>

<html>
	<head>
		<title>
			Add Question
		</title>
	</head>
	<body>
		<?php
			write_question_details();
			
		?>
		
		<a href = "questionbank.php">Back to Question Bank</a>
	</body>
</html>
<?php include("footer.php");?>
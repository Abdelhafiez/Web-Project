<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization("admin");
connect();

?>

<?php

if (isset($_POST['deletequestions'])){
	foreach($_POST as $key => $value){
		$arr = explode("_",$key);
		if ($arr[0] == 'checkbox')
			delete_question($arr[1]);
	}
}

?>

<html>
	<head>
		<title>
			Question Bank
		</title>
	</head>
	
	<body>
	
		<?php 
			connect(); 
			$questions = get_questions();
			
		?>
		
		<form name = "question_form" method = "post" action = "questionbank.php">
			<?php
				foreach($questions as $i => $question){
					echo "<input type = 'checkbox' name = 'checkbox_".$question['ID']."' value = 'question_".$question['ID']."'>";
					echo " &nbsp | &nbsp";
					echo "<a href = 'managequestion.php?question_id=".$question['ID']."'>edit</a>";
					echo " &nbsp | &nbsp";
					echo $question['Question'];
					echo "<br/>\n";
				}
			?>
			<br/>
			<input type = "submit" name = "deletequestions" value = "Delete Question(s)">
		</form>
		<br/><br/>
		<form name = "add_question_form" method = "post" action = "managequestion.php">
			<input type = "submit" name = "addquestion" value = "Add Question">
		</form>
		
		
	</body>
</html>




<?php include("footer.php");?>
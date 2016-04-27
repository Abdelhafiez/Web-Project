<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization("admin");

connect();

?>

<?php

if (isset($_POST['add_exam'])){
	$exam_name = $_POST['exam_name'];
	add_exam($exam_name);
}

?>

<html>
	<head>
		<title>	
			Examinations
		</title>
	</head>
	<body>
		<h3>Examinations</h3>
		<hr/>
			<?php
				$exams = get_exams();
				foreach($exams as $i => $exam){
					echo ($i+1).") ";
					echo "<a href = 'editexam.php?exam_id=".$exam['ID']."&exam_name=".$exam['Name']."'>".$exam['Name']."</a>";
					echo "<br/>\n";
				}
			?>
		<hr/>
			
		<form method = "post">
			<input type = "text" name = "exam_name" value = "New Exam Name">
			<input type = "submit" name = "add_exam" value = "Add Exam">
		</form>
			
			
		
		
		
	</body>
</html>

<?php include("footer.php");?>
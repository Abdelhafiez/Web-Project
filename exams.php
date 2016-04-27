<?php

include("designtemplate.php");
include("validation.php");
include("database.php");
verify_authorization("student");

connect();

?>


<html>
	<head>
		<title>
		Take Exams
		</title>
	</head>
	<body>
		<h3>
		<?php
			$exams = get_exams();
			foreach($exams as $i => $exam){
				echo ($i+1).") ";
				echo "<a href = 'enterexam.php?exam_id=".$exam['ID']."&exam_name=".$exam['Name']."'>".$exam['Name']."</a>\n";
				echo "&nbsp";
				echo "<a href = 'myresults.php?exam_id=".$exam['ID']."&exam_name=".$exam['Name']."'>(results)</a>\n";
				echo "<br/>\n";
				
			}
		
		?>
		</h3>
		
	</body>
</html>

<?php include("footer.php");?>
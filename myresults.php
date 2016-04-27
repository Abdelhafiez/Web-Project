<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization('student');
connect();

?>

<?php

$exam_id = $_GET['exam_id'];
$exam_name = $_GET['exam_name'];
$results = get_exam_results($exam_id,$_SESSION['user_id']);

?>

<html>
	<head>
		<title>
			My Results | <?php echo $exam_name;?>
		</title>
	</head>
	<body>
		<h2><?php echo $exam_name;?>'s Results</h2>
		<hr/>
		<h3>
		<?php
			foreach($results as $i => $result){
				echo ($i+1)." )&nbsp";
				echo $result['Result']."%&nbsp(".$result['Date'].")<br/>\n";
			}
		?>
		<h3/>
		<br/><br/>
		<a href = "exams.php">Back to Exams</a>
	</body>
</html>

<?php include("footer.php");?>
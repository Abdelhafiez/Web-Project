<?php


include("designtemplate.php");
include("database.php");
include("validation.php");
verify_authorization("admin");

?>



<html>
	<head>
		<title>
			Members
		</title>
	</head>
	<body>
		<?php connect(); ?>
		<h3>Administrators</h3>
		<hr/>
		<?php
			$admins = select_users('admin');
			foreach($admins as $key => $value)
				echo "- ".$value."<br/>";
		?>
		<br/><br/>
		<h3>Students</h3>
		<hr/>
		<?php
			$students = select_users('student');
			foreach($students as $key => $value)
				echo "- ".$value."<br/>";
		?>
		<hr/>
		
		
	
	</body>
</html>

<?php include("footer.php");?>
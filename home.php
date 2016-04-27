<?php

include("designtemplate.php");

?>

<html>
<head><title>Home</title></head>
<body>
<h3>
<?php
				
			
				if (isset($_SESSION['login'])){
					if ($_SESSION['type'] == 'admin'){
						echo "&nbsp <a href = 'members.php'> Members</a><br/><br/>\n";
						echo "&nbsp <a href = 'examinations.php'>Examinations</a><br/><br/>\n";
						echo "&nbsp <a href = 'questionbank.php'>Question Bank</a><br/><br/>\n";
						echo "&nbsp <a href = 'requests.php'>Administrators Request Queue</a><br/><br/>\n";
					}
					else {
						echo "<a href = 'exams.php'> Exams</a>\n";
					}
				}
			
			?>

</h3>

</body>

</html>

<?php include("footer.php");?>
<?php

include("designtemplate.php");
include("database.php");
include("validation.php");
connect();
verify_authorization('admin');

?>

<?php

if (isset($_POST['accept_button'])){
	remove_user_from_requests($_REQUEST['username']);
}
if (isset($_POST['reject_button'])){
	remove_user_from_requests($_REQUEST['username']);
	remove_user($_REQUEST['username']);
}


?>

<html>
	<head>
		<title>Requests</title>
	</head>
	
	
	<body>
		<form name = "requests_form" method = "post">
		
		<?php 
			$result = mysql_query("select * from requests");
			$record = mysql_fetch_assoc($result);
			if ($record){
				echo "<h3>&nbsp;Accept ".$record['Username']."?<h3/><br/><br/>\n";
				echo "&nbsp;<input type = 'submit' name = 'accept_button' value = 'Yes'><br/>\n";
				echo "&nbsp;<input type = 'submit' name = 'reject_button' value = 'No'><br/>\n";
				echo "<input type = 'hidden' name = 'username' value = '".$record['Username']."'>";
			}
			else echo "<h3>No Pending Requests<h3/><br/><br/>"
		?>
		</form>
		
	</body>
</html>

<?php include("footer.php");?>
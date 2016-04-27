<?php 

include("designtemplate.php");
include("database.php");
include("validation.php");
verify_login();
connect();

?>
<?php

$user_id = $_SESSION['user_id'];

?>

<?php

if (isset($_POST['submit_edits'])){
				$firstname = $_POST['textbox_FirstName'];
				$lastname = $_POST['textbox_LastName'];
				$address = $_POST['textbox_Address'];
				$gender = $_POST['gender'];
				$mobile = $_POST['textbox_Mobile'];
				
				$firstname = htmlspecialchars($firstname);
				$lastname = htmlspecialchars($lastname);
				$address = htmlspecialchars($address);
				
				if (!valid_name($firstname))
					echo "Invalid First name<br/>";
				else if (!valid_name($lastname))
					echo "Invalid Last name<br/>";
				else if (!valid_address($address))
					echo "Invalid Address name<br/>";
				else if (!ctype_digit($mobile))
					echo "Invalid Mobile Number<br/>";
				else {
						update_user($user_id,'FirstName',$firstname);
						update_user($user_id,'LastName',$lastname);
						update_user($user_id,'Address',$address);
						update_user($user_id,'Gender',$gender);
						update_user($user_id,'Mobile',$mobile);
				}
				
}

?>

<?php

$student = get_user_details($_SESSION['user_id']);
$fakes = array();
$fakes['Password'] = true;
$fakes['ID'] = true;
$fakes['AccountType'] = true;
$fakes['Username'] = true;
$fakes['Email'] = true;


?>


<html>
	<head>
		<title>Edit Profile</title>
	</head>
	<body>
		<form name = "editprofile_form" method = "post">
			<?php
				foreach($student as $key => $value){
					if (isset($fakes[$key]))continue;
					echo "<p/>\n";
					echo $key."&nbsp&nbsp";
					if ($key == 'Gender'){
						if ($value == 'male'){
							$male_check = 'checked';
							$female_check = 'unchecked';
						}
						else {
							$male_check = 'unchecked';
							$female_check = 'checked';
						}
						echo "<input type = 'radio' name = 'gender' value = 'male' ".$male_check."> Male\n";
						echo "&nbsp | &nbsp\n";
						echo "<input type = 'radio' name = 'gender' value = 'female' ".$female_check."> Female\n";
						echo "<br/><br/>\n";
					}
					/*else if ($key == 'AccountType'){
						if ($value == 'admin'){
							$student_check = 'unchecked';
							$admin_check = 'checked';
						}
						else {
							$student_check = 'checked';
							$admin_check = 'unchecked';
						}	
						echo "<input type = 'radio' name = 'account_type' value = 'student' ".$student_check."> Student\n";
						echo "&nbsp | &nbsp\n";
						echo "<input type = 'radio' name = 'account_type' value = 'admin' ".$admin_check."> Administrator\n";
						echo "<br/>\n";
					}*/
					else echo "<input type = 'text' name = '"."textbox_".$key."' value = '".$value."'><br/><br/>\n";
					
				}
			?>
			<p/>
			<input type = 'submit' name = 'submit_edits' value = 'Edit'>
		</form>
	</body>
</html>

<?php include("footer.php");?>
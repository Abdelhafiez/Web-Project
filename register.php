<?php

include("designtemplate.php");
include("validation.php");

function is_element_found($element_type,$element)
{
	$query = "select `ID` from users where ".$element_type."= '".$element."'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	if ($row)
		return true;
	return false;
}
function insert_user($firstname,$lastname,$address,$gender,$username,$password,$email,$account_type,$mobile)
{
	$query = "insert into users (`FirstName`, `LastName`, `Address`, `Gender`, `Username`, `Password`, `Email`, `AccountType` , `Mobile`)
		values ("."'".$firstname."'".","."'".$lastname."'".","."'".$address."'".","."'".$gender."'".","."'".$username."'".","
		."'".$password."'".","."'".$email."'".","."'".$account_type."'".",'".$mobile."')";
	mysql_query($query);
	
	if ($account_type == 'admin'){
		$query = "insert into requests (Username) values ('".$username."')";
		mysql_query($query);
	}
}

?>

<?php	

	$firstname = "";
	$lastname = "";
	$address = "";
	$male_gender = "unchecked";
	$female_gender = "unchecked";
	$gender = "";
	
	$username = "";
	$password = "";
	$confirm_password = "";
	$email = "";
	$admin_type = "unchecked";
	$student_type = "unchecked";
	$account_type = "";
	$mobile = "";
	
	if (isset($_POST['register']))
	{
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		if (isset($_POST['gender'])){
			$gender = $_POST['gender'];
			if ($gender == 'male')
				$male_gender = "checked";
			else $female_gender = "checked";
		}
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$email = $_POST['email'];
		if (isset($_POST['account_type'])){
			$account_type = $_POST['account_type'];
			if ($account_type == 'admin')
				$admin_type = "checked";
			else $student_type = "checked";
		}
		$mobile = $_POST['mobile'];
	}
?>




<html>
	<head>
		<title>Register</title>
		
	</head>
	<body>
		<?php
			if (isset($_POST['register'])){
				
				$firstname = htmlspecialchars($firstname);
				$lastname = htmlspecialchars($lastname);
				$address = htmlspecialchars($address);
				
				
				if (!valid_name($firstname))
					echo "Invalid First name<br/>";
				else if (!valid_name($lastname))
					echo "Invalid Last name<br/>";
				else if (!valid_address($address))
					echo "Invalid Address name<br/>";
				else if ($male_gender == 'unchecked' && $female_gender == 'unchecked')
					echo "Please choose your gender<br/>";
				else if (!valid_username_and_password($username))
					echo "Invalid Username<br/>";
				else if (!valid_username_and_password($password))
					echo "Invalid Password<br/>";
				else if ($password != $confirm_password)
					echo "Write the same password ya gameel<br/>";
				else if (!valid_email($email))
					echo "Invalid Email Address<br/>";
				else if ($admin_type == 'unchecked' && $student_type == 'unchecked')
					echo "Please choose your Account Type<br/>";
				else if (!ctype_digit($mobile))
					echo "Invalid Mobile Number<br/>";
				else {
					// Kollo zay el foll .. 
					// Insert in Database ..
					$db_handle = mysql_connect("localhost","root","");
					$db_found = mysql_select_db("7amada",$db_handle);
					if ($db_found){
						if (is_element_found("username",$username))
							echo $username." already available<br/>";
						else if (is_element_found("email",$email))
							echo $email." already available<br/>";
						else {
							$password = md5($password);
							insert_user($firstname,$lastname,$address,$gender,$username,$password,$email,$account_type,$mobile);
							header("Location: home.php");
						}
					}
					else echo "Did not found 7amada Database<br/>";
					
					
					
				}
			}
		?>
	
		<form name = "register" method = "post" action = "register.php" style = "line-height:20px">
	
				First Name <input type = "text" name = "firstname" value = "<?php echo $firstname; ?>" > <br/><br/>
				Last Name <input type = "text" name = "lastname" value = "<?php echo $lastname; ?>"> <br/><br/>
				Address <input type = "text" name = "address" value = "<?php echo $address; ?>" > <br/><br/>
				Gender
				<input type = "radio" name = "gender" value = "male"  <?php echo $male_gender; ?>> Male
				|
				<input type = "radio" name = "gender" value = "female" <?php echo $female_gender; ?>> Female 
				<br/><br/>
			
			
			<hr/>
			
				Username <input type = "text" name = "username" value = "<?php echo $username; ?>"> <br/><br/>
				Password <input type = "password" name = "password" value = "<?php echo $password; ?>"> <br/><br/>
				Confirm Password <input type = "password" name = "confirm_password" value = "<?php echo $confirm_password; ?>"> <br/><br/>
				Email Address <input type = "text" name = "email" value = "<?php echo $email; ?>"> <br/><br/>
				Mobile Number <input type = "text" name = "mobile" value = "<?php echo $mobile;?>"> <br/><br/>
				Account Type
				<input type = "radio" name = "account_type" value = "admin" <?php echo $admin_type; ?>> Administrator
				|
				<input type = "radio" name = "account_type" value = "student" <?php echo $student_type; ?>> Student 
				<br/><br/>
				<input type = "submit" name = "register" value = "Register">
				<br/><br/>

			
		</form>
		
	
	</body>
</html>

<?php include("footer.php");?>

<?php

include("designtemplate.php");
include("validation.php");
verify_login();

if(isset($_SESSION['login'] )){
    $usname =  $_SESSION['user'];
    $type = $_SESSION['type'];
    
	$username = "root";
    $password = "";
    $database = "7amada";
    $server = "localhost";
    
	$db_handle = mysql_connect($server,$username,$password);	
	$db_found = mysql_select_db($database,$db_handle);

	if($db_found)
	{
	    //echo "7amada"."<br/>";
	    $sql = "select * from users where username = '".$usname."'";
		$result = mysql_query($sql);
		
		echo "<h3>";
		while($record = mysql_fetch_assoc($result))
		{
		     foreach($record as $key => $value )
			 { 
			     if($key != "Password" && $key != "ID")
					echo $key." : ". $value ."<br/><br/>";
			 }
		}
		echo "</h3>";
	}else
	{
	    echo "Database Not Found" . "<br/>";
	}
	mysql_close($db_handle);
}
?>
<html>
<head></head>
<body>
</body>
</html>
<?php include("footer.php");?>
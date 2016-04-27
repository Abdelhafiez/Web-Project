<?php

include("database.php");
include("validation.php");
connect();


function login($username,$type)
{
	//session_start(); Already started in validation
	$_SESSION['login'] = '1';
	$_SESSION['user'] = $username;
	$_SESSION['user_id'] = get_id_from_username($username);
	$_SESSION['type'] = $type;
}

?>


<?php
	
	session_start();
	$in_queue = false;
	$invalid = false;
	$username = "";
	$password = "";
	if (isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!valid_username_and_password($username) || !valid_username_and_password($password))
			$invalid = true;
		else {
			$db_handle = mysql_connect("localhost","root","");
			if (mysql_select_db("7amada",$db_handle)){
				$password = md5($password);
				$query = "select * from users where username = '".$username."' and password = '".$password."'";
				$result = mysql_query($query);
				if ($row = mysql_fetch_assoc($result)){
					if (in_request_queue($username))
						$in_queue = true;
					else {
						login($username,$row['AccountType']);
						header("Location: home.php");
					}
					/*foreach($_SESSION as $key => $value)
					echo $key . "=>" . $value . "<br/>";*/
				}
				else $invalid = true;
			}
			
		}
		
	}

?>



<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.1.0.59861 -->
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="style.responsive.css" media="all">


    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <script src="script.responsive.js"></script>


<style>.art-content .art-postcontent-0 .layout-item-0 { padding-top: 0px;padding-right: 15px;padding-bottom: 15px;padding-left: 15px;  }
.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }

</style></head>
<body>
<div id="art-main">
    <div class="art-sheet clearfix">
<header class="art-header">


    <div class="art-shapes">

            </div>
<h1 class="art-headline" data-left="12.83%">
    <a href="#">AAST Examination System</a>
</h1>
<h2 class="art-slogan" data-left="51.29%">It's not just about Learning, It's a life Style</h2>




<nav class="art-nav">
    <ul class="art-hmenu"><li><a href="home.php" class="">Home</a></li><li><a href="login.php" class="active">Login</a></li><li>
	<a href="register.php">Register</a></li></ul> 
    </nav>

	            
</header>

<?php
			if ($in_queue)
				echo "In request queue<br/>\n";
			else if ($invalid)
				echo "Invalid Username or Password<br/>";
			
		?>
		
		<br/>
	
		<form name = "login" method = "post" action = "login.php">
			Username &nbsp;&nbsp; <input type = "text" name = "username"> <br/><br/>
			Password &nbsp;&nbsp;&nbsp; <input type = "password" name = "password"> <br/><br/>
			<input type = "submit" name = "login" value = "Login"> <br/><br/>
		</form>
		
		<p>
			<a href = "forgotpass.php">Forgot Password?</a>
		</p>

<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content"><article class="art-post art-article">
                                <h2 class="art-postheader"></h2>
                                                
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
        <p><br></p>
    </div>
    </div>
</div>
</div>
                                
                

</article></div>
                    </div>
                </div>
            </div><footer class="art-footer">
<p style="text-align: center;">Developers<br/><br/> Ahmed Salem &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Ahmed Abdelhafiz &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Omar Ali &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bassam Salah</p>
</footer>

    </div>
    <p class="art-page-footer">
        <span id="art-footnote-links"><a href="http://www.artisteer.com/" target="_blank"></a>
    </p>
</div>


</body></html>
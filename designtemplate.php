<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.1.0.59861 -->
    <meta charset="utf-8">
    
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="style.responsive.css" media="all">


    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <script src="script.responsive.js"></script>


<style>.art-content .art-postcontent-0 .layout-item-0 { color: #1C1C1C; background: #EBEBEB;  }
.art-content .art-postcontent-0 .layout-item-1 { color: #1C1C1C; padding: 20px;  }
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



<?php
			session_start();
			
			//echo "<p>\n";
			
			echo "
		<nav class='art-nav'>
		<ul class='art-hmenu'\n>";
			echo "<li><a href = 'home.php'>Home</a></li>\n";
			if (isset($_SESSION['login'])){
				/*for ($i=0;$i<100;$i++)
					echo "&nbsp";*/
				
				//echo " | ";
				//echo "<li><a href = \"myaccount.php\">".$_SESSION['user']."(".$_SESSION['type'].")</a>"."</li>\n";
				echo "<li><a href = \"myaccount.php\">".$_SESSION['user']."</a>"."</li>\n";
				//echo " | ";
				echo "<li><a href = 'editprofile.php'>Profile</a></li>\n";
				//echo " | ";
				echo "<li><a href = \"logout.php\">Logout</a></li>\n";
				
			}
			if (!isset($_SESSION['user'])){
				//echo " | ";
				echo "<li><a href = \"login.php\">Login</a></li>\n";
			}
			//echo " | ";
			echo "<li><a href = \"register.php\">Register</a></li>\n";
			//echo "</p>\n";
		?>

</header>

</body>
</html>

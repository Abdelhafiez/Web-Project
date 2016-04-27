<?php

function pageURL() 
{
	$url = explode('/',$_SERVER['REQUEST_URI']);
	$ret = 'localhost';
	foreach($url as $i => $value)
		$ret = $value;
	return $ret;
}


?>

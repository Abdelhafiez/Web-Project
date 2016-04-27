<?php

function valid_username_and_password($str)
{
	$len = strlen($str);
	for($i=0;$i<$len;$i++)
		if ($str[$i] == ' ' || $str[$i] == '\'' || $str[$i] == '\"')
			return false;
	//$should_be = quote_smart($str);
	return $len > 0;
}
function valid_name($str)
{
	return ctype_alnum($str);
}
function valid_address($str)
{
	$len = strlen($str); 
	for($i=0;$i<$len;$i++)
		if (!ctype_alnum($str[$i]) && $str[$i]!='_' && $str[$i] != '.' && $str[$i] != ',' && $str[$i] != ' ')
			return false;
	return $len > 0;
}

function valid_email($str)
{
	return filter_var($str,FILTER_VALIDATE_EMAIL);
}
function verify_authorization($type)
{
	if (!isset($_SESSION['type']) || $_SESSION['type'] != $type)
		header("Location: home.php");
}
function verify_login()
{
	if (!isset($_SESSION['login']))
		header("Location: home.php");
}

?>
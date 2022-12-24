<?php
if(file_exists("index.html"))
{
	include_once("index.html");
	die();	
}
else
{
	$page = file_get_contents("$ApplicationNonSecureRoot/main/");
	echo($page);
	die();
}
?>
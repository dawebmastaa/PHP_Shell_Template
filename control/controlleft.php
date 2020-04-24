<?php
//no menu unless you're logged in
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
{
 	if($StripContent != 'control')
	{
		require_once("$ApplicationPath/functions/displaysubnavigation.php");
	}
 	echo('  <br clear="both" />'."\n".'  <ul class="LeftMenu">'."\n".'    <li><a href="control/index/content/logout/">Log Out</a></li>'."\n".'   </ul>');
}else
{
 	echo('  <br clear="both" /><ul class="LeftMenu"><li><a href="control/"><strong>Log In</strong></a></ul>');
}
?>
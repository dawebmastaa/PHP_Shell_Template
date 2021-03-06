<?php
//This is the main web site configuration file. It is prepended on every page request.

//uncomment this to take the site down for maintenance.
//header("location: updating.htm");
//die();

//start or continue the session
session_start();

//set the web roots (use https if implementing a secure certificate)
$ApplicationSecureRoot = 'http://127.0.0.1/shell1/';
$ApplicationNonSecureRoot = 'http://127.0.0.1/shell1/';

//set the user and group for permissions purposes
$ApplicationUser = 'mikea';
$ApplicationGroup = 'mikea';

//set the server path for the application (reverses slashes on Windows for cross-platform compatibility)
$ApplicationPath = str_replace('\\','/',dirname(__FILE__));

//set the default timezone
date_default_timezone_set('America/New_York');

//This is a list of all of the files that can be accessed directly on the site.
$DirectAccessFiles = array('index.php','index','ajaxcall.php');

//if the file being called isn't in the list, nobody gets in.
if(!in_array(basename($_SERVER['SCRIPT_NAME']), $DirectAccessFiles))
{
    header("location: $ApplicationNonSecureRoot"."main/index/content/404");
    die();
};

//this file contains the function for ses urls
require_once('functions/sesurls.php');

//this file connects to the database
require_once('functions/dataconnect.php');

//this file brings passed variables into scope so they can be called directly.
require_once('functions/getvariables.php');

// company name for copyright notice
$WebsiteName = 'Site Framework';

// this is where we find images
$ImagePath = $ApplicationPath.'img/';
$ImageURL = $ApplicationNonSecureRoot.'img/';

// site email address
$SiteEmail = 'Webmaster<mikealberts@metrocast.net>';

//initialize a variable to track users' last page visited
if(!isset($_SESSION['SessionReturn']))
{
    $_SESSION['SessionReturn'] = '';
}

// set default page to display
if (!isset($content))
{
    $content = 'main';
}

// set root variable so images on secure pages are displayed properly
switch($content)
{
    case 'checkout':
    $root = "$ApplicationSecureRoot";
    break;

    default :
    $root = "$ApplicationNonSecureRoot";
    break;
}
?>

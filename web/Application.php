<?php
//This is the main website configuration file. It is prepended on every page request.

//uncomment this to take the site down for maintenance.
//header("location: updating.htm");
//die();

//start or continue the session
session_start();

set_include_path(get_include_path().PATH_SEPARATOR.'/media/mikea/86022EF5022EE9BF/web/repos/PHP_Shell_Template/vendor/aura/sql/');
spl_autoload_extensions('.php');
spl_autoload('Aura\Sql');
spl_autoload_register();

//set the web roots (use https on both now)
$ApplicationSecureRoot = 'http://localhost:3000/';
$ApplicationNonSecureRoot = 'http://localhost:3000/';

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
    header("location: $ApplicationSecureRoot"."main/index/content/404");
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
$ImageURL = $ApplicationSecureRoot.'img/';

// site email address
$SiteEmail = 'Webmaster<mikealberts@gmail.com>';

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
// set root variable (simplified to only use SSL now)
$root = "$ApplicationSecureRoot";
?>

<?php
//this file is the ajax 'controller'. It's one of the few files that is directly call-able on the site.

//this file contains the function that extracts passed variables and brings them into scope.
require_once('getvariables.php');

//initialize the variables needed for this page.
$VariableArray = array('PageCall','filter','offset');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist).
GetVariables($VariableArray);

if(isset($PageCall) && !empty($PageCall))
{
    switch($PageCall)
    {
        case 'showimage':
            require_once('ajaxcalls/showimage.php');
        break;

        case 'sitemanager':
            require_once('ajaxcalls/sitemanager.php');
            if(isset($Message)){echo($Message);}
            //require_once ($ApplicationPath.'/control/sitemanager/model/modeleditpages.php');
        break;

        case 'recache':
            require_once('ajaxcalls/recache.php');
            if(isset($Message)){echo($Message);}
        break;

        default:
            echo('Nobody Home');
    }
}
?>
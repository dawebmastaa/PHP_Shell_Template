<?php
//this file is the ajax 'controller'. It's one of the only files that is directly call-able on the site.

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
    }
}
?>
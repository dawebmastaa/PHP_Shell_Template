<?php
//initialize the variables needed for this page.
$VariableArray = array('rebuild');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
GetVariables($VariableArray);

if(isset($rebuild) && $rebuild = 'Y')
{
    //check for the home page, delete it, then make a new one.
    if(file_exists($ApplicationPath.'/index.html'))
    {
        unlink($ApplicationPath .'/index.html');
        clearstatcache();
    }
    elseif(file_exists($ApplicationPath.'/main/cache/main.html'))
    {
        $StaticPage = file_get_contents($ApplicationPath.'/main/cache/main.html');
        file_put_contents($ApplicationPath.'/index.html',$StaticPage, LOCK_EX);
    }
}
?>
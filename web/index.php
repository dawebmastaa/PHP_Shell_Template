<?php
include_once('functions/buildstatiichome.php');

if(file_exists($ApplicationPath.'/index.html'))
{
    include_once('index.html');
    die();
}
else
{
    //everything at site root runs out of the 'main' directory
    include_once('main/index.php');
}
?>
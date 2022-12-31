<?php
//check for the home page and delete it
if(file_exists($ApplicationPath.'/index.html')) {
    unlink($ApplicationPath . '/index.html');
    clearstatcache();
}
else
{
    //make a new one
    $StaticPage = include_once('main/index.php');
    file_put_contents($ApplicationPath.'/index.html',$StaticPage, LOCK_EX);
}
?>
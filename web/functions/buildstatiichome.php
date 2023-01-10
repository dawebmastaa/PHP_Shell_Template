<?php
//check for the home page and delete it
if(file_exists($ApplicationPath.'/index.html')) {
    unlink($ApplicationPath . '/index.html');
    clearstatcache();
}
else
{
    //make a new one
    $StaticPage = file_get_contents($root.'main/');
    //file_put_contents($ApplicationPath.'/index.html', fopen("$root".'main/index.php', 'r'));
    file_put_contents($ApplicationPath.'/index.html',$StaticPage, LOCK_EX);
}
?>
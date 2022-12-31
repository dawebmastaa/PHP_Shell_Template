<?php
//this checks for cached pages, caches the requested one if it should be, or fetches the requested one if needed.
//it is called by the directory index files

//initialize the variables needed for this page (EVERYTHING must be in here now).
$VariableArray = array('caching','recache');

//pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
GetVariables($VariableArray);

if(!isset($_SERVER['PATH_INFO']))
{
    $_SERVER['PATH_INFO'] = '';
}

if(empty($caching))
{
    //CacheDirectory is created in every 'main' directory that we need to cache from
    $CacheDirectory = $ApplicationPath.'/'.$DirectoryPath.'/cache/';

    if(file_exists($CacheDirectory.'cached.php'))
    {
        require_once($CacheDirectory.'cached.php');

        //name the cache files (can't have slashes in the names, but we need the 'path info'.
        $id = $StripContent.strtr(str_replace('/recache/true/','',$_SERVER['PATH_INFO']),'/','~~').'.html';

        //if the page isn't in the 'cache list', don't do anything with it. Otherwise, we cache it.
        if(in_array($StripContent, $CachedFiles))
        {
            if(!empty($recache))
            {
                //delete the file so we can recache it
                if(file_exists($CacheDirectory.$id))
                {
                    unlink($CacheDirectory.$id);
                }
                clearstatcache();
            }
            //if there's a cache file, include it
            if(file_exists($CacheDirectory.$id))
            {
                include($CacheDirectory.$id);
                die();
            }
            else
            {
                //otherwise, create the cache file by bypassing the cache mechanism, and display the page
                $CacheUrl = rtrim($ApplicationNonSecureRoot,'/').rtrim($_SERVER['REQUEST_URI'], '/').'/?caching=yes';
                $data = file_get_contents($CacheUrl);

                file_put_contents($CacheDirectory.$id,stristr($data,'<'),LOCK_EX);
                //echo('ID: '.$_SERVER[PHP_SELF]);
                echo(stristr($data,'<'));
                die();
            }
        }
    }
}
?>
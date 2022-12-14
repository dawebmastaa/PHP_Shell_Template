<?php
//this file figures out the 'return url' so links to 'go back' work, like search results.
switch($StripContent)
{ 
    case 'main':
    
    $_SESSION['SessionReturn'] = "$root";
    
    break;
    
    case 'example':
 
    if(isset($offset) && $offset > 0 && !strpos($AddValues,'offset'))
    {
	    $AddValues.='offset/'.$offset.'/';
	}

    $_SESSION['SessionReturn'] = strtr($root.$DirectoryPath.'/index/content/'.$StripContent.'/'.$AddValues,' ','+');
    
    break;
    
    default:
    
    break;
}

//now add the 'static' html pages in the document root
//if(strpos($_SERVER['PHP_SELF'],'.html'))
//{
//    $_SESSION['SessionReturn'] = $root.basename($_SERVER['SCRIPT_NAME']);
//}
?>

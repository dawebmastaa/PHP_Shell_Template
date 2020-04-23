<?php
//this one isn't being used.
function Recursive_Remove_Directory($directory, $empty=FALSE)
{
	global $Message;
    
    if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}
	if(!file_exists($directory) || !is_dir($directory))
	{
		return FALSE;
	}
    elseif(is_readable($directory))
	{
		$handle = opendir($directory);
		while (FALSE !== ($item = readdir($handle)))
		{
			if($item != '.' && $item != '..')
			{
				$path = $directory.'/'.$item;
				if(is_dir($path)) 
				{
					Recursive_Remove_Directory($path);
				}
                else
                {
					unlink($path);
				}
			}
		}
		closedir($handle);
		if($empty == FALSE)
		{
			if(!rmdir($directory))
			{
				return FALSE;
			}
		}
	}
	return TRUE;
}

function RemoveDir($Directory)
{
	$Handle = opendir($Directory);
	while (false!==($Item = readdir($Handle)))
	{
		if($Item != '.' && $Item != '..')
		{
			if(is_dir($Directory.'/'.$Item))
			{
				RemoveDir($Directory.'/'.$Item);
			}
            else
            {
				unlink($Directory.'/'.$Item);
			}
		}
	}
	closedir($Handle);
	if(rmdir($Directory))
	{
		$Success = true;
	}
	return $Success;
}
?>
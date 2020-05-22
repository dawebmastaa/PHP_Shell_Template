<?php
//this file removes all cached files from the site.
mysqli_data_seek($GetSiteSectionsAdmin,0);

$DeletedFiles = 0;

while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
{
	if(is_dir($ApplicationPath.'/'.$row->Directory))
	{
		if($DirectoryList = opendir($ApplicationPath.'/'.$row->Directory))
		{
			while (($Directory = readdir($DirectoryList)) !== false)
			{
			 	if($Directory == 'cache')
				{
					$CacheDirectory = opendir($ApplicationPath.'/'.$row->Directory.'/'.$Directory);
					
					while (($CacheFiles = readdir($CacheDirectory)) !== false)
					{
						if(!is_dir($CacheFiles) && $CacheFiles != 'cached.php')
						{
							unlink($ApplicationPath.'/'.$row->Directory.'/cache/'.$CacheFiles);
							$Message .= '<span class="AlertText">Cached file '.$CacheFiles.' deleted.<br /></span>';
							$DeletedFiles++;
						}
					}
				}
			}

		}
	}
}
if($DeletedFiles == 0)
{
    $Message.='<span class="AlertText">No cached files found to delete.<br /></span>';
}else
{
    $Message .= '<span class="AlertText">Total of '.$DeletedFiles.' were deleted<br /></span>';
}
?>
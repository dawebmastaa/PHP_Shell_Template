<?php
if(!isset($Message)){$Message = '';}

$GetSiteSectionsAdmin = $MainConnection->query("
	    SELECT SectionID, Section, Directory, MakeLive, MenuWidth
	    FROM SiteSections
	    ORDER By DisplayOrder");
		
		$SectionRecordCountAdmin = count($GetSiteSectionsAdmin->fetchFirstColumn());
		echo('Section Count: '.$SectionRecordCountAdmin);

$GetLinksAdmin = $MainConnection->query("
	    SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	    FROM SiteLinks, SiteSections
	    WHERE (SiteLinks.SectionID = SiteSections.SectionID)
	    ORDER BY SiteSections.DisplayOrder, SectionID,SiteLinks.SiteLinkID");
		
		$LinkRecordCountAdmin = count($GetLinksAdmin->fetchFirstColumn());

$GetSiteSubNavLinksAdmin = $MainConnection->query("
	    SELECT SubNavID, SiteLinkID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription
	    FROM SiteSubNavLinks
	    ORDER By SubNavID");
		
		$SubNavLinksRecordCountAdmin = count($GetSiteSectionsAdmin->fetchFirstColumn());

$WhereClause = '';
$WhereClause2 = 'WHERE (SiteLinks.SectionID = SiteSections.SectionID)';


$GetSiteSections = $MainConnection->query("
		SELECT SectionID, Section, Directory, MenuWidth, SectionTitle
		FROM AdminSiteSections
		$WhereClause
		ORDER By DisplayOrder");

if($GetSiteSections)
{
    $SectionRecordCount = count($GetSiteSections->fetchFirstColumn());
}

$GetLinks = $MainConnection->query("
		SELECT   AdminSiteLinks.SiteLinkID AS PageID, AdminSiteLinks.LinkText as Text, AdminSiteLinks.Link as URL, AdminSiteLinks.LinkTitle as Message, AdminSiteSections.Section as Section, AdminSiteSections.SectionID as SectionID, AdminSiteSections.Directory as Directory, AdminSiteSections.MenuWidth AS MenuWidth, AdminSiteLinks.FileName AS FileName, AdminSiteLinks.PageTitle AS Title
		FROM     AdminSiteLinks, AdminSiteSections
		$WhereClause2
		ORDER BY SectionID, AdminSiteLinks.SiteLinkID");

if($GetLinks)
{
    $LinkRecordCount = count($GetLinks->fetchFirstColumn());
}

//require_once($ApplicationPath.'/functions/recachefiles.php');

//remove all cached files from the site.
$DeletedFiles = 0;

while($row = $GetSiteSectionsAdmin->fetchAssociative())
{
	if(is_dir($ApplicationPath.'/'.$row['Directory']))
	{
		if($DirectoryList = opendir($ApplicationPath.'/'.$row['Directory']))
		{
			while (($Directory = readdir($DirectoryList)) !== false)
			{
			 	if($Directory == 'cache')
				{
					$CacheDirectory = opendir($ApplicationPath.'/'.$row['Directory'].'/'.$Directory);
					
					while (($CacheFiles = readdir($CacheDirectory)) !== false)
					{
						if(!is_dir($CacheFiles) && $CacheFiles != 'cached.php')
						{
							unlink($ApplicationPath.'/'.$row['Directory'].'/cache/'.$CacheFiles);
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
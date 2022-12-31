<?php
//these are the admin links.
if($MainDirectory === 'control')
{
	if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
	{
	    $GetSiteSectionsAdmin = $MainConnection->query("
	    SELECT SectionID, Section, Directory, MakeLive, MenuWidth
	    FROM SiteSections
	    ORDER By DisplayOrder");

		$GetSiteSectionsAdmin->setFetchMode(PDO::FETCH_ASSOC);

	    if($GetSiteSectionsAdmin)
	    {
	        $SectionRecordCountAdmin = count($GetSiteSectionsAdmin->fetch(PDO::FETCH_NUM));
	    }

	    $GetLinksAdmin = $MainConnection->query("
	    SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	    FROM SiteLinks, SiteSections
	    WHERE (SiteLinks.SectionID = SiteSections.SectionID)
	    ORDER BY SiteSections.DisplayOrder, SectionID,SiteLinks.SiteLinkID");

		$GetLinksAdmin->setFetchMode(PDO::FETCH_ASSOC);

	    if($GetLinksAdmin)
	    {
	        $LinkRecordCountAdmin = count($GetLinksAdmin->fetch(PDO::FETCH_NUM));
	    }

	    $GetSiteSubNavLinksAdmin = $MainConnection->query("
	    SELECT SubNavID, SiteLinkID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription
	    FROM SiteSubNavLinks
	    ORDER By SubNavID");

		$GetSiteSubNavLinksAdmin->setFetchMode(PDO::FETCH_ASSOC);

	    if($GetSiteSubNavLinksAdmin)
	    {
	        $SubNavLinksRecordCountAdmin = count($GetSiteSubNavLinksAdmin->fetch(PDO::FETCH_NUM));
	    }

	    if($_SESSION["IsAdmin"] && $_SESSION["IsAdmin"] == 'Y')
		{
			$WhereClause = '';
			$WhereClause2 = 'WHERE (AdminSiteLinks.SectionID = AdminSiteSections.SectionID)';
		}
		else
		{
			$WhereClause = "WHERE AdminSiteSections.RoleID = $_SESSION[UserRole]";
			$WhereClause2 = "WHERE (AdminSiteLinks.SectionID = AdminSiteSections.SectionID) AND (AdminSiteSections.RoleID = $_SESSION[UserRole])";
		}

		$GetSiteSections = $MainConnection->query("
		SELECT SectionID, Section, Directory, MenuWidth, SectionTitle
		FROM AdminSiteSections
		$WhereClause
		ORDER By DisplayOrder");

		$GetSiteSections->setFetchMode(PDO::FETCH_ASSOC);

		if($GetSiteSections)
		{
			$SectionRecordCount = count($GetSiteSections->fetch(PDO::FETCH_NUM));
		}

		$GetLinks = $MainConnection->query("
		SELECT   AdminSiteLinks.SiteLinkID AS PageID, AdminSiteLinks.LinkText as Text, AdminSiteLinks.Link as URL, AdminSiteLinks.LinkTitle as Message, AdminSiteSections.Section as Section, AdminSiteSections.SectionID as SectionID, AdminSiteSections.Directory as Directory, AdminSiteSections.MenuWidth AS MenuWidth, AdminSiteLinks.FileName AS FileName, AdminSiteLinks.PageTitle AS Title
		FROM     AdminSiteLinks, AdminSiteSections
		$WhereClause2
		ORDER BY SectionID, AdminSiteLinks.SiteLinkID");

		$GetLinks->setFetchMode(PDO::FETCH_ASSOC);

		if($GetLinks)
		{
			$LinkRecordCount = count($GetLinks->fetch(PDO::FETCH_NUM));
		}
	}
}
//these are the normal site links
else
{
	$GetSiteSections = $MainConnection->query("
	SELECT SectionID, Section, Directory, MenuWidth, SectionTitle
	FROM SiteSections
	WHERE MakeLive = 'Y'
	ORDER By DisplayOrder");

	$GetSiteSections->setFetchMode(PDO::FETCH_ASSOC);

	if($GetSiteSections)
	{
		$SectionRecordCount = count($GetSiteSections->fetch(PDO::FETCH_NUM));
	}

	$GetLinks = $MainConnection->query("
	SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteSections.MenuWidth AS MenuWidth, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	FROM     SiteLinks, SiteSections
	WHERE    (SiteLinks.SectionID = SiteSections.SectionID) AND (SiteLinks.MakeLive = 'Y')
	ORDER BY SiteSections.DisplayOrder,SiteLinks.SiteLinkID");

	$GetLinks->setFetchMode(PDO::FETCH_ASSOC);

	if(count($GetLinks->fetch(PDO::FETCH_NUM)) != 0)
	{
		$LinkRecordCount = count($GetLinks->fetch(PDO::FETCH_NUM));
		$GetLinks->closeCursor();
	}
}
?>
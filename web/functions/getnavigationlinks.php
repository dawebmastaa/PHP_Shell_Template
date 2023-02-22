<?php
//these are the admin links.
if($MainDirectory === 'control' && isset($_SESSION["UserLoggedIn"]))
{
	if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
	{
	    $GetSiteSectionsAdmin = $MainConnection->query("
	    SELECT SectionID, Section, Directory, MakeLive, MenuWidth
	    FROM AdminSiteSections
	    ORDER By DisplayOrder");

		$rows = $GetSiteSectionsAdmin->fetchAllAssociative();
		$SectionRecordCountAdmin = count($rows);

	    $GetLinksAdmin = $MainConnection->query("
	    SELECT   AdminSiteLinks.SiteLinkID AS PageID, AdminSiteLinks.LinkText as Text, AdminSiteLinks.Link as URL, AdminSiteLinks.LinkTitle as Message, AdminSiteSections.Section as Section, AdminSiteSections.SectionID as SectionID, AdminSiteSections.Directory as Directory, AdminSiteLinks.FileName AS AdminFileName, AdminSiteLinks.PageTitle AS Title, AdminSiteLinks.PageKeywords AS Keywords, AdminSiteLinks.PageDescription AS Description
	    FROM AdminSiteLinks, AdminSiteSections
	    WHERE (AdminSiteLinks.SectionID = AdminSiteSections.SectionID)
	    ORDER BY AdminSiteSections.DisplayOrder, SectionID,AdminSiteLinks.SiteLinkID");

		$rows2 = $GetLinksAdmin->fetchAllAssociative();
		$LinkRecordCountAdmin = count($rows2);

	    $GetSiteSubNavLinksAdmin = $MainConnection->query("
	    SELECT SubNavID, SiteLinkID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription
	    FROM AdminSiteSubNavLinks
	    ORDER By SubNavID");

		$rows3 = $GetSiteSubNavLinksAdmin->fetchAllAssociative();
        $SubNavLinksRecordCountAdmin = count($rows3);
			
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

		$rows = $GetSiteSections->fetchAllAssociative();
		$SectionRecordCount = count($rows);

		$GetLinks = $MainConnection->query("
		SELECT   AdminSiteLinks.SiteLinkID AS PageID, AdminSiteLinks.LinkText as Text, AdminSiteLinks.Link as URL, AdminSiteLinks.LinkTitle as Message, AdminSiteSections.Section as Section, AdminSiteSections.SectionID as SectionID, AdminSiteSections.Directory as Directory, AdminSiteSections.MenuWidth AS MenuWidth, AdminSiteLinks.FileName AS FileName, AdminSiteLinks.PageTitle AS Title
		FROM     AdminSiteLinks, AdminSiteSections
		$WhereClause2
		ORDER BY SectionID, AdminSiteLinks.SiteLinkID");

		$rows2 = $GetLinks->fetchAllAssociative();
		$LinkRecordCount = count($rows2);
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

	$rows = $GetSiteSections->fetchAllAssociative();
	$SectionRecordCount = count($rows);

	$GetLinks = $MainConnection->query("
	SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteSections.MenuWidth AS MenuWidth, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	FROM     SiteLinks, SiteSections
	WHERE    (SiteLinks.SectionID = SiteSections.SectionID) AND (SiteLinks.MakeLive = 'Y')
	ORDER BY SiteSections.DisplayOrder,SiteLinks.SiteLinkID");

	$rows2 = $GetLinks->fetchAllAssociative();
	$LinkRecordCount = count($rows2);
}
?>
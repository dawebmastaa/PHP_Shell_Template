<?php
//these are the admin links.
if($MainDirectory === 'control')
{
	if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
	{
	    $GetSiteSectionsAdmin = mysqli_query($MainConnection,"
	    SELECT SectionID, Section, Directory, MakeLive, MenuWidth
	    FROM SiteSections
	    ORDER By DisplayOrder");

	    if(mysqli_num_rows($GetSiteSectionsAdmin))
	    {
	        $SectionRecordCountAdmin = mysqli_num_rows($GetSiteSectionsAdmin);
	    }

	    $GetLinksAdmin = mysqli_query($MainConnection,"
	    SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	    FROM SiteLinks, SiteSections
	    WHERE (SiteLinks.SectionID = SiteSections.SectionID)
	    ORDER BY SiteSections.DisplayOrder, SectionID,SiteLinks.SiteLinkID");

	    if(mysqli_num_rows($GetLinksAdmin))
	    {
	        $LinkRecordCountAdmin = mysqli_num_rows($GetLinksAdmin);
	    }

	    $GetSiteSubNavLinksAdmin = mysqli_query($MainConnection,"
	    SELECT SubNavID, SiteLinkID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription
	    FROM SiteSubNavLinks
	    ORDER By SubNavID");

	    if(mysqli_num_rows($GetSiteSubNavLinksAdmin))
	    {
	        $SubNavLinksRecordCountAdmin = mysqli_num_rows($GetSiteSectionsAdmin);
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

		$GetSiteSections = mysqli_query($MainConnection,"
		SELECT SectionID, Section, Directory, MenuWidth, SectionTitle
		FROM AdminSiteSections
		$WhereClause
		ORDER By DisplayOrder");

		if($GetSiteSections)
		{
			$SectionRecordCount = mysqli_num_rows($GetSiteSections);
		}

		$GetLinks = mysqli_query($MainConnection,"
		SELECT   AdminSiteLinks.SiteLinkID AS PageID, AdminSiteLinks.LinkText as Text, AdminSiteLinks.Link as URL, AdminSiteLinks.LinkTitle as Message, AdminSiteSections.Section as Section, AdminSiteSections.SectionID as SectionID, AdminSiteSections.Directory as Directory, AdminSiteSections.MenuWidth AS MenuWidth, AdminSiteLinks.FileName AS FileName, AdminSiteLinks.PageTitle AS Title
		FROM     AdminSiteLinks, AdminSiteSections
		$WhereClause2
		ORDER BY SectionID, AdminSiteLinks.SiteLinkID");

		if($GetLinks)
		{
			$LinkRecordCount = mysqli_num_rows($GetLinks);
		}
	}
}
//these are the normal site links
else
{
	$GetSiteSections = mysqli_query($MainConnection,"
	SELECT SectionID, Section, Directory, MenuWidth, SectionTitle
	FROM SiteSections
	WHERE MakeLive = 'Y'
	ORDER By DisplayOrder");

	if($GetSiteSections)
	{
		$SectionRecordCount = mysqli_num_rows($GetSiteSections);
	}

	$GetLinks = mysqli_query($MainConnection,"
	SELECT   SiteLinks.SiteLinkID AS PageID, SiteLinks.LinkText as Text, SiteLinks.Link as URL, SiteLinks.LinkTitle as Message, SiteSections.Section as Section, SiteSections.SectionID as SectionID, SiteSections.Directory as Directory, SiteSections.MenuWidth AS MenuWidth, SiteLinks.FileName AS FileName, SiteLinks.PageTitle AS Title, SiteLinks.PageKeywords AS Keywords, SiteLinks.PageDescription AS Description
	FROM     SiteLinks, SiteSections
	WHERE    (SiteLinks.SectionID = SiteSections.SectionID) AND (SiteLinks.MakeLive = 'Y')
	ORDER BY SiteSections.DisplayOrder,SiteLinks.SiteLinkID");

	if($GetLinks)
	{
		$LinkRecordCount = mysqli_num_rows($GetLinks);
	}
}
?>
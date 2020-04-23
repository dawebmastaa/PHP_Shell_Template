<?php
//get the page title and Meta for the page.

//this is for the 'site control' admin
if($MainDirectory == 'control')
{
 	$title = 'Admin';
	
	$GetSectionTitle = mysqli_query($MainConnection,"
	SELECT SectionTitle
	FROM AdminSiteSections
	WHERE Directory = '$ThisDirectory'
	LIMIT 1");
	
	if(mysqli_num_rows($GetSectionTitle) > 0)
	{
		$row = mysqli_fetch_object($GetSectionTitle);
		$title = $row->SectionTitle;
		$SectionTitle = $row->SectionTitle;
	}
	
	$GetPageTitle = mysqli_query($MainConnection,"
	SELECT PageTitle, PageKeywords, PageDescription
	FROM AdminSiteLinks
	WHERE FileName = '$StripContent'
	LIMIT 1");
		
	if(mysqli_num_rows($GetPageTitle) > 0)
	{
		$row2 = mysqli_fetch_object($GetPageTitle);
		$title = $row2->PageTitle;
	}
}
else
{
    switch($StripContent)
    {
        case 'sitemap':
        
        //the site map is special so we treat it separate
        $title = 'Site Map';
        $keywords = 'site map keywords';
        $description = 'site map description!';
        
        break;
        
        default:
        
        //the real site pages need keywords, descriptions and meta robots as well as titles
        //first we check if it's a 'main' section page
        $GetSectionTitle = mysqli_query($MainConnection,"
        SELECT SectionTitle, SectionKeywords, SectionDescription, SectionRobots
        FROM SiteSections
        WHERE Directory = '$StripContent'
        LIMIT 1");
        
        if(mysqli_num_rows($GetSectionTitle) > 0)
        {
            $row = mysqli_fetch_object($GetSectionTitle);
            
            $SectionTitle = $row->SectionTitle;
            $title = $row->SectionTitle;
            $keywords = $row->SectionKeywords;
            $description = $row->SectionDescription;
            $robots = $row->SectionRobots;
        }        
        //if it isn't, then it's an internal sub-page
        else
        {
            $GetPageTitle = mysqli_query($MainConnection,"
            SELECT PageTitle, PageKeywords, PageDescription, PageRobots, SectionID
            FROM SiteLinks
            WHERE FileName = '$StripContent'
            LIMIT 1");
            
            if(mysqli_num_rows($GetPageTitle) > 0)
            {
                $row = mysqli_fetch_object($GetPageTitle);
                $title = $row->PageTitle;
                $keywords = $row->PageKeywords;
                $description = $row->PageDescription;
                $robots = $row->PageRobots;
                
                $SectionID = $row->SectionID;
                
                $GetSectionTitle = mysqli_query($MainConnection,"
                SELECT SectionTitle
                FROM SiteSections
                WHERE SiteSections.SectionID = $SectionID
                LIMIT 1");
                
                $row = mysqli_fetch_object($GetSectionTitle);
                
                $SectionTitle = $row->SectionTitle;
            }
            else
            {
                $GetSubPageTitle = mysqli_query($MainConnection,"
                SELECT PageTitle, PageKeywords, PageDescription, PageRobots
                FROM SiteSubNavLinks
                WHERE FileName = '$StripContent'
                LIMIT 1");
                
                if(mysqli_num_rows($GetSubPageTitle) > 0)
                {
                    $row = mysqli_fetch_object($GetSubPageTitle);
                    
                    $title = $row->PageTitle;
                    $keywords = $row->PageKeywords;
                    $description = $row->PageDescription;
                    $robots = $row->PageRobots;
                }
            }
        }
        
        break;
    }
}
?>
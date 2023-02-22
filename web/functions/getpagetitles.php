<?php
//get the page title and Meta for the page.

//this is for the 'site control' admin
if($MainDirectory == 'control')
{
 	$title = 'Admin';
	
	$GetSectionTitle = $MainConnection->query("
	SELECT SectionTitle
	FROM AdminSiteSections
	WHERE Directory = '$ThisDirectory'
	LIMIT 1");

    $Return1 = $GetSectionTitle->fetchAssociative();
	
	if($Return1 != NULL)
	{
		$title = $Return1['SectionTitle'];
		$SectionTitle = $Return1['SectionTitle'];
	}
	
	$GetPageTitle = $MainConnection->query("
	SELECT PageTitle, PageKeywords, PageDescription
	FROM AdminSiteLinks
	WHERE FileName = '$StripContent'
	LIMIT 1");
		
	$Return2 = $GetPageTitle->fetchAssociative();

    if($Return2 != NULL)
	{
		//$row2 = mysqli_fetch_object($GetPageTitle);
		$title = $Return2['PageTitle'];
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
        $GetSectionTitle = $MainConnection->query("
        SELECT SectionTitle, SectionKeywords, SectionDescription, SectionRobots
        FROM SiteSections
        WHERE Directory = '$StripContent'");

        $Return1 = $GetSectionTitle->fetchAssociative();

        if($Return1 != NULL)
        {
            $SectionTitle = $Return1['SectionTitle'];
            $title = $SectionTitle;
            $keywords = $Return1['SectionKeywords'];
            $description = $Return1['SectionDescription'];
            $robots = $Return1['SectionRobots'];
        }        
        //if it isn't, then it's an internal sub-page
        else
        {
            $GetSubPageTitle = $MainConnection->query("
            SELECT PageTitle, PageKeywords, PageDescription, PageRobots, SectionID
            FROM SiteLinks
            WHERE FileName = '$StripContent'");

            $Return2 = $GetSubPageTitle->fetchAssociative();
            
            if($Return2 != NULL)
            {
                $title = $Return2['PageTitle'];
                $keywords = $Return2['PageKeywords'];
                $description = $Return2['PageDescription'];
                $robots = $Return2['PageRobots'];
                
                $SectionID = $Return2['SectionID'];

                $GetSubPageSectionTitle = $MainConnection->query("
                SELECT SectionTitle
                FROM SiteSections
                WHERE SiteSections.SectionID = $SectionID");

                $Return3 = $GetSubPageSectionTitle ->fetchAssociative();
                $SectionTitle = $Return3['SectionTitle'];
            }
            else
            {
                $GetSubPageTitle = $MainConnection->query("
                SELECT PageTitle, PageKeywords, PageDescription, PageRobots
                FROM SiteSubNavLinks
                WHERE FileName = '$StripContent'");

                $Return4 = $GetSubPageTitle->fetchAssociative();
                
                if($Return4 !== NULL)
                {
                    $title = $Return4['PageTitle'];
                    $keywords = $Return4['PageKeywords'];
                    $description = $Return4['PageDescription'];
                    $robots = $Return4['PageRobots'];
                }
            }
        }
        
        break;
    }
}
?>
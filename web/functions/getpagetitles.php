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

    $GetSectionTitle->setFetchMode(PDO::FETCH_OBJ);
	
	if($GetSectionTitle)
	{
		//$row = mysqli_fetch_object($GetSectionTitle);
		$title = $GetSectionTitle['SectionTitle, 0'];
		$SectionTitle = $GetSectionTitle['SectionTitle, 0'];
	}
	
	$GetPageTitle = $MainConnection->query("
	SELECT PageTitle, PageKeywords, PageDescription
	FROM AdminSiteLinks
	WHERE FileName = '$StripContent'
	LIMIT 1");
		
	if($GetPageTitle)
	{
		//$row2 = mysqli_fetch_object($GetPageTitle);
		$title = $GetPageTitle['PageTitle'];
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

        $SectionsCount = $GetSectionTitle->fetchAll();
        $GetSectionTitle->closeCursor();

        if(count($SectionsCount) != 0)
        {
            $GetSectionTitle->execute();
            $row = $GetSectionTitle->fetch(PDO::FETCH_ASSOC);
            
            $SectionTitle = $row['SectionTitle'];
            $title = $SectionTitle;
            $keywords = $row['SectionKeywords'];
            $description = $row['SectionDescription'];
            $robots = $row['SectionRobots'];

            $GetSectionTitle->closeCursor();
        }        
        //if it isn't, then it's an internal sub-page
        else
        {
            $GetSubPageTitle = $MainConnection->query("
            SELECT PageTitle, PageKeywords, PageDescription, PageRobots, SectionID
            FROM SiteLinks
            WHERE FileName = '$StripContent'");

            $SubPageCount = $GetSubPageTitle->fetchAll();
            $GetSubPageTitle->closeCursor();
            
            if(count($SubPageCount) != 0)
            {
                $GetSubPageTitle->execute();
                $row = $GetSubPageTitle->fetch(PDO::FETCH_ASSOC);

                $title = $row['PageTitle'];
                $keywords = $row['PageKeywords'];
                $description = $row['PageDescription'];
                $robots = $row['PageRobots'];
                
                $SectionID = $row['SectionID'];

                $GetSubPageTitle->closeCursor();
                
                $GetSubPageSectionTitle = $MainConnection->query("
                SELECT SectionTitle
                FROM SiteSections
                WHERE SiteSections.SectionID = $SectionID");

                $GetSubPageSectionTitle->execute();
                $row = $GetSubPageSectionTitle->fetch(PDO::FETCH_ASSOC);
                
                $SectionTitle = $row['SectionTitle'];

                $GetSubPageSectionTitle->closeCursor();
            }
            else
            {
                $GetSubPageTitle = $MainConnection->query("
                SELECT PageTitle, PageKeywords, PageDescription, PageRobots
                FROM SiteSubNavLinks
                WHERE FileName = '$StripContent'");

                $SubPageCount = $GetSubPageTitle->fetchAll();
                $GetSubPageTitle->closeCursor();
                
                if(count($SubPageCount) != 0)
                {
                    $row = $GetSubPageTitle->execute();
                    
                    $title = $row['PageTitle'];
                    $keywords = $row['PageKeywords'];
                    $description = $row['PageDescription'];
                    $robots = $row['PageRobots'];

                    $GetSubPageTitle->closeCursor();
                }
            }
        }
        
        break;
    }
}
?>
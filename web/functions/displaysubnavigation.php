<?php
// Let's save some stuff
$ActiveRecord  = array();
// By default we're at the home page
$ActiveRecord["SectionID"] = '1';
$ActiveRecord["Section"] = 'Home';
$ActiveRecord["Directory"] = 'main';

$PageList = '  <ul class="LeftMenu">';

//First, add link to the directory root (fix this to remove the loop as there's never more than one record.)
foreach($rows AS $row)
{
    //if we're at the directory root we don't need an actual link
    if(($ThisDirectory === $row['Directory']) && ($StripContent === $row['Directory']))
    {
        $ActiveRecord["SectionID"] = $row['SectionID'];
        $ActiveRecord["Section"] = $row['Section'];
        $ActiveRecord["Directory"] = $row['Directory'];
        $ActiveRecord["SectionTitle"] = $row['SectionTitle'];
        $PageList .='   <li style="color: #E5E5E5;"><span style="display: block;">'.$row['Section'].'</span></li>'."\n";
    }
    //otherwise all pages in this directory need a link to it
    elseif($ThisDirectory === $row['Directory'])
    {
        $ActiveRecord["SectionID"] = $row['SectionID'];
        $ActiveRecord["Section"] = $row['Section'];
        $ActiveRecord["Directory"] = $row['Directory'];
        $ActiveRecord["SectionTitle"] = $row['SectionTitle'];
        $PageList .='   <li><a href="'.$row['Directory'].'">'.$row['Section'].'</a></li>'."\n";
    }
}
// now on to the links query
foreach($rows2 AS $row2)
{
    // if it has the right SectionID we want it
    if(($row2['SectionID'] === $ActiveRecord["SectionID"]) && ($row2['FileName'] === $StripContent))
    {
        //This one is active so no link, and save the infos
        $PageList .='   <li style="color: #E5E5E5;"><span style="display: block;">'.$row2['Text'].'</span></li>'."\n";

        if($StripContent === $row2['FileName'])
        {
            // Look for subpages
            $PageID = $row2['PageID'];
            $GetSubLinks = $MainConnection->query("
            SELECT *
            FROM SiteSubNavLinks
            WHERE MakeLive = 'Y' AND SiteLinkID LIKE '%/$PageID/%'
            ORDER BY SiteSubNavLinks.SubNavID");

            $rows3 = $GetSubLinks->fetchAllAssociative();
            $SubLinkRecordCount = count($rows3);

            if($SubLinkRecordCount > 0)
            {
               foreach($rows3 AS $row3)
               {
                   if($row3['FileName'] !== $StripContent)
                   {
                    $PageList .= '   <li><a href="'.$row3['Link'].'">'.$row3['LinkText'].'</a></li>'."\n";
                   }
                   else
                   {
                    $PageList .= '   <li style="background-color: #FFFFFF;"><span>'.$row3['LinkText'].'</span></li>'."\n";
                   }
               }
            }
        }
    }
    elseif($row2['SectionID'] === $ActiveRecord['SectionID'])
    {
        // The rest need links
        $PageList .='   <li><a href="'.$row2['URL'].'">'.$row2['Text'].'</a></li>'."\n";
    }
}

//finish it
$PageList .= '  </ul>';

//display it
echo($PageList);
?>
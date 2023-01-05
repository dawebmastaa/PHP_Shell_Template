 <?php
 //this does default sub-navigation for pages.
 if($LinkRecordCount > 0)
 {
     $OpenTags = 'N';
     $CloseTags = 'N';

     //reset the array that contains the links
     reset($rows);
     reset($rows2);

     foreach($rows2 AS $row2)
     {
         if($ThisDirectory === $row2['Directory'])
         {
             if($OpenTags == 'N')
             {
                echo("\n");
                echo('  <ul class="LeftMenu">'."\n");
             }
             $OpenTags = 'Y';
             $CloseTags = 'Y';

             if($StripContent === $row2['FileName'])
             {
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
                        echo('   <li style="background-color: #FFFFFF;"><span>'.$row3['LinkText'].'</span></li>'."\n");
                    }
                }
             }
             else
             {
                 echo('   <li><a href="'.$row2['URL'].'">'.$row2['Text'].'</a></li>'."\n");
             }
         }
     }

     if($CloseTags == 'Y')
     {
            echo('  </ul>'."\n");
     }
}

  if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
  {
  ?>
  <br />

  <ul class="LeftMenu">
  <?php
  foreach($rows3 AS $row3)
   {
        if($StripContent == $row3['FileName'])
        {
            echo('  <li style="color: #E5E5E5;"><span style="display: block;">'.$row3['Text'].'</span></li>'."\n");
        }
        else
        {
            echo('  <li><a href="'.$row3['Link'].'">'.$row3['LinkText'].'</a></li>'."\n");
        }
   }
  }

  $GetSubPage = $MainConnection->query("
  SELECT SubNavID
  FROM SiteSubNavLinks
  WHERE FileName = '$StripContent'
  LIMIT 1");

  $Return5 = $GetSubPage->fetchAssociative();
  if($Return5 != NULL){$SubPageCount = 1;}else{$SubPageCount = 0;}
  
  if($Return5 != NULL)
  {
      $SubNavSubPageID = $Return5['SubNavID'];

      $GetSubNavSubLinks = $MainConnection->query("
      SELECT *
      FROM SiteSubNavLinks
      WHERE MakeLive = 'Y' AND SubNavLinkID LIKE '%/$SubNavSubPageID/%'
      ORDER BY SiteSubNavLinks.SubNavID");

      $SubNavSubCount = $GetSubNavSubLinks->fetchAllAssociative();      
      $SubNavSubLinkRecordCount = count($SubNavSubCount);
  }
  
  if((!isset($SubLinkRecordCount) || $SubLinkRecordCount == 0) && isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0)
  {
  ?>
  <br />

  <ul class="LeftMenu">
  <?php
  }
    
  if(isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0)
  {
    $GetSubNavSubLinks->execute();
    while($row = $GetSubNavSubLinks->fetch(PDO::FETCH_OBJ))
       {
           echo('  <li><a href="'.$row->Link.'">'.$row->LinkText.'</a></li>'."\n");
       }
   }
   if((isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0) || (isset($SubLinkRecordCount) && $SubLinkRecordCount > 0))
   {
   ?>
  </ul>
   <?php
   }
   ?>
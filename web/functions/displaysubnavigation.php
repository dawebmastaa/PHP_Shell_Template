 <?php
 //this does default sub-navigation for pages.
 if($LinkRecordCount > 0)
 {
     $OpenTags = 'N';
     $CloseTags = 'N';

     //reset the query that contains the links
     $GetLinks->execute();

     foreach($GetLinks AS $row)
     {
         if($ThisDirectory === $row['Directory']) {
             if($OpenTags == 'N')
             {
                echo("\n");
                echo('  <ul class="LeftMenu">'."\n");
             }
             $OpenTags = 'Y';
             $CloseTags = 'Y';

             if($StripContent === $row['FileName'])
             {
                 $PageID = $row['PageID'];
                 
                 $GetSubLinks = $MainConnection->query("
                 SELECT *
                 FROM SiteSubNavLinks
                 WHERE MakeLive = 'Y' AND SiteLinkID LIKE '%\/$PageID\/%'
                 ORDER BY SiteSubNavLinks.SubNavID");

                 $SubLinkRecordCount = count($GetSectionTitle->fetchAll());
                 $GetSubLinks->closeCursor();
                 
                 //$SubLinkRecordCount = $SubLinkCount;

                 echo('   <li style="background-color: #FFFFFF;"><span>'.$row->Text.'</span></li>'."\n");
             }
             else
             {
                 echo('   <li><a href="'.$row->URL.'">'.$row->Text.'</a></li>'."\n");
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
  $GetSubLinks->execute();
  //$row = $GetSubLinks->fetch(PDO::FETCH_ASSOC);
   while($row = $GetSubLinks->fetch(PDO::FETCH_OBJ))
   {
        if($StripContent == $row->FileName)
        {
            echo('  <li style="color: #E5E5E5;"><span style="display: block;">'.$row->Text.'</span></li>'."\n");
        }
        else
        {
            echo('  <li><a href="'.$row->Link.'">'.$row->LinkText.'</a></li>'."\n");
        }
   }
  }

  $GetSubPage = $MainConnection->query("
  SELECT SubNavID
  FROM SiteSubNavLinks
  WHERE FileName = '$StripContent'
  LIMIT 1");

  $SubPageCount = $GetSubPage->fetchAll();
  $GetSubPage->closeCursor();
  
  if(count($SubPageCount) != 0)
  {
      $GetSubPage->execute();
      $row = $GetSubPage->fetch(PDO::FETCH_OBJ);
      
      $SubNavSubPageID = $row->SubNavID;

      $GetSubPage->closeCursor();
      
      $GetSubNavSubLinks = $MainConnection->query("
      SELECT *
      FROM SiteSubNavLinks
      WHERE MakeLive = 'Y' AND SubNavLinkID LIKE '%\/$SubNavSubPageID\/%'
      ORDER BY SiteSubNavLinks.SubNavID");

      $SubNavSubCount = $GetSubNavSubLinks->fetchAll();
      $GetSubNavSubLinks->closeCursor();
      
      $SubNavSubLinkRecordCount = count($SubNavSubCountbNavSub);
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
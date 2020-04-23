 <?php
 //this does default sub-navigation for pages.
 if(isset($LinkRecordCount) && $LinkRecordCount > 0)
 {
     $OpenTags = 'N';
     $CloseTags = 'N';

     //reset the query that contains the links
     mysqli_data_seek($GetLinks,0);

     //echo('<h2 style="text-align: left; padding-left: 8px;">'.ucfirst($ThisDirectory).'</h2>');
     
     while($row = mysqli_fetch_object($GetLinks))
     {
         if($ThisDirectory === $row->Directory)
         {
             if($OpenTags == 'N')
             {
                echo("\n");
                echo(' <div class="LeftMenu">'."\n");
                echo(' <ul>'."\n");
             }
             $OpenTags = 'Y';
             $CloseTags = 'Y';

             if($StripContent === $row->FileName)
             {
                 $PageID = $row->PageID;
                 
                 $GetSubLinks = mysqli_query($MainConnection,"
                 SELECT *
                 FROM SiteSubNavLinks
                 WHERE MakeLive = 'Y' AND SiteLinkID LIKE '%\/$PageID\/%'
                 ORDER BY SiteSubNavLinks.SubNavID");
                 
                 $SubLinkRecordCount = mysqli_num_rows($GetSubLinks);

                 echo('  <li style="background-color: #FFFFFF;"><span>'.$row->Text.'</span></li>'."\n");
             }
             else
             {
                 echo('  <li><a href="'.$row->URL.'">'.$row->Text.'</a></li>'."\n");
             }
         }
     }

     if($CloseTags == 'Y')
     {
            echo(' </ul>'."\n");
            echo(' </div>'."\n");
     }
}

  if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
  {
  ?>
  <br />

  <div class="LeftMenu">
   <ul>
  <?php
   while($row = mysqli_fetch_object($GetSubLinks))
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
  
  $GetSubPage = mysqli_query($MainConnection,"
  SELECT SubNavID
  FROM SiteSubNavLinks
  WHERE FileName = '$StripContent'
  LIMIT 1");
  
  if(@mysqli_num_rows($GetSubPage) > 0)
  {
      $row = mysqli_fetch_object($GetSubPage);
      
      $SubNavSubPageID = $row->SubNavID;
      
      $GetSubNavSubLinks = mysqli_query($MainConnection,"
      SELECT *
      FROM SiteSubNavLinks
      WHERE MakeLive = 'Y' AND SubNavLinkID LIKE '%\/$SubNavSubPageID\/%'
      ORDER BY SiteSubNavLinks.SubNavID");
      
      $SubNavSubLinkRecordCount = mysqli_num_rows($GetSubNavSubLinks);
  }
  
  if((!isset($SubLinkRecordCount) || $SubLinkRecordCount == 0) && isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0)
  {
  ?>
  <br />

  <div class="LeftMenu">
   <ul>
  <?php
  }
    
  if(isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0)
  {
       while($row = mysqli_fetch_object($GetSubNavSubLinks))
       {
           echo('  <li><a href="'.$row->Link.'">'.$row->LinkText.'</a></li>'."\n");
       }
   }
   if((isset($SubNavSubLinkRecordCount) && $SubNavSubLinkRecordCount > 0) || (isset($SubLinkRecordCount) && $SubLinkRecordCount > 0))
   {
   ?>
   </ul>
  </div>
   <?php
   }
   ?>
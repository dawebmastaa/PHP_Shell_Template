<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && ($_SESSION['UserRole'] == '1' || $_SESSION['UserRole'] == '3'))
{
  //initialize the variables needed for this page (we name the submit button on the forms 'Operation' and use it for the switch).
    $VariableArray = array('Operation','Message','ThePages');

  //pass array to getvariables function to copy their values from URL variables to local scope (if they exist)
  GetVariables($VariableArray);

  if(isset($Operation))
  {
    switch($Operation)
    {
      //cache a particular page
      case 'Cache Page' :

      $VariableArray = array('SiteSection','SitePageMenu','SiteSubPageMenu');
      GetVariables($VariableArray);

      if(!empty($SiteSection) && is_numeric($SiteSection))
      {
          $GetSectionInfo = $MainConnection->query("
          SELECT *
          FROM SiteSections
          WHERE SectionID = $SiteSection
          LIMIT 1");

          $row = $GetSectionInfo->fetchAssociative();

          if($row != NULL)
          {
            $Directory = $row['Directory'];
            $FileName = $row['Directory'];
          }
       }

       if(!empty($SitePageMenu) && is_numeric($SitePageMenu))
       {
         $GetPageInfo = $MainConnection->query("
         SELECT SiteLinks.SiteLinkID, SiteLinks.FileName, SiteLinks.SectionID, SiteSections.Directory, SiteSections.Section
         FROM SiteLinks, SiteSections
         WHERE SiteLinkID = $SitePageMenu AND SiteLinks.SectionID = SiteSections.SectionID
         LIMIT 1");

         $row = $GetPageInfo->fetchAssociative();

         if($row != NULL)
         {
           $Directory = $row['Directory'];
           $FileName = $row['FileName'];
         }
       }

       if(!empty($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
       {
         $GetSubPageInfo = $MainConnection->query("
         SELECT SiteSubNavLinks.SubNavID, SiteSubNavLinks.FileName, SiteSubNavLinks.Link
         FROM SiteSubNavLinks
         WHERE SubNavID = $SiteSubPageMenu
         LIMIT 1");

         $row = $GetSubPageInfo->fetchAssociative();

         if($row != NULL)
         {
           $Directory = substr(strrev(strrchr(strrev($row['Link']),'/')),0,-1);
           $FileName = $row['FileName'];
         }
       }

       if(!@require_once($ApplicationPath.'/'.$Directory.'/cache/cached.php'))
       {
         $Message.='<span class="AlertText">Cache config file not found.<br /></span>';
       }
       else
       {
         if(in_array($FileName,$CachedFiles))
         {
           $Message.='<span class="AlertText">This page already cached.</span>';
         }
         else
         {
           array_push($CachedFiles,$FileName);
           foreach($CachedFiles AS $CachePages)
           {
             $ThePages.="'".$CachePages."',";
           }

           $NewPages = substr($ThePages,0,-1);
           $NewFileContents = sprintf('<?php')."\n".'//This is a list (array) of all of the pages we want cached for this directory.'."\n".sprintf('$CachedFiles=array(')."$NewPages".sprintf(');')."\n".sprintf('?>');

           if(file_put_contents($ApplicationPath.'/'.$Directory.'/cache/cached.php',$NewFileContents,LOCK_EX))
           {
             $Message.='<span class="AlertText">Page added to site cache.</span><br />';
           }
           else
           {
             $Message.='<span class="AlertText">Cache could not be updated.</span><br />';
           }
         }
       }

       break;

       //remove a particular page from the cache, and reset the cache
       case 'Remove From Cache' :

       $VariableArray = array('SiteSection','SitePageMenu','SiteSubPageMenu');
       GetVariables($VariableArray);

       if(!empty($SiteSection) && is_numeric($SiteSection))
       {
         $GetSectionInfo = $MainConnection->query("
         SELECT *
         FROM SiteSections
         WHERE SectionID = $SiteSection
         LIMIT 1");

         $row = $GetSectionInfo->fetchAssociative();

         if($row != NULL)
         {
           $Directory = $row['Directory'];
           $FileName = $row['Directory'];
         }
       }

       if(!empty($SitePageMenu) && is_numeric($SitePageMenu))
       {
         $GetPageInfo = $MainConnection->query("
         SELECT SiteLinks.SiteLinkID, SiteLinks.FileName, SiteLinks.SectionID, SiteSections.Directory, SiteSections.Section
         FROM SiteLinks, SiteSections
         WHERE SiteLinkID = $SitePageMenu AND SiteLinks.SectionID = SiteSections.SectionID
         LIMIT 1");

         $row = $GetPageInfo->fetchAssociative();

         if($row != NULL)
         {
          $Directory = $row['Directory'];
          $FileName = $row['Directory'];
         }
       }

       if(!empty($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
       {
         $GetSubPageInfo = $MainConnection->query("
         SELECT SiteSubNavLinks.SubNavID, SiteSubNavLinks.FileName, SiteSubNavLinks.Link
         FROM SiteSubNavLinks
         WHERE SubNavID = $SiteSubPageMenu
         LIMIT 1");

         $row = $GetSubPageInfo->fetchAssociative();

         if($row != NULL)
         {
          $Directory = $row['Directory'];
          $FileName = $row['Directory'];
         }
       }

       if(!@require_once($ApplicationPath.'/'.$Directory.'/cache/cached.php'))
       {
         $Message.='<span class="AlertText">Cache config file not found.<br /></span>';
       }
       else
       {
         if(in_array($FileName,$CachedFiles))
         {
           foreach($CachedFiles AS $CachePages)
           {
             if($CachePages != $FileName)
             {
               $ThePages.="'".$CachePages."',";
            }
          }

          $NewPages=substr($ThePages,0,-1);
          $NewFileContents = sprintf('<?php')."\n".'//This is a list (array) of all of the pages we want cached for this directory.'."\n".sprintf('$CachedFiles=array(')."$NewPages".sprintf(');')."\n".sprintf('?>');

          if(file_put_contents($ApplicationPath.'/'.$Directory.'/cache/cached.php',$NewFileContents,LOCK_EX))
          {
            $Message.='<span class="AlertText">Page removed from site cache.</span><br />';
            require_once($ApplicationPath.'/functions/recachefiles.php');
          }
          else
          {
            $Message.='<span class="AlertText">Cache could not be updated.</span><br />';
          }
      }
      else
      {
        $Message.='<span class="AlertText">This page is not cached.</span><br />';
      }

      }

      break;

      //remove all the cached files
      case 'Recache Site Pages' :

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      case 'Update Section Name' :

      $VariableArray = array('EditSiteSection','TheSectionID');
      GetVariables($VariableArray);

      if(isset($EditSiteSection) && isset($TheSectionID))
      {
        $UpdateSiteSection = $MainConnection->query("
        UPDATE SiteSections
        SET Section = '$EditSiteSection'
        WHERE SectionID = $TheSectionID
        LIMIT 1");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.= '<span class="AlertText">Section Updated<br /></span>';

          require_once($ApplicationPath.'/functions/recachefiles.php');
        }
        else
        {
          $Message.= '<span class="AlertText">Section could not be updated.<br />Did you make any changes?<br /></span>';
        }
      }

      break;

      //get a 'section page' for editing
      case 'Edit Content' :

      $VariableArray = array('SiteSection');
      GetVariables($VariableArray);

      if(!empty($SiteSection) && is_numeric($SiteSection))
      {
          $GetSectionInfo = $MainConnection->query("
          SELECT *
          FROM SiteSections
          WHERE SectionID = $SiteSection
          LIMIT 1");
      }

      if(mysqli_num_rows($GetSectionInfo))
      {
        $row = mysqli_fetch_object($GetSectionInfo);

        $SectionID = $row->SectionID;
        $Section = $row->Section;
        $Directory = $row->Directory;
        $SectionTitle = $row->SectionTitle;
        $SectionKeywords = $row->SectionKeywords;
        $SectionDescription = $row->SectionDescription;
        $SectionRobots = $row->SectionRobots;
        $MakeLive = $row->MakeLive;
        $MenuWidth = $row->MenuWidth;
        $FilePath = $ApplicationPath.'/'.$Directory.'/view/view'.$Directory.'.php';

        if(@file_get_contents($FilePath))
        {
          $FileContents = file_get_contents($FilePath);
        }
        else
        {
          $Message.='<span class="AlertText">Content file not found.<br /></span>';
        }
      }

      break;

      //add a new 'site section', create the directory, and set it up with the needed files, then empty the cache so it shows up
      case 'Add Section' :

      $VariableArray = array('NewSiteSectionName','NewSiteSectionDirectory','NewSiteSectionTitle','NewSiteSectionRobots','NewSiteSectionKeywords','NewSiteSectionDescription');
      GetVariables($VariableArray);

      if(!empty($NewSiteSectionName) && !empty($NewSiteSectionDirectory) && !empty($NewSiteSectionTitle) && !empty($NewSiteSectionKeywords) && !empty($NewSiteSectionDescription))
      {
        $AddSiteSection = $MainConnection->query("
        INSERT INTO SiteSections (Section, Directory, SectionTitle, SectionKeywords, SectionDescription, SectionRobots)
        VALUES ('$NewSiteSectionName','$NewSiteSectionDirectory','$NewSiteSectionTitle','$NewSiteSectionKeywords','$NewSiteSectionDescription', '$NewSiteSectionRobots')");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.= '<span class="AlertText">Section Added<br /></span>';

          //make directories
          //umask(0);
          if(mkdir($ApplicationPath.'/'.$NewSiteSectionDirectory,0755) && mkdir($ApplicationPath.'/'.$NewSiteSectionDirectory.'/model',0755) && mkdir($ApplicationPath.'/'.$NewSiteSectionDirectory.'/view',0755)){$Message.= '<span class="AlertText"><br />New directory \''.$NewSiteSectionDirectory.'\' created.<br /></span>';}else{$Message.= '<span class="AlertText"><br />New directory \''.$NewSiteSectionDirectory.'\' could not be created.<br /></span>';}
          if(mkdir($ApplicationPath.'/'.$NewSiteSectionDirectory.'/cache',0755)){$Message.= '<span class="AlertText"><br />Cache directory created</span>';}else{$Message.= '<span class="AlertText"><br />Cache directory could not be created</span>';}

          //copy files
		  if(copy($ApplicationPath.'/template/defaults/cached.php',$ApplicationPath.'/'.$NewSiteSectionDirectory.'/cache/cached.php')){chmod($ApplicationPath.'/'.$NewSiteSectionDirectory.'/cache/cached.php',0644); $Message.= '<span class="AlertText"><br />Cache file created</span>';} else{$Message.= '<span class="AlertText"><br />Cache file could not be created</span>';}
		  if(copy($ApplicationPath.'/template/defaults/index',$ApplicationPath.'/'.$NewSiteSectionDirectory.'/index')){chmod($ApplicationPath.'/'.$NewSiteSectionDirectory.'/index',0644); $Message.= '<span class="AlertText"><br />Directory index file created</span>';} else{$Message.= '<span class="AlertText"><br />Directory index file could not be created</span>';}
		  if(copy($ApplicationPath.'/template/defaults/main.php',$ApplicationPath.'/'.$NewSiteSectionDirectory.'/'.$NewSiteSectionDirectory.'.php')){chmod($ApplicationPath.'/'.$NewSiteSectionDirectory.'/'.$NewSiteSectionDirectory.'.php',0644); $Message.= '<span class="AlertText"><br />Directory default page created</span><br />';} else{$Message.= '<span class="AlertText"><br />Directory default page could not be created</span><br />';}

          if(file_put_contents($ApplicationPath.'/'.$NewSiteSectionDirectory.'/view/view'.$NewSiteSectionDirectory.'.php','<div class="SingleColumn">'."\n ".'<h1>'.$NewSiteSectionTitle.'</h1>'."\n".'</div>',LOCK_EX))
          {
            $Message.= '<span class="AlertText"><br />Default page content created. You may now edit the section content, and make it live on the site.</span><br />';
          }
          else
          {
            $Message.= '<span class="AlertText"><br />Default page content could not be created.</span><br />';
          }

        }
        else
        {
          $Message.= '<span class="AlertText">Could not add new section.<br /></span>';
        }
      }
      else
      {
        $Message.= '<span class="AlertText">Could not add new section.<br />All required data not submitted.<br /></span>';
      }

      break;

      //update an existing 'section page' and/or it's content
      case 'Update Section' :

      $VariableArray = array('SectionID','SectionFilePath','Section','SectionTitle','SectionDirectory','SectionRobots','SectionKeywords','SectionDescription','SectionEditArea','MakeSectionLive','SectionMenuWidth');
      GetVariables($VariableArray);

      if(isset($SectionID) && isset($SectionFilePath) && isset($Section) && isset($SectionTitle) && isset($SectionDirectory) && isset($SectionKeywords) && isset($SectionDescription) && isset($SectionEditArea) && isset($MakeSectionLive))
      {
        $UpdateSection = $MainConnection->query("
        UPDATE SiteSections
        SET Section = '$Section', SectionTitle = '$SectionTitle', Directory = '$SectionDirectory', SectionRobots = '$SectionRobots', SectionKeywords = '$SectionKeywords', SectionDescription = '$SectionDescription', MakeLive = '$MakeSectionLive', MenuWidth = '$SectionMenuWidth'
        WHERE SectionID = $SectionID
        LIMIT 1");
      }
      else
      {
        $Message.='<span class="AlertText">Section could not be updated.<br />All required information was not submitted<br /></span>';
      }

      if(mysqli_affected_rows($MainConnection))
      {
        $Message.='<span class="AlertText">Database record updated.<br></span>';
      }
      else
      {
        $Message.='<span class="AlertText">Database record not updated.<br />(Perhaps you didn\'t make any changes?)<br></span>';
      }

      if(file_put_contents($SectionFilePath,stripslashes($SectionEditArea),LOCK_EX))
      {
        $Message.='<span class="AlertText">Section content updated<br /></span>';
      }
      else
      {
        $Message.='<span class="AlertText">Section content could not be updated<br /></span>';
      }

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      //change the order of how the 'site sections' display (main navigation)
      case 'Update Section Order' :

      $VariableArray = array('PageOrder','SectionOrder');
      GetVariables($VariableArray);

      $UpdateDisplayOrder = explode(',',$SectionOrder);
      $i = 1;
      $RowsUpdated = 'No';

      foreach($UpdateDisplayOrder AS $value)
      {
        //echo('Directory: '.$value.' Value: '.$i.'<br />');
        $UpdateSectionOrder = $MainConnection->query("
        UPDATE SiteSections
        SET DisplayOrder = $i
        WHERE SiteSections.Directory = '$value'
        LIMIT 1");

        $i++;

        if(mysqli_affected_rows($MainConnection))
        {
          $RowsUpdated = 'Yes';
        }
      }

      $Message.='<span class="AlertText">Display Order Updated: '.$RowsUpdated.'<br /></span>';

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      //remove a 'site section' and all of its files, directories and database records, then empty the cache so they don't show up
      case 'Delete Section' :

      $VariableArray = array('SectionFilePath','SectionID','SectionDirectory');
      GetVariables($VariableArray);

      if(!empty($SectionFilePath) && !empty($SectionID) && !empty($SectionDirectory))
      {
        $FilePath2 = str_replace('view/view','',$SectionFilePath);
        $FilePath3 = str_replace('view/view','model/model',$SectionFilePath);

        $DeleteSection = $MainConnection->query("
        DELETE FROM SiteSections
        WHERE (SiteSections.SectionID = $SectionID)");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">Section removed from database.<br /></span>';

          if(@unlink($SectionFilePath) && @unlink($FilePath2))
          {
            @unlink($FilePath3);
            $Message.='<span class="AlertText">Pages deleted.<br /></span>';
          }
          else
          {
            $Message.='<span class="AlertText">Pages could not be found to delete.<br /></span>';
          }
        }

        $DeletePages = $MainConnection->query("
        DELETE FROM SiteLinks
        WHERE (SiteLinks.SectionID = $SectionID)");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">Pages deleted from database.<br /></span>';
        }
        else
        {
          $Message.='<span class="AlertText">No pages deleted from database.<br /></span>';
        }

        $DeleteSubPages = $MainConnection->query("
        DELETE FROM SiteSubNavLinks
        WHERE (SiteSubNavLinks.SectionID = $SectionID)");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">SubPages deleted from database.<br /></span>';
        }
        else
        {
          $Message.='<span class="AlertText">No SubPages deleted from database.<br /></span>';
        }

        require_once($ApplicationPath.'/functions/recachefiles.php');

        require_once($ApplicationPath.'/functions/deletesitesection.php');
        RemoveDir($ApplicationPath.'/'.$SectionDirectory);
      }

      break;

      //get a 'regular' page for edting
      case 'Edit Page' :

      $VariableArray = array('SiteSectionMenu','SitePageMenu');
      GetVariables($VariableArray);

      if(!empty($SitePageMenu) && is_numeric($SitePageMenu))
      {
        $GetPageInfo = $MainConnection->query("
        SELECT *
        FROM SiteLinks
        WHERE SiteLinkID = $SitePageMenu
        LIMIT 1");

        if(mysqli_num_rows($GetPageInfo))
        {
            $row = mysqli_fetch_object($GetPageInfo);

            $PageID = $row->SiteLinkID;
            $LinkText = $row->LinkText;
            $PageURL = $row->Link;
            $LinkTitle = $row->LinkTitle;
            $PageTitle = $row->PageTitle;
            $PageRobots = $row->PageRobots;
            $PageKeywords = $row->PageKeywords;
            $PageDescription = $row->PageDescription;
            $MakeLive = $row->MakeLive;

            $Directory = substr($row->Link,0,strpos($row->Link,'/'));
            $FilePath = $ApplicationPath.'/'.$Directory.'/view/view'.$row->FileName.'.php';

            if(@file_get_contents($FilePath))
            {
                $FileContents = file_get_contents($FilePath);
            }
            else
            {
                $Message.='<span class="AlertText">Content file not found.<br /></span>';
            }
        }
      }

      break;

      //add a new 'regular' page to an existing 'site section' (don't re-cache yet because the content might not be done)
      case 'Add New Page' :

      $VariableArray = array('NewPageSectionID','NewSitePage','NewSitePageUrl','NewSiteLinkTitle','NewSitePageFileName','NewSitePageTitle', 'NewSitePageRobots','NewSitePageKeywords','NewSitePageDescription');
      GetVariables($VariableArray);

      if(!empty($NewPageSectionID) && !empty($NewSitePage) && !empty($NewSitePageUrl) && !empty($NewSiteLinkTitle) && !empty($NewSitePageFileName) && !empty($NewSitePageTitle) && !empty($NewSitePageKeywords) && !empty($NewSitePageDescription))
      {
        $NewSitePageUrl.= $NewSitePageFileName.'/';

         $AddPageToSection = $MainConnection->query("
         INSERT INTO SiteLinks (SectionID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription, PageRobots)
         VALUES ($NewPageSectionID,'$NewSitePage','$NewSitePageUrl','$NewSiteLinkTitle','$NewSitePageFileName','$NewSitePageTitle','$NewSitePageKeywords','$NewSitePageDescription','$NewSitePageRobots')");

         if(mysqli_affected_rows($MainConnection))
         {
           $Message.='<span class="AlertText">New page added to database.<br /></span>';
           $DirectoryName = substr(substr_replace($NewSitePageUrl,'/',strpos($NewSitePageUrl,'/')),0,-1);

           if(copy($ApplicationPath.'/template/defaults/main.php',$ApplicationPath.'/'.$DirectoryName.'/'.$NewSitePageFileName.'.php'))
           {
             $Message.= '<span class="AlertText"><br />Page created<br />You may now edit the page and make it live.<br /></span>';
           }

           file_put_contents($ApplicationPath.'/'.$DirectoryName.'/view/view'.$NewSitePageFileName.'.php','<div class="SingleColumn">'."\n ".'<h1>'.$NewSitePageTitle.'</h1>'."\n".'</div>',LOCK_EX);
         }
      }
      else
      {
        $Message.= '<span class="AlertText">Could not add page.<br />All required information not submitted.<br /></span>';
      }

      break;

      //update a 'regular' site page
      case 'Update Page' :

      $VariableArray = array('FilePath','PageID','LinkTitle','LinkText','PageTitle', 'PageRobots','PageKeywords','PageDescription','PageURL','PageEditArea','MakeLive');
      GetVariables($VariableArray);

      if(isset($PageID) && isset($LinkTitle) && isset($PageTitle) && isset($PageKeywords) && isset($PageDescription) && isset($PageURL) && isset($PageEditArea) && isset($MakeLive))
      {
        $UpdatePage = $MainConnection->query("
        UPDATE SiteLinks
        SET LinkTitle = '$LinkTitle', LinkText = '$LinkText', Link = '$PageURL', PageTitle = '$PageTitle', PageKeywords = '$PageKeywords', PageDescription = '$PageDescription', PageRobots= '$PageRobots', MakeLive = '$MakeLive'
        WHERE SiteLinkID = $PageID
        LIMIT 1");
      }
      else
      {
        $Message.='<span class="AlertText">Page could not be updated.<br />All required information was not submitted<br /></span>';
      }

      if(mysqli_affected_rows($MainConnection))
      {
        $Message.='<span class="AlertText">Database record updated.<br></span>';
      }
      else
      {
        $Message.='<span class="AlertText">Database record not updated.<br />(Perhaps you didn\'t make any changes?)<br></span>';
      }

      if(file_put_contents($FilePath,stripslashes($PageEditArea),LOCK_EX))
      {
        $Message.='<span class="AlertText">Page updated<br /></span>';
      }
      else
      {
        $Message.='<span class="AlertText">Page could not be updated<br /></span>';
      }

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      //delete a 'regular' site page, all of its content and data, then clean out the cache
      case 'Delete Page' :

      $VariableArray = array('FilePath','PageID');
      GetVariables($VariableArray);

      if(!empty($FilePath) && !empty($PageID))
      {
        $FilePath2 = str_replace('view/view','',$FilePath);
        $FilePath3 = str_replace('view/view','model/model',$FilePath);

        $DeletePage = $MainConnection->query("
        DELETE FROM SiteLinks
        WHERE SiteLinkID = $PageID
        LIMIT 1");

        if(mysqli_affected_rows($MainConnection) === 1)
        {
          $Message.='<span class="AlertText">Database record deleted.<br /></span>';

          if(@unlink($FilePath) && @unlink($FilePath2))
          {
            @unlink($FilePath3);
            $Message.='<span class="AlertText">Page deleted.<br /></span>';
          }
          else
          {
            $Message.='<span class="AlertText">Page could not be found to delete.<br /></span>';
          }
        }
      }

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      //edit a special 'sub-page' ... we assign links on specific pages to these.
      case 'Edit SubPage' :

      $VariableArray = array('SiteSubPageMenu');
      GetVariables($VariableArray);

      $GetSubPage = $MainConnection->query("
      SELECT *
      FROM SiteSubNavLinks
      WHERE SubNavID = $SiteSubPageMenu
      LIMIT 1");

      if(mysqli_num_rows($GetSubPage))
      {
        $row = mysqli_fetch_object($GetSubPage);

        $SubPageID = $row->SubNavID;
        $LinkText = $row->LinkText;
        $PageURL =  $row->Link;
        $Directory = substr($row->Link,0,strpos($row->Link,'/'));
        $LinkTitle = $row->LinkTitle;
        $FileName = $row->FileName;
        $PageTitle = $row->PageTitle;
        $PageRobots = $row->PageRobots;
        $PageKeywords = $row->PageKeywords;
        $PageDescription = $row->PageDescription;
        $MakeLive = $row->MakeLive;
        $FilePath = $ApplicationPath.'/'.$Directory.'/view/view'.$FileName.'.php';

        if(@file_get_contents($FilePath))
        {
          $FileContents = file_get_contents($FilePath);
        }
        else
        {
          $Message.='<span class="AlertText">Content file not found.<br /></span>';
        }
      }

      break;

      //this is where we decide which pages get links to a 'sub-page'.
      case 'Add Link To Site Pages' :

      $VariableArray = array('SiteSubPageMenu');
      GetVariables($VariableArray);

      if(!empty($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
      {
        $GetSubPage = $MainConnection->query("
        SELECT SiteLinkID
        FROM SiteSubNavLinks
        WHERE SubNavID = $SiteSubPageMenu
        LIMIT 1");

        $row = mysqli_fetch_object($GetSubPage);

        $PageList = explode(' ',trim(str_replace('/','',$row->SiteLinkID)));
        $PageCount = count($PageList);
      }

      break;

      //this is where we decide which pages get links to a 'sub-page'.
      case 'Add Link To Site SubPages' :

      $VariableArray = array('SiteSubPageMenu');
      GetVariables($VariableArray);

      if(!empty($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
      {
        $GetSubPage = $MainConnection->query("
        SELECT SubNavLinkID
        FROM SiteSubNavLinks
        WHERE SubNavID = $SiteSubPageMenu
        LIMIT 1");

        $row = $GetSubPage->fetchAssociative();

        $SubPageList = explode(' ',trim(str_replace('/','',$row['SubNavLinkID'])));
        $SubPageCount = substr_count($SubPageList,' ') + 1;
      }

      break;

      //update the content/data for a sub-page, then clear the cache
      case 'Update SubPage' :

      $VariableArray = array('SubPageID','FilePath','SubPageName','SubPageLinkTitle','SubPageURL','SubPageTitle','SubPageRobots','SubPageKeywords','SubPageDescription','SubPageEditArea','MakeLive');
      GetVariables($VariableArray);

      if(isset($SubPageID) && is_numeric($SubPageID) && isset($FilePath) && isset($SubPageName) && isset($SubPageURL) && isset($SubPageLinkTitle) && isset($SubPageTitle) && isset($SubPageKeywords) && isset($SubPageDescription) && isset($SubPageEditArea) && isset($MakeLive))
      {
        $UpdateSubPage = $MainConnection->query("
        UPDATE SiteSubNavLinks
        SET LinkText = '$SubPageName', Link = '$SubPageURL', LinkTitle = '$SubPageLinkTitle', PageTitle = '$SubPageTitle', PageKeywords = '$SubPageKeywords', PageDescription = '$SubPageDescription', PageRobots = '$SubPageRobots', MakeLive = '$MakeLive'
        WHERE SubNavID = $SubPageID");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">SubPage database record updated</span><br />';
        }
        else
        {
          $Message.='<span class="AlertText">SubPage database record could not be updated.<br />(Perhaps you didn\'t make any changes?)</span><br />';
        }
      }
      else
      {
        $Message.='<span class="AlertText">Page could not be updated.<br />All required information was not submitted<br /></span>';
      }

      if(file_put_contents($FilePath,stripslashes($SubPageEditArea),LOCK_EX))
      {
        $Message.='<span class="AlertText">Page updated<br /></span>';
      }
      else
      {
        $Message.='<span class="AlertText">Page could not be updated<br /></span>';
      }

      require_once($ApplicationPath.'/functions/recachefiles.php');


      break;

      //remove a sub-page and all its files and data, then clear the cache.
      case 'Delete SubPage' :

      $VariableArray = array('FilePath','SubPageID');
      GetVariables($VariableArray);

      if(!empty($FilePath) && !empty($SubPageID))
      {
        $FilePath2 = str_replace('view/view','',$FilePath);
        $FilePath3 = str_replace('view/view','model/model',$FilePath);

        $DeletePage = $MainConnection->query("
        DELETE FROM SiteSubNavLinks
        WHERE SubNavID = $SubPageID
        LIMIT 1");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">SubPage deleted from database.<br /></span>';

          if(@unlink($FilePath) && @unlink($FilePath2))
          {
            @unlink($FilePath3);
            $Message.='<span class="AlertText">SubPage files deleted.<br /></span>';
          }
          else
          {
            $Message.='<span class="AlertText">SubPage could not be found to delete.<br /></span>';
          }
        }
      }

      require_once($ApplicationPath.'/functions/recachefiles.php');

      break;

      //update which pages have links to a certain sub-page, then clear the cache
      case 'Update SubPage Links' :

      $VariableArray = array('AddLinkSubPageID', 'Pages');
      GetVariables($VariableArray);

      if(!empty($_POST['SubPageLinks']) && isset($AddLinkSubPageID) && is_numeric($AddLinkSubPageID))
      {
        sort($_POST['SubPageLinks']);

        foreach($_POST['SubPageLinks'] AS $key => $value){$Pages .= '/'.$value.'/ ';}
        rtrim($Pages);

        $UpdateSubPageLinks = $MainConnection->query("
        UPDATE SiteSubNavLinks
        SET SiteLinkID = '$Pages'
        WHERE SubNavID = $AddLinkSubPageID
        LIMIT 1");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">SubPage links updated.<br /></span>';
          require_once($ApplicationPath.'/functions/recachefiles.php');
        }
        else
        {
          $Message.='<span class="AlertText">SubPage links could not be updated.<br /></span>';
        }
      }

      break;

      //update which subpages have links to a certain other sub-page, then clear the cache
      case 'Update SubPage Sub-Links' :

      $VariableArray = array('AddSubLinkSubPageID', 'Pages');
      GetVariables($VariableArray);

      if(!empty($_POST['SubPageSubLinks']) && isset($AddSubLinkSubPageID) && is_numeric($AddSubLinkSubPageID))
      {
        sort($_POST['SubPageSubLinks']);

        foreach($_POST['SubPageSubLinks'] AS $key => $value){$Pages .= '/'.$value.'/ ';}
        rtrim($Pages);

        $UpdateSubPageLinks = $MainConnection->query("
        UPDATE SiteSubNavLinks
        SET SubNavLinkID = '$Pages'
        WHERE SubNavID = $AddSubLinkSubPageID
        LIMIT 1");

        if(mysqli_affected_rows($UpdateSubPageLinks))
        {
          $Message.='<span class="AlertText">SubPage sub-links updated.<br /></span>';
          require_once($ApplicationPath.'/functions/getnavigationlinksadmin.php');
          require_once($ApplicationPath.'/functions/recachefiles.php');
        }
        else
        {
          $Message.='<span class="AlertText">SubPage sublinks could not be updated.<br /></span>';
        }
      }

      break;

      //remove all links to sub-pages
      case 'Remove All Page Links' :

      $VariableArray = array('SiteSubPageMenu');
      GetVariables($VariableArray);

      if(isset($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
      {
        $RemoveSubPageLinks = $MainConnection->query("
        UPDATE SiteSubNavLinks
        SET SiteLinkID = ''
        WHERE SubNavID = $SiteSubPageMenu
        LIMIT 1");

        if(mysqli_affected_rows($RemoveSubPageLinks))
        {
            $Message.='<span class="AlertText">All Links to this sub-page removed.<br /></span>';
            require_once($ApplicationPath.'/functions/recachefiles.php');
        }
        else
        {
          $Message.='<span class="AlertText">Links to this sub-page could not be removed.<br /></span>';
        }
      }
      else
      {
        $Message.='<span class="AlertText">Oops, something went wrong.<br /></span>';
      }

      break;

      //remove all sub-links to sub-pages
      case 'Remove All Subpage Links' :

      $VariableArray = array('SiteSubPageMenu');
      GetVariables($VariableArray);

      if(isset($SiteSubPageMenu) && is_numeric($SiteSubPageMenu))
      {
        $RemoveSubPageSubLinks = $MainConnection->query("
        UPDATE SiteSubNavLinks
        SET SubNavLinkID = ''
        WHERE SubNavID = $SiteSubPageMenu
        LIMIT 1");

        if(mysqli_affected_rows($RemoveSubPageSubLinks))
        {
          $Message.='<span class="AlertText">All sub-page sub-links removed.<br /></span>';
          require_once($ApplicationPath.'/functions/recachefiles.php');
        }
        else
        {
          $Message.='<span class="AlertText">SubPage sublinks could not be updated.<br /></span>';
        }
      }
      else
      {
        $Message.='<span class="AlertText">Oops, something went wrong.<br /></span>';
      }

      break;

      //create a new sub-page and all required files/data records
      case 'Add New SubPage' :

      $VariableArray = array('NewSubPageSectionID','NewSiteSubPage','NewSiteSubPageUrl','NewSubPageDirectory','NewSiteSubLinkTitle','NewSiteSubPageFileName','NewSiteSubPageTitle','NewSiteSubPageRobots','NewSiteSubPageKeywords','NewSiteSubPageDescription');
      GetVariables($VariableArray);

      if(!empty($NewSiteSubPage) && !empty($NewSiteSubPageUrl) && !empty($NewSiteSubLinkTitle) && !empty($NewSiteSubPageFileName) && !empty($NewSiteSubPageTitle) && !empty($NewSiteSubPageKeywords) && !empty($NewSiteSubPageDescription))
      {
        $NewSiteSubPageUrl.= $NewSiteSubPageFileName;

        $AddSubPage = $MainConnection->query("
        INSERT INTO SiteSubNavLinks (SectionID, LinkText, Link, LinkTitle, FileName, PageTitle, PageKeywords, PageDescription, PageRobots)
        VALUES ('$NewSubPageSectionID','$NewSiteSubPage','$NewSiteSubPageUrl','$NewSiteSubLinkTitle','$NewSiteSubPageFileName','$NewSiteSubPageTitle','$NewSiteSubPageKeywords','$NewSiteSubPageDescription','$NewSiteSubPageRobots')");

        if(mysqli_affected_rows($MainConnection))
        {
          $Message.='<span class="AlertText">New SubPage added to database.<br /></span>';

          if(copy($ApplicationPath.'/template/defaults/main.php',$ApplicationPath.'/'.$NewSubPageDirectory.'/'.$NewSiteSubPageFileName.'.php'))
          {
            $Message.= '<span class="AlertText"><br />Page created<br />You may now edit the page and make it live.<br /></span>';
          }

          file_put_contents($ApplicationPath.'/'.$NewSubPageDirectory.'/view/view'.$NewSiteSubPageFileName.'.php','<div class="SingleColumn">'."\n ".'<h1>'.$NewSiteSubPageTitle.'</h1>'."\n".'</div>',LOCK_EX);
        }
      }
      else
      {
        $Message.= '<span class="AlertText">Could not add SubPage.<br />All required information not submitted.<br /></span>';
      }

      break;

      default :

      break;
    }
  }
}
?>

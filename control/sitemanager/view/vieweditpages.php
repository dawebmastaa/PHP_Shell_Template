<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && ($_SESSION['UserRole'] == '1' || $_SESSION['UserRole'] == '3'))
{
?>
 <script>
 <!--
 let divList = ["StartDiv","Recache", "AddPage", "AddNewPage", "AddNewSubPage", "EditSiteSection", "NewSectionDiv", "EditSiteSections", "EditSitePages", "SectionOrdering", "EditPage", "EditSection", "AddSiteSectionForm", "EditSubPagesBlurb", "EditSubPages", "EditSubPage", "AddSubPages", "AddSubPageLinks"];
 -->
 </script>
  <header id="List" class="list SiteBuilder"><?php if(isset($Message)){echo($Message);} ?></header>

  <div id="StartDiv">
   <h1>Manage Site Content</h1>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="Start">
    <input type="submit" class="SmallWhiteButton" value="Site Sections" title="This is where you create or edit main 'sections' or directories for the site" onclick="ShowPageContent(divList, 'sections'); return false" />
    <input type="submit" class="SmallWhiteButton" value="Site Pages" title="This is where you create or edit individual pages on the site. These pages will display in the drop-down navigation menus." onclick="ShowPageContent(divList, 'pages'); return false"  />
    <input type="submit" class="SmallWhiteButton" value="Site Sub-Pages" title="This is where you create or edit pages that appear in the sub-navigation of individual pages." onclick="ShowPageContent(divList, 'subpages'); return false" />
    <input type="submit" class="SmallWhiteButton" value="Reset" title="Reset this page to the default display" onclick="ShowPageContent(divList, 'start'); return false" />
   </form>
  </div>

  <div id="Recache" style="display: <?php if(isset($Operation) && ($Operation == 'Edit Page') || $Operation == 'Edit SubPage' || $Operation == 'Edit Content'){echo('none');}else{echo('block');}?>">
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="RecachePages">
    <input type="submit" class="SmallWhiteButton" title="Click here to delete all cached pages on the site" name="Operation" value="Recache Site Pages" />
   </form>
  </div>

  <div id="AddPage" style="display: none;">
   <h2>Add Page To A Section</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SitePageEdit">
       <label for="SiteSection">Choose A Section</label>
     <select name="SiteSection" onchange="changeStyle('AddPageButton','display','block');">
        <option value="">Choose A Site Section</option>
    <?php
     mysqli_data_seek($GetSiteSectionsAdmin,0);
    while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
    {
      echo('    <option value="'.$row->SectionID.'">'.$row->Section.' | '.$row->Directory.'</option>'."\n".'    ');
    }
  ?>
   </select><br />
   <input type="submit" class="SmallWhiteButton" value="Add Page" id="AddPageButton" style="display: none;" onclick="ShowPageContent(divList, 'addpage'); document.SitePageAdd.NewPageSectionID.value = document.SitePageEdit.SiteSection.options[SiteSection.selectedIndex].value; document.SitePageAdd.NewSitePageUrl.value = document.SitePageEdit.SiteSection.options[SiteSection.selectedIndex].text.split(' | ',2).pop()+'/index/content/'; return false;" />
   </form>
  </div>

  <div id="AddNewPage" style="display: none;">
   <h2>Add A New Page</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SitePageAdd" id="SitePageAdd">
    <input type="hidden" name="NewPageSectionID" id="NewPageSectionID" value="" />

    <label for="NewSitePage">New Page Name (link text)</label>
    <input type="text" name="NewSitePage" id="NewSitePage" />

    <input type="hidden" name="NewSitePageUrl" id="NewSitePageUrl" />

    <label for="NewSiteLinkTitle">New Page Link Title (mouseover title, NOT page title)</label>
    <input type="text" name="NewSiteLinkTitle" id="NewSiteLinkTitle" />

    <label for="NewSitePageFileName">New Page File Name (all one word, lower case ONLY)</label>
    <input type="text" name="NewSitePageFileName" id="NewSitePageFileName" />

    <label for="NewSitePageTitle">New Page Title (Meta page title)</label>
    <input type="text" name="NewSitePageTitle" id="NewSitePageTitle" />

    <label for="NewSitePageRobots">New Page robots (Meta robots; will default to 'index, follow')</label>
    <input type="text" name="NewSitePageRobots" id="NewSitePageRobots" />

    <label for="NewSitePageKeywords">New Page Keywords (Meta keywords)</label>
    <textarea name="NewSitePageKeywords" id="NewSitePageKeywords" rows="10"></textarea><br  /><br  />

    <label for="NewSitePageDescription">New Page Description (Meta description)</label>
    <textarea name="NewSitePageDescription" id="NewSitePageDescription" rows="10"></textarea><br /><br  />

    <input type="submit" name="Operation" value="Add New Page" class="SmallWhiteButton" />
   </form>
  </div>

  <div id="AddNewSubPage" style="display: none;">
   <h2>Add A New SubPage</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSubPageAdd" id="SiteSubPageAdd">
    <input type="hidden" name="NewSubPageSectionID" id="NewSubPageSectionID" value="" />
    <input type="hidden" name="NewSubPageDirectory" id="NewSubPageDirectory" value="" />
    <input type="hidden" name="NewSiteSubPageUrl" id="NewSiteSubPageUrl" value="" />

    <label for="NewSiteSubPage">Name (link text)</label>
    <input type="text" name="NewSiteSubPage" id="NewSiteSubPage" />

    <label for="NewSiteSubLinkTitle">Link Title (mouseover title, NOT page title)</label>
    <input type="text" name="NewSiteSubLinkTitle" id="NewSiteSubLinkTitle" value="" />

    <label for="NewSiteSubPageFileName">File Name (NO spaces, lower case ONLY)</label>
    <input type="text" name="NewSiteSubPageFileName" id="NewSiteSubPageFileName" />

    <label for="NewSiteSubPageTitle">Title (Meta page title)</label>
    <input type="text" name="NewSiteSubPageTitle" id="NewSiteSubPageTitle" />

    <label for="NewSiteSubPageRobots">New Sub-Page robots (Meta robots; will default to 'index, follow')</label>
    <input type="text" name="NewSiteSubPageRobots" id="NewSiteSubPageRobots" />

    <label for="NewSiteSubPageKeywords">Keywords (Meta keywords)</label>
    <textarea name="NewSiteSubPageKeywords" id="NewSiteSubPageKeywords" rows="10" cols=""></textarea><br  /><br  />

    <label for="NewSiteSubPageDescription">Description (Meta description)</label>
    <textarea name="NewSiteSubPageDescription" id="NewSiteSubPageDescription" rows="20" cols=""></textarea><br /><br  />

    <input type="submit" name="Operation" value="Add New SubPage" class="SmallWhiteButton" />
   </form>
  </div>

  <div id="EditSiteSection" style="display: none;">
   <h2>Edit Site Section</h2>

   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSectionEdit">
    <label for="SiteSection">Choose A Section To Edit</label>
    <select name="SiteSection" id="SiteSection" onchange="changeStyle('EditNameButton','display','inline'); changeStyle('EditContentButton','display','inline'); changeStyle('SectionOrderButton','display','inline'); changeStyle('ManageCacheButton','display','inline'); changeStyle('UnCacheButton','display','inline');">
        <option value="">Choose A Site Section</option>
    <?php
     mysqli_data_seek($GetSiteSectionsAdmin,0);
    while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
    {
      echo('    <option value="'.$row->SectionID.'">'.$row->Section.'</option>'."\n".'    ');
    }
  ?>
    </select><br />
    <input type="submit" name="Operation" value="Edit Name" class="SmallWhiteButton" id="EditNameButton" style="display: none;" onclick="document.SiteSectionEdit2.TheSectionID.value = document.SiteSectionEdit.SiteSection.options[SiteSection.selectedIndex].value; changeStyle('EditSiteSections','display','block'); changeStyle('EditSiteSections','visibility','visible'); changeStyle('NewSectionDiv','display','none'); document.SiteSectionEdit2.EditSiteSection.value = document.SiteSectionEdit.SiteSection.options[SiteSection.selectedIndex].text; return false;" />
    <input type="submit" name="Operation" value="Edit Content" class="SmallWhiteButton" id="EditContentButton" style="display: none;" /><br  />
    <input type="submit" name="Operation" value="Change Section Display Order" class="SmallWhiteButton" id="SectionOrderButton" style="display: none;" onclick="changeStyle('SectionOrdering','display','block'), changeStyle('SectionOrdering','visibility','visible', changeStyle('NewSectionDiv','display','none')); return false;" /><br  />
    <input type="submit" name="Operation" value="Cache Page" class="SmallWhiteButton" id="ManageCacheButton" style="display: none;" onclick="if(confirm('Are you sure you want to add this page to the site cache?')) return true,submit(); else return false;" /><br  />
    <input  type="submit" name="Operation" value="Remove From Cache" class="SmallWhiteButton" id="UnCacheButton" style="display: none;" onclick="if(confirm('Are you sure you want to remove this page from the site cache?')) return true,submit(); else return false;" />
   </form>
  </div>

  <div id="NewSectionDiv" style="display: none;">
   <h2>Add A Site Section</h2>

   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSectionAdd">

    <label for="NewSiteSection">Enter The New Section Name</label>
    <input type="text" name="NewSiteSection" id="NewSiteSection" onfocus="changeStyle('AddSectionButton','display','block');" />

    <input type="submit" name="Operation" id="AddSectionButton"  style="display: none;" value="Add Site Section" class="SmallWhiteButton" onclick="changeStyle('NewSectionDiv','display','none'); changeStyle('EditSiteSection','display','none'); changeStyle('AddSiteSectionForm','display','block'); changeStyle('AddSiteSectionForm','visibility','visible');  document.AddSiteSection.NewSiteSectionName.value = document.SiteSectionAdd.NewSiteSection.value; return false" />
   </form>

  </div>

  <div id="EditSiteSections" style="display: none;">
   <h2>Update Section</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSectionEdit2" id="SiteSectionEdit2">
    <input type="hidden" name="TheSectionID" id="TheSectionID" value="" />

    <label for="EditSiteSection">Edit Section Name</label>
    <input type="text" name="EditSiteSection" /><br />

    <input type="submit" name="Operation" value="Update Section Name" class="SmallWhiteButton" />
   </form>
  </div>

  <div id="EditSitePages" style="display: none;">
   <h2>Edit Site Pages</h2>
   <?php
    if(isset($SectionRecordCountAdmin) && $SectionRecordCountAdmin > 0)
    {
   ?>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSectionForm">
       <label for="SiteSectionMenu">Choose A Section</label>
       <select name="SiteSectionMenu" id="SiteSectionMenu" onchange="UpdatePages(this.selectedIndex);">
        <option value="">Choose A Site Section</option>
    <?php
     mysqli_data_seek($GetSiteSectionsAdmin,0);
    while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
    {
      echo('    <option value="'.$row->SectionID.'">'.$row->Section.'</option>'."\n".'    ');
    }
  ?>
   </select><br />
  <?php
  }
   ?>
    <label for="SitePageMenu" id="SitePageMenuLabel">Then Choose The Page</label>
    <select name="SitePageMenu" id="SitePageMenu" onchange="changeStyle('EditPageButton','display','inline'); changeStyle('ManagePageCacheButton','display','inline'); changeStyle('UnCachePageButton','display','inline');">
     <option  value="">Choose A Section First</option>
    </select><br />
    <input type="submit" class="SmallWhiteButton" name="Operation" id="EditPageButton" value="Edit Page" style="display: none;" /><br  /><br  />
    <input type="submit" name="Operation" value="Cache Page" class="SmallWhiteButton" id="ManagePageCacheButton" style="display: none;" onclick="if(confirm('Are you sure you want to add this page to the site cache?')) return true,submit(); else return false;" /><br  /><br />
    <input  type="submit" name="Operation" value="Remove From Cache" class="SmallWhiteButton" id="UnCachePageButton" style="display: none;" onclick="if(confirm('Are you sure you want to remove this page from the site cache?')) return true,submit(); else return false;" />
   </form>
  </div><br />

  <div id="SectionOrdering" style="display: none">
   <h2>Update Display Order</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="ReorderSections" id="ReorderSections">
     <label for="PageOrder">Hit 'up' or 'down' after choosing a Section to re-order it.</label>
     <select name="PageOrder" id="PageOrder" size="5" style="width: 300px;">
<?php
  mysqli_data_seek($GetSiteSectionsAdmin,0);
  while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
  {
    echo('    <option value="'.$row->SectionID.'">'.$row->Directory.'</option>'."\n".'    ');
  }
  mysqli_data_seek($GetSiteSectionsAdmin,0);
?>
        </select>

        <br />
        <input type="button" value="up" class="SmallWhiteButton" onclick="move(this.form,this.form.PageOrder,-1)" />
        <input type="button" value="down" class="SmallWhiteButton" onclick="move(this.form,this.form.PageOrder,+1)" /><br /><br />

        <input type="hidden" name="SectionOrder" id="SectionOrder" value="" />
        <input type="submit" name="Operation" id="Operation" class="SmallWhiteButton" value="Update Section Order" />
    </form>
  </div>

  <div id="EditPage" style="<?php if(isset($Operation) && $Operation == 'Edit Page'){echo('display: block;');}else{echo('display: none;');}?>">
   <h2 style="padding-top: 0px; padding-bottom: 10px;">Edit Page</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="PageEditForm">
    <input type="hidden" name="PageID" id="PageID" value="<?php if(!empty($PageID)){echo($PageID);} ?>" />
    <input type="hidden" name="FilePath" id="FilePath" value="<?php if(!empty($FilePath)){echo($FilePath);} ?>" />

    <label for="LinkText">Link Text</label>
    <input type="text" name="LinkText" id="LinkText" value="<?php if(!empty($LinkTitle)){echo(htmlentities($LinkText));} ?>" />

    <label for="LinkTitle">Link Title (mouseover text)</label>
    <input type="text" name="LinkTitle" id="LinkTitle" value="<?php if(!empty($LinkTitle)){echo(htmlentities($LinkTitle));} ?>" />

    <label for="PageTitle">Page Title (meta title)</label>
    <input type="text" name="PageTitle" id="PageTitle" value="<?php if(!empty($PageTitle)){echo(htmlentities($PageTitle));} ?>" />

    <label for="PageRobots">Page robots (meta robots; defaults to 'index, follow')</label>
    <input type="text" name="PageRobots" id="PageRobots" value="<?php if(!empty($PageRobots)){echo(htmlentities($PageRobots));} ?>" />

    <label for="PageKeywords">Page Keywords (meta keywords)</label>
    <textarea name="PageKeywords" id="PageKeywords" rows="20" cols=""><?php if(!empty($PageKeywords)){echo(htmlentities($PageKeywords));} ?></textarea>

    <label for="PageDescription">Page Description (meta description)</label>
    <textarea name="PageDescription" id="PageDescription" rows="20" cols=""><?php if(!empty($PageDescription)){echo(htmlentities($PageDescription));} ?></textarea>

    <label for="PageURL">Page URL</label>
    <input type="text" name="PageURL" id="PageURL" value="<?php if(!empty($PageURL)){echo(htmlentities($PageURL));} ?>" />

    <label for="PageEditArea">Page Content</label>
    <textarea name="PageEditArea" id="PageEditArea" rows="20" cols=""><?php if(!empty($FileContents)){echo(htmlentities(stripslashes($FileContents)));}?></textarea>

    <label>Make this page live?</label>
    <input name="MakeLive" type="radio" value="Y" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'Y'){echo(' checked="checked"');}?> />Yes
    <input name="MakeLive" type="radio" value="N" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'N'){echo(' checked="checked"');}?> />No<br /><br />

    <input  type="submit" name="Operation" class="SmallWhiteButton" value="Update Page" />
    <input  type="submit" name="Operation" class="SmallWhiteButton" value="Delete Page" onclick="if(confirm('Are you sure you want to delete this page?')) return true,submit(); else return false;" />
    <input  type="reset" name="Operation" class="SmallWhiteButton" value="Reset Form" />
   </form>
  </div>

  <div id="EditSection" style="<?php if(isset($Operation) && $Operation == 'Edit Content'){echo('display: block;');}else{echo('display: none;');}?>">
   <h2>Edit Section</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SectionEditForm">
    <input type="hidden" name="SectionID" id="SectionID" value="<?php if(!empty($SectionID)){echo($SectionID);} ?>" />
    <input type="hidden" name="SectionFilePath" id="SectionFilePath" value="<?php if(!empty($FilePath)){echo($FilePath);} ?>" />
    <input type="hidden" name="SectionDirectory" value="<?php if(!empty($Directory)){echo(htmlentities($Directory));} ?>" />

    <label for="Section">Link Text</label>
    <input type="text" name="Section" id="Section" value="<?php if(!empty($Section)){echo(htmlentities($Section));} ?>" />

    <label for="SectionTitle">Section Page Title</label>
    <input type="text" name="SectionTitle" id="SectionTitle" value="<?php if(!empty($SectionTitle)){echo(htmlentities($SectionTitle));} ?>" />

    <label for="SectionRobots">Section robots (meta robots; defaults to 'index, follow')</label>
    <input type="text" name="SectionRobots" id="SectionRobots" value="<?php if(!empty($SectionRobots)){echo(htmlentities($SectionRobots));} ?>" />

    <label for="SectionKeywords">Section Keywords</label>
    <textarea name="SectionKeywords" id="SectionKeywords" rows="20" cols=""><?php if(!empty($SectionKeywords)){echo(htmlentities($SectionKeywords));} ?></textarea><br  /><br />

    <label for="SectionDescription">Section Description</label>
    <textarea name="SectionDescription" id="SectionDescription" rows="20" cols=""><?php if(!empty($SectionDescription)){echo(htmlentities($SectionDescription));} ?></textarea><br  /><br />

    <label for="SectionEditArea">Page Content</label>
    <textarea name="SectionEditArea" id="SectionEditArea" rows="20" cols=""><?php if(!empty($FileContents)){echo(htmlentities(stripslashes($FileContents)));}?></textarea><br /><br />

    <label>Make this page live?</label>
    <input name="MakeSectionLive" type="radio" value="Y" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'Y'){echo(' checked="checked"');}?> />Yes
    <input name="MakeSectionLive" type="radio" value="N" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'N'){echo(' checked="checked"');}?> />No<br /><br />

    <label for="SectionMenuWidth">Section Menu Width (Numbers ONLY)</label>
    <input name="SectionMenuWidth" id="SectionMenuWidth" type="text" value="<?php if(!empty($MenuWidth)){echo(htmlentities($MenuWidth));} ?>" /><br /><br />

    <input  type="submit" name="Operation" class="SmallWhiteButton" value="Update Section" />
    <input  type="submit" name="Operation" class="SmallWhiteButton" value="Delete Section" onclick="if(confirm('Are you sure you want to delete this section?\r\nAll files, directories and pages will be deleted.')) return true,submit(); else return false;" />
    <input  type="reset" name="Operation" class="SmallWhiteButton" value="Reset Form" />
   </form>
  </div>

  <div id="AddSiteSectionForm" style="display: none;">
   <h2>Add Site Section</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="AddSiteSection" style="padding: 0; margin: 0">

  <label for="NewSiteSectionName">Enter The New Section Name</label>
  <input type="text" name="NewSiteSectionName" id="NewSiteSectionName" />

  <label for="NewSiteSectionDirectory">Enter The Directory Name</label>
  <input type="text" name="NewSiteSectionDirectory" id="NewSiteSectionDirectory" />

  <label for="NewSiteSectionTitle">Enter The Page Title For The Default Page</label>
  <input type="text" name="NewSiteSectionTitle" id="NewSiteSectionTitle" />

  <label for="NewSiteSectionRobots">Section robots (meta robots; defaults to 'index, follow')</label>
  <input type="text" name="NewSiteSectionRobots" id="NewSiteSectionRobots" value="" />

  <label for="NewSiteSectionKeywords">Enter The Keywords For The Default Page</label>
  <textarea name="NewSiteSectionKeywords" id="NewSiteSectionKeywords" rows="20" cols=""></textarea><br />

  <label for="NewSiteSectionDescription">Enter The Description For The Default Page</label>
  <textarea name="NewSiteSectionDescription" id="NewSiteSectionDescription" rows="20" cols=""></textarea><br /><br />

    <input type="submit" name="Operation" value="Add Section" class="SmallWhiteButton" />

   </form>
  </div>

  <div id="EditSubPagesBlurb" style="display: none;">
   <h2>Site Sub-Pages</h2>
   <p>Sub-Pages are stand alone pages that you can link to from any arbitrary page. They do NOT display in the main navigation menus, only in the left column sub-navigation on the pages you specify.</p>
  </div>

  <div id="EditSubPages" style="display: none;">
   <h2>Edit Site Sub-Pages</h2>
   <?php
    if(isset($SubNavLinksRecordCountAdmin) && $SubNavLinksRecordCountAdmin > 0)
    {
   ?>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="EditSiteSubPageForm">
       <label for="SiteSubPageMenu">Choose A SubPage</label>
       <select name="SiteSubPageMenu" id="SiteSubPageMenu" onchange="changeStyle('EditSubPageButton','display','inline'); changeStyle('AddLinksButton','display','inline'); changeStyle('ManageSubPageCacheButton','display','inline'); changeStyle('UnCacheSubPageButton','display','inline');">
         <option value="">Choose A SubPage</option>
    <?php
     mysqli_data_seek($GetSiteSubNavLinksAdmin,0);
    while($row = mysqli_fetch_object($GetSiteSubNavLinksAdmin))
    {
      echo('    <option value="'.$row->SubNavID.'">'.$row->LinkText.'</option>'."\n".'    ');
    }
  ?>
    </select><br />

    <input type="submit" name="Operation" id="EditSubPageButton" class="SmallWhiteButton" value="Edit SubPage" style="display: none;" /><br  />
    <input type="submit" name="Operation" id="AddLinksButton" class="SmallWhiteButton" value="Add Link To Site Pages" style="display: none;" /><br />
    <input type="submit" name="Operation" value="Cache Page" class="SmallWhiteButton" id="ManageSubPageCacheButton" style="display: none;" onclick="if(confirm('Are you sure you want to add this page to the site cache?')) return true,submit(); else return false;" /><br  />
    <input  type="submit" name="Operation" value="Remove From Cache" class="SmallWhiteButton" id="UnCacheSubPageButton" style="display: none;" onclick="if(confirm('Are you sure you want to remove this page from the site cache?')) return true,submit(); else return false;" />
   </form>
   <?php
  }
  else
    {echo('<span class="AlertText">No SubPages Found.</span>');}
   ?>
  </div>

  <div id="EditSubPage" style="<?php if(isset($Operation) && $Operation == 'Edit SubPage'){echo('display: block;');}else{echo('display: none;');}?>">
   <h2 style="padding-bottom: 10px;">Edit SubPage</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="EditSiteSubPageForm2">
    <input  type="hidden" name="SubPageID" value="<?php if(!empty($SubPageID)){echo($SubPageID);}?>" />
    <input  type="hidden" name="FilePath" value="<?php if(!empty($FilePath)){echo($FilePath);}?>" />

    <label for="SubPageName">Page Name (link text)</label>
    <input type="text" name="SubPageName" id="SubPageName" value="<?php if(!empty($LinkText)){echo($LinkText);}?>" /><br />

    <label for="SubPageLinkTitle">Link Title (mouseover text)</label>
    <input type="text" name="SubPageLinkTitle" id="SubPageLinkTitle" value="<?php if(!empty($LinkTitle)){echo($LinkTitle);}?>" /><br />

    <label for="SubPageURL">Page URL</label>
    <input type="text" name="SubPageURL" id="SubPageURL" value="<?php if(!empty($PageURL)){echo($PageURL);}?>" /><br />

    <label for="SubPageTitle">Page Title (meta page title)</label>
    <input type="text" name="SubPageTitle" id="SubPageTitle" value="<?php if(!empty($LinkText)){echo($PageTitle);}?>" /><br />

    <label for="SubPageRobots">Page Robots (meta robots; defaults to 'index, follow')</label>
    <input type="text" name="SubPageRobots" id="SubPageRobots" value="<?php if(!empty($PageRobots)){echo($PageRobots);}?>" /><br />

    <label for="SubPageKeywords">Page Keywords</label>
    <textarea name="SubPageKeywords" id="SubPageKeywords" rows="20" cols=""><?php if(!empty($PageKeywords)){echo($PageKeywords);}?></textarea><br /><br />

    <label for="SubPageDescription">Page Description</label>
    <textarea name="SubPageDescription" id="SubPageDescription" rows="20" cols=""><?php if(!empty($PageDescription)){echo($PageDescription);}?></textarea><br /><br />

    <label for="SubPageEditArea">Sub-Page Content</label>
    <textarea name="SubPageEditArea" id="SubPageEditArea" rows="20" cols=""><?php if(!empty($FileContents)){echo(htmlentities(stripslashes($FileContents)));}?></textarea><br /><br />

    <label>Make this page live?</label>
    <input name="MakeLive" type="radio" value="Y" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'Y'){echo(' checked="checked"');}?> />Yes
		<input name="MakeLive" type="radio" value="N" style="width: 15px; border: none; vertical-align: middle;"<?php if(!empty($MakeLive) && $MakeLive == 'N') {
			echo(' checked="checked"');} ?> />No<br /><br />

    <input type="submit" class="SmallWhiteButton" name="Operation" value="Update SubPage" />&nbsp;&nbsp;
    <input type="submit" class="SmallWhiteButton" name="Operation" value="Delete SubPage" onclick="if(confirm('Are you sure you want to delete this SubPage?')) return true,submit(); else return false;" />
   </form>
  </div>

  <div id="AddSubPages" style="display: none;">
   <h2>Add SubPage</h2>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" name="SiteSubPageEdit">
       <label for="SiteSubPageSection">Choose A Section</label>
     <select name="SiteSubPageSection" id="SiteSubPageSection" onchange="changeStyle('AddSubPageButton','display','inline');">
        <option value="">Choose A Site Section</option>
    <?php
     mysqli_data_seek($GetSiteSectionsAdmin,0);
    while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
    {
      echo('    <option value="'.$row->SectionID.'">'.$row->Section.' | '.$row->Directory.'</option>'."\n".'    ');
    }
  ?>
   </select><br />
   <input type="submit" class="SmallWhiteButton" value="Add SubPage" name="Operation" id="AddSubPageButton" style="display: none;" onclick="ShowPageContent(divList,'addsubpage'); document.SiteSubPageAdd.NewSiteSubPageUrl.value = document.SiteSubPageEdit.SiteSubPageSection.options[SiteSubPageSection.selectedIndex].text.split(' | ',2).pop()+'/index/content/'; document.SiteSubPageAdd.NewSubPageDirectory.value = document.SiteSubPageEdit.SiteSubPageSection.options[SiteSubPageSection.selectedIndex].text.split(' | ',2).pop(); document.SiteSubPageAdd.NewSubPageSectionID.value = document.SiteSubPageEdit.SiteSubPageSection.options[SiteSubPageSection.selectedIndex].value; return false;" />
   </form>
  </div>

  <div id="AddSubPageLinks" style="<?php if(isset($Operation) && $Operation == 'Add Link To Site Pages') {echo('display: block;');} else {echo('display: none;');} ?>">
   <p class="AlertText">Select the pages you want to display this link on. Control-Click to select multiple pages.</p>
   <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent".'/'); ?>" method="post" enctype="multipart/form-data" name="AddSubPageLinksForm">

    <input type="hidden" name="AddLinkSubPageID" value="<?php echo($SiteSubPageMenu);?>" />
     <?php
     if(isset($PageList) && !empty($PageList))
     {
            echo('<label for="SubPageLinks">Link Pages</label>'."\n");
            echo('<select name="SubPageLinks[]" size="10" multiple="multiple" id="SubPageLinks" class="EditArtworkInput">');

            mysqli_data_seek($GetLinksAdmin,0);
            while($row = mysqli_fetch_object($GetLinksAdmin))
            {
                if(in_array($row->PageID,$PageList))
                {
                    echo('<option value="'.$row->PageID.'" selected="selected">'.$row->Text.'</option>'."\n".'     ');
                }
                else
                {
                    echo('<option value="'.$row->PageID.'">'.$row->Text.'</option>'."\n".'     ');
                }
            }

            echo('</select><br />');
     }
  ?>

    <input type="submit" name="Operation" class="SmallWhiteButton" value="Update SubPage Links" />
   </form>
  </div>

 <script>
 <!--
 var sectionslist=document.SiteSectionForm.SiteSectionMenu
 var pageslist=document.SiteSectionForm.SitePageMenu

 var SitePageMenu=new Array()
 SitePageMenu[0]=""
 <?php
 mysqli_data_seek($GetSiteSectionsAdmin,0);
 $i = 0;
 $SubCount = 0;
 while($row = mysqli_fetch_object($GetSiteSectionsAdmin))
 {
   mysqli_data_seek($GetLinksAdmin,0);
   $i++;
   $TheSection = $row->SectionID;
   print('SitePageMenu['.$i.']=["Choose Page|",');
   while($row = mysqli_fetch_object($GetLinksAdmin))
   {
     if($row->SectionID == $TheSection)
     {
       $SubCount++;
       print('"'.$row->Text.'|'.$row->PageID.'",');
     }
   }
   print(']'."\n");
 }
 ?>

 function UpdatePages(selectedsectiongroup)
 {
  pageslist.options.length=0

  if (selectedsectiongroup>0)
  {
   for (i=0; i < SitePageMenu[selectedsectiongroup].length; i++)pageslist.options[pageslist.options.length]=new Option(SitePageMenu[selectedsectiongroup][i].split("|")[0], SitePageMenu[selectedsectiongroup][i].split("|")[1])
  }
 }
-->
</script>

<?php
}else
{
?>
  <header class="SingleColumn"><h2>Not Logged In<br /></h2></header>
<?php
}
?>
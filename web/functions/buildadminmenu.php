<?php
  if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
  {
    if(isset($SectionRecordCount) && $SectionRecordCount > 0)
    {
	  reset($GetSiteSections);
	  //This builds the Admin navigation
	  echo('   <ul class="MainNav">'."\n\n  ");
      while($row = mysqli_fetch_object($GetSiteSections))
      {
		  echo('    <li><a href="control/'.$row->Directory.'/" title="'.$row->Section.'"><img src="img/arrow.gif" alt="'.ucfirst($row->Directory).'List" id="'.ucfirst($row->Directory).'List" />'.$row->Section.'</a>'."\n ");
          $MenuCall = 'main';
          require("$ApplicationPath/functions/buildsitemenu.php");
		  echo('    </li>'."\n\n");
      }
	  echo('  </ul>');
    }
  }
?>

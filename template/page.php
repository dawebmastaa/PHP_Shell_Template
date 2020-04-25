<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
<?php
//get the page title and meta
if(isset($MainConnection) && isset($StripContent)){require_once("$ApplicationPath/functions/getpagetitles.php");}

if(isset($title)){echo (" <title>$title</title>\n");}else{echo(' <title>'.$WebsiteName.'</title>');}
?>

 <meta name="description" content="<?php if(isset($description)){echo($description);} ?>" />
 <meta name="keywords" content="<?php if(isset($keywords)){echo($keywords);}?>" />
 <meta name="robots" content="<?php if(isset($robots) && !empty($robots)){echo($robots);}else{echo('index, follow, NOYDIR');}?>" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <link rel="stylesheet" href="<?php echo ("$root"); ?>css/normalize.css" />
 <link rel="stylesheet" href="<?php echo ("$root"); ?>css/layout.css" />
 <link rel="stylesheet" href="<?php echo ("$root");?>css/main.css" />
 <?php if(isset($MainDirectory) && $MainDirectory == 'control'){echo('<link rel="stylesheet" href="'.$root.'css/control.css" />');} ?>

 <link rel="manifest" href="site.webmanifest" />
 <link rel="apple-touch-icon" href="icon.png" />
 <link rel="icon" href="<?php echo ("$root") ?>favicon.ico" />

 <base href="<?php echo($root);?>" />
<?php
//get the navigation links from the database
if(isset($MainConnection))
{
  require_once("$ApplicationPath/functions/getnavigationlinks.php");
  require_once("$ApplicationPath/functions/getpagelist.php");
}
?>

</head>

<body>

<div id="Wrapper">
 <header id="top"><?php if($MainDirectory === 'control'){echo('<a href="control/"><img src="img/logo.png" class="logo" /></a>');} else{echo('<a href=""><img src="img/logo1.png" class="logo" /></a>');}?>
  <nav>
   <!-- 'hamburger' for the mobile menu -->
   <label for="hamburger" title="Click here to toggle a menu.">&#9776;</label>
   <input type="checkbox" id="hamburger" />

 <?php
//fix the 'section' links for the admin
if($MainDirectory === 'control')
{
  if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] && is_numeric($_SESSION['UserRole']))
  {
    if(isset($SectionRecordCount) && $SectionRecordCount > 0)
    {
	  mysqli_data_seek($GetSiteSections,0);
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
  else
  {
	echo(' <ul class="MainNav">'."\n   ".'<li><a href="control/" title="Log In">Log In</a></li><ul>'."\n ");
  }
}
elseif(isset($MainConnection))
{
  echo(' <ul class="MainNav">'."\n\n   ".'<li><a href="">Home</a></li>'."\n ");
  @mysqli_data_seek($GetSiteSections,0);
  //this builds the 'main navigation'
  while($row = mysqli_fetch_object($GetSiteSections))
  {
	  echo('  <li><a href="'.$row->Directory.'/" title="'.$row->SectionTitle.'"><img src="img/arrow.gif" alt="'.ucfirst($row->Directory).'List" />'.$row->Section.'</a>'."\n ");
      $MenuCall = 'main';
      require("$ApplicationPath/functions/buildsitemenu.php");
	echo('  </li>'."\n\n");
  }echo('  </ul>');
}
else
{
  echo(' <a href="" class="MainNav">Home</a>');
}
echo("\n");
?>
  </nav>
 </header>
 
 <div class="LeftContent">
<?php
//remove comments below if using the left hand column
  require_once("$LeftContent.php");
  echo("\n");
?>

 </div>

 <main id="Content">

  <section>

<?php
require_once("$content.php");
echo("\n\n");
?>

  </section>
 </main>

 <div class="RightContent">
<?php
//remove comments below if using the right hand column
  //require_once("$RightContent.php");
//echo("\n");
?>
 </div>

    <footer><cite>&copy;<?php echo(date("Y"));?> <?php print("$WebsiteName");?></cite></footer>

 </div>
 <script src="js/main.js"></script>
 <script src="js/vendor/jquery-3.4.1.min.js"></script>
 <script src="js/vendor/modernizr-3.8.0.min.js"></script>
 <script src="js/plugins.js"></script>
</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
//close all data connections
@mysqli_close($MainConnection);
?>
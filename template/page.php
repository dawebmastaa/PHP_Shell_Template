<!DOCTYPE html>
<html lang="en">
<head>
<?php
//get the page title and meta
if(isset($MainConnection) && isset($StripContent)){require_once("$ApplicationPath/functions/getpagetitles.php");}

if(isset($title)){echo (" <title>$title</title>\n");}else{echo(' <title>'.$WebsiteName.'</title>');}
?>

 <meta name="description" content="<?php if(isset($description)){echo($description);} ?>" />
 <meta name="keywords" content="<?php if(isset($keywords)){echo($keywords);}?>" />
 <meta name="robots" content="<?php if(isset($robots) && !empty($robots)){echo($robots);}else{echo('index, follow, NOYDIR');}?>" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <link rel="stylesheet" href="<?php echo ("$root"); ?>normalize.css" />
 <link rel="stylesheet" href="<?php echo ("$root"); ?>layout.css" />
 <link rel="stylesheet" href="<?php echo ("$root");?>main.css" />
 <link rel="icon" href="<?php echo ("$root") ?>favicon.ico" />

 <script src="<?php echo($root);?>scripts.js"></script>
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

 <header id="top">Header</header>
 <nav>
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
	  echo(' <ul class="MainNav">'."\n\n  ");	  
      while($row = mysqli_fetch_object($GetSiteSections))
      {
		  echo('  <li><a href="control/'.$row->Directory.'/" title="'.$row->Section.'"><img src="images/arrow.gif" alt="'.ucfirst($row->Directory).'List" id="'.ucfirst($row->Directory).'List" />'.$row->Section.'</a>'."\n ");
		  require("$ApplicationPath/functions/buildsitemenu2.php");
		  echo('  </li>'."\n\n");
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
	  echo('  <li><a href="'.$row->Directory.'/" title="'.$row->SectionTitle.'"><img src="images/arrow.gif" id="'.ucfirst($row->Directory).'List" alt="'.ucfirst($row->Directory).'List" />'.$row->Section.'</a>'."\n ");
	require("$ApplicationPath/functions/buildsitemenu2.php");
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
 
 <main>
 
 <div id="LeftContent">
<?php
//remove comments below if using the left hand column
  require_once("$LeftContent.php");
echo("\n");
?>
 </div>

 <div id="Content">
<?php
require_once("$content.php");
echo("\n\n");
?>
 </div>

 <div id="RightContent">
<?php
//remove comments below if using the right hand column
  require_once("$RightContent.php");
echo("\n");
?>
 </div>

 </main>

 <footer>&copy; <?php echo(date("Y"));?> <?php print("$WebsiteName");?></footer>

 </div>

</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
//close all data connections
@mysqli_close($MainConnection);
?>
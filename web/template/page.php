<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
<?php
//get the page title and meta and stuff.
if(isset($MainConnection) && isset($StripContent)){require_once("$ApplicationPath/functions/getpagetitles.php");}

if(isset($title)){echo (" <title>$title</title>\n");}else{echo(' <title>'.$WebsiteName.'</title>');}
?>

 <meta name="description" content="<?php if(isset($description)){echo($description);} ?>" />
 <meta name="keywords" content="<?php if(isset($keywords)){echo($keywords);}?>" />
 <meta name="robots" content="<?php if(isset($robots) && !empty($robots)){echo($robots);}else{echo('index, follow, NOYDIR');}?>" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <?php if(isset($MainDirectory) && $MainDirectory == 'control'){echo('<link rel="stylesheet" href="'.$root.'css/control.min.css" />'."\r\n".' <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">'."\r\n");} ?>
 <link rel="stylesheet" href="<?php echo ("$root"); ?>css/site.min.css" />  
 
 <link rel="icon" href="<?php echo ("$root") ?>img/favicon.ico" />

 <base href="<?php echo($root);?>" />
 <?php
//get the navigation links from the database
require("$ApplicationPath/functions/getnavigationlinks.php");
//require_once("$ApplicationPath/functions/getpagelist.php");
?>
</head>

<body>

<div id="Wrapper">
 <header id="top"><?php if($MainDirectory === 'control'){echo('<a href="control/"><img src="img/logo.png" class="logo" /></a>'."\r\n");} else{echo('<a href=""><img src="img/logo1.png" class="logo" /></a>'."\r\n");}?>
  <nav>
   <!-- 'hamburger' for the mobile menu -->
   <label for="hamburger" title="Click here to toggle a menu.">&#9776;</label>
   <input type="checkbox" id="hamburger" />

 <?php
//fix the 'section' links for the admin
if($MainDirectory === 'control')
{
  echo(' <ul class="MainNav">'."\n\n   ".'<li><a href="control/"><img src="img/arrow.gif" alt="Home" />Home</a></li>'."\n ");
  //this builds the 'main navigation'
  foreach($rows AS $row)
  {
	  $MenuCall = 'main';
    echo('  <li><a href="control/'.$row['Directory'].'/" title="'.$row['SectionTitle'].'"><img src="img/arrow.gif" alt="'.ucfirst($row['Directory']).'List" />'.$row['Section'].'</a>'."\n ");
    require("$ApplicationPath/functions/buildadminmenu.php");
    require_once("$ApplicationPath/functions/getpagelist.php");
    echo('  </li>'."\n\n");
  }echo('  </ul>');
}
elseif(isset($MainConnection))
{
  echo(' <ul class="MainNav">'."\n\n   ".'<li><a href=""><img src="img/arrow.gif" alt="Home" />Home</a></li>'."\n ");
  //this builds the 'main navigation'
  foreach($rows AS $row)
  {
	  echo('  <li><a href="'.$row['Directory'].'/" title="'.$row['SectionTitle'].'"><img src="img/arrow.gif" alt="'.ucfirst($row['Directory']).'List" />'.$row['Section'].'</a>'."\n ");
      $MenuCall = 'main';
      require_once("$ApplicationPath/functions/getpagelist.php");
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
 
 <div id="LeftContent" class="LeftContent">
<?php
//remove comments below if using the left hand column
require_once("$LeftContent.php");
echo("\n");
?>

 </div>

 <main id="Content">

<?php
require_once("$content.php");
echo("\n\n");
?>

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

 <script src="js/main.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
 <?php if($MainDirectory === 'control')
 {
  echo('<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>');
?>
 <script>
   $(document).ready(function ()
   {
      ShowPageContent(divList)
//$( '.LeftContent' ).load( '<?php echo($root);?>functions/ajaxcall.php?PageCall=showimage' );
   });
 </script>
<?php }?>
</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
?>

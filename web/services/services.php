<?php
//get the file that does the processing
if(file_exists("$ApplicationPath/$DirectoryPath/model/model$StripContent.php"))
{
  require_once("$ApplicationPath/$DirectoryPath/model/model$StripContent.php");
}

//get the file that displays the page
if(file_exists("$ApplicationPath/$DirectoryPath/view/view$StripContent.php"))
{
  require_once("$ApplicationPath/$DirectoryPath/view/view$StripContent.php");
}
?>
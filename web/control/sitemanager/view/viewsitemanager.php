<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && ($_SESSION['UserRole'] == '1' || $_SESSION['UserRole'] == '3'))
{
?>
  <header id="List">
   <h1>Site Manager</h1>
   <ul>  
  <?php
  foreach($rows2 AS $row2)
  {
   if($ThisDirectory == $row2['Directory'])
   {
    	echo('  <li><a href="'.$row2['URL'].'">'.$row2['Text'].'</a></li>'."\n".'  ');
   }	
  }
?>
 </ul>
  </header>
      
<?php
if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
{ 
?>
  <br clear="all" />
  
  <header class="SingleColumn">
   <ul>
  <?php
   foreach($rows3 AS $row3)
   {
    echo('<li><a href="'.$row['Link'].'">'.$row['LinkTitle'].'</a></li>');
   }
?>
    </ul>
   </header>
<?php
  }
?>
  <br clear="all" />

<?php
}else{
?>
    <header class="SingleColumn"><h2 class="AlertText">Not Logged In</h2></header>
<?php
}
?>
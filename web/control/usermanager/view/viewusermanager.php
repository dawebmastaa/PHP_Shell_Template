<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
    <section class="SingleColumn">
     <h1>User Manager</h1>
<?php
  //reset the query that contains the links
  foreach($rows2 AS $row2)
  {
   if($ThisDirectory == $row2['Directory'])
   {
    	echo('     <a href="'.$row2['URL'].'">'.$row2['Text'].'</a><br />'."\n");
   }	
  }

  if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
  {
    foreach($rows3 AS $row3)
      {
          echo('   <a href="'.$row3['Link'].'">'.$row3['LinkTitle'].'</a><br />'."\n".'  ');
      }
  }
?>    </section>
<?php
}else{
?>
  <header class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges</h2></header>
<?php
} ?>
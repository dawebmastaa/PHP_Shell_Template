<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
    <section class="SingleColumn">
     <h1>User Manager</h1>
<?php
  //reset the query that contains the links
  mysqli_data_seek($GetLinks,0);
  
  while($row = mysqli_fetch_object($GetLinks))
  {
   if($ThisDirectory == $row->Directory)
   {
    	echo('     <a href="'.$row->URL.'">'.$row->Text.'</a><br />'."\n");
   }	
  }

  if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
  {
      mysqli_data_seek($GetSubLinks,0);
      while($row = mysqli_fetch_object($GetSubLinks))
      {
          echo('   <a href="'.$row->Link.'">'.$row->LinkTitle.'</a><br />'."\n".'  ');
      }
  }
?>    </section>
<?php
}else{
?>
  <header class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges</h2></header>
<?php
} ?>
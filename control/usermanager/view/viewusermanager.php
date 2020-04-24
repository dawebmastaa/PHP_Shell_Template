<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
    <header id="List">
   <h1>User Manager</h1>
   <ul>  
  <?php
  //reset the query that contains the links
  mysqli_data_seek($GetLinks,0);
  
  while($row = mysqli_fetch_object($GetLinks))
  {
   if($ThisDirectory == $row->Directory)
   {
    	echo('  <li><a href="'.$row->URL.'">'.$row->Text.'</a></li>'."\n".'  ');
   }	
  }
?>
 </ul>
      
<?php
if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
{
 	mysqli_data_seek($GetSubLinks,0); 
?>
  <br clear="all" />
   <ul>
  <?php
   while($row = mysqli_fetch_object($GetSubLinks))
   {
    echo('<li><a href="'.$row->Link.'">'.$row->LinkTitle.'</a></li>');
   }
?>
    </ul>
    </header>
<?php
  }
}else{
?>
  <header class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges</h2></header><br clear="all" />
<?php
}
?>
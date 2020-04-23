<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
  <div class="SingleColumn">
   <h1 style="padding-bottom: 10px;">User Manager</h1>
   <ul>  
  <?php
  //reset the query that contains the links
  mysqli_data_seek($GetLinks,0);
  
  while($row = mysqli_fetch_object($GetLinks))
  {
   if($ThisDirectory == $row->Directory)
   {
    	echo('  <li style="font-size: 11px;"><a href="'.$row->URL.'">'.$row->Text.'</a></li>'."\n".'  ');
   }	
  }
?>
 </ul>
  </div>
      
<?php
if(isset($SubLinkRecordCount) && $SubLinkRecordCount > 0)
{
 	mysqli_data_seek($GetSubLinks,0); 
?>
  <br clear="all" />
  
  <div class="SingleColumn">
   <ul>
  <?php
   while($row = mysqli_fetch_object($GetSubLinks))
   {
    echo('<li style="font-size: 11px;"><a href="'.$row->Link.'">'.$row->LinkTitle.'</a></li>');
   }
?>
    </ul>
   </div>
<?php
  }
?>
  <br clear="all" />
  <div class="TopPad" style="padding-top: 400px;"><h1><br /></h1></div>

<?php
}else{
?>
  <div class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges<br /></h2></div><div class="TopPad"><br /><br /></div><br clear="all" />
<?php
}
?>
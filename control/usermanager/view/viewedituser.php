<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] === 'Yes' && $_SESSION['UserRole'] === '1')
{
?>
  <header id="List" class="SingleColumn">
   <h1>Edit/Delete Users</h1><br />
    <?php if(!empty($Message)){echo($Message);} ?>
    <?php if(!isset($Operation) || $Operation === 'Update User'){ ?>
    <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent"); ?>" method="post" name="EditUser" id="EditUser" style="padding: 0; margin: 0;">

     <label for="UserID">Select A User</label><br />
     <select name="UserID" id="UserID">
     <?php
     while($row = mysqli_fetch_object($GetUsers))
     {
     	echo(' <option value="'.$row->UserID.'">'.$row->LastName.', '.$row->FirstName.'</option>'."\n     ");
     }?>
     </select><br />

     <input class="SmallWhiteButton" type="submit" name="Operation" value="Edit User" />
     <input class="SmallWhiteButton" type="submit" name="Operation" value="Delete User" onclick="if(confirm('Are you sure you want to delete this user?')) return true,submit(); else return false;" />
    </form>
   <?php } ?>
<?php
if(isset($Operation) && $Operation == 'Edit User')
{
?>
    <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent"); ?>" method="post" name="EditUser" id="EditUser" onsubmit="YY_checkform('EditUser','FirstName','#q','0','Please enter a first name.','LastName','#q','0','Please enter a last name.','UserName','#q','0','Please enter a username.','EmailAddress','#S','2','Please enter a valid email address.');return document.MM_returnValue">
     <input type="hidden" id="UserID" name="UserID" class="EditArtworkInput" value="<?php echo($row1->UserID);?>" />
     <label for="RoleID">Choose User Type:</label><br />
     <select name="RoleID" id="RoleID" class="EditArtworkInput">
<?php
	while($row = mysqli_fetch_object($GetUserRoles))
	{
?>
      <option value="<?php echo($row->RoleID);?>" <?php if($row->RoleID === $row1->RoleID){echo('selected="selected"');}?>><?php echo($row->Role);?></option>
<?php }
?>
     </select><br /><br />

     <label for="FirstName">First Name:</label>
     <input type="text" id="FirstName" name="FirstName" value="<?php echo($row1->FirstName);?>" /><br /><br />

     <label for="LastName">Last Name:</label>
     <input type="text" id="LastName" name="LastName" value="<?php echo($row1->LastName);?>" /><br /><br />

     <label for="UserName">UserName:</label>
     <input type="text" id="UserName" name="UserName" value="<?php echo($row1->UserName);?>" /><br /><br />

     <label for="Password">Password:<span class="AlertText"><br />Only if you want to CHANGE the password.</span></label>
     <input type="password" id="Password" name="Password" class="EditArtworkInput" /><br /><br />

     <label for="EmailAddress">Email Address:</label>
     <input type="text" id="EmailAddress" name="EmailAddress" value="<?php echo($row1->EmailAddress);?>" /><br /><br />

     <input class="SmallWhiteButton" type="submit" name="Operation" value="Update User" />
     <input class="SmallWhiteButton" type="submit" name="Operation" value="Delete User" onclick="if(confirm('Are you sure you want to delete this user?')) return true,submit(); else return false;" />
     <input class="SmallWhiteButton" type="reset" name="reset" value="Reset Values" />
    </form>
<?php } ?>
  </header>
  <br clear="all" />

<?php
}
else
{
 print('<header id="List" class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges<br /></h2></header><br clear="all" />');
}
?>
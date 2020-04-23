<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
  <div class="SingleColumn" style="padding-left: 30px; padding-top: 10px; padding-right: 100px;"><h1>Add A User<br /><br /></h1>
  <?php if(!empty($Message)){echo($Message);} ?>
  <div id="MemberFormFields">
    <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent"); ?>" method="post" name="AddUser" id="AddUser" onsubmit="YY_checkform('AddUser','FirstName','#q','0','Please enter a first name.','LastName','#q','0','Please enter a last name.','UserName','#q','0','Please enter a username.','Password','#q','0','Please enter a password.','EmailAddress','#S','2','Please enter a valid email address.');return document.MM_returnValue">
     <label for="RoleID">Choose User Type</label><br />
     <select name="RoleID" id="RoleID">
<?php
    while($row = mysqli_fetch_object($GetUserRoles))
   {
?>
      <option value="<?php echo($row->RoleID)?>"><?php echo($row->Role)?></option>
<?php
   }
?>
     </select><br /><br />

     <label for="FirstName">First Name</label>
     <input type="text" id="FirstName" name="FirstName" class="Registration" /><br />

     <label for="LastName">Last Name</label>
     <input type="text" id="LastName" name="LastName" class="Registration" /><br />

     <label for="UserName">UserName</label>
     <input type="text" id="UserName" name="UserName" class="Registration" /><br />

     <label for="Password">Password</label>
     <input type="password" id="Password" name="Password" class="Registration" /><br />

     <label for="EmailAddress">Email Address</label>
     <input type="text" id="EmailAddress" name="EmailAddress" class="Registration" /><br />

     <input class="SmallWhiteButton" type="submit" name="Operation" value="Add User" />
    </form>
  </div>
  </div>
  <br clear="all" />
  <div class="TopPad" style="height: 300px;"><h1><br /></h1></div>

<?php
}
else
{
 print('<div class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges<br /></h2></div><div class="TopPad"><br /><br /></div><br clear="all" />');
}
?>
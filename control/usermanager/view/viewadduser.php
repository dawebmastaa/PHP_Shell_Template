<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes' && $_SESSION['UserRole'] == '1')
{
?>
  <header id="List"><h1>Add A User<br /><br /></h1>
      <?php if(!empty($Message)){echo($Message);} ?>
    <form action="<?php print("$root"."$DirectoryPath".'/index/content/'."$StripContent"); ?>" method="post" name="AddUser" id="AddUser" onsubmit="">
     <label for="RoleID">Choose User Type</label><br />
     <select name="RoleID" id="RoleID" autofocus required>
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
     <input type="text" id="FirstName" name="FirstName" class="Registration" required />

     <label for="LastName">Last Name</label>
     <input type="text" id="LastName" name="LastName" class="Registration" required />

     <label for="UserName">UserName</label>
     <input type="text" id="UserName" name="UserName" class="Registration" required />

     <label for="Password">Password</label>
     <input type="password" id="Password" name="Password" class="Registration" required />

     <label for="EmailAddress">Email Address</label>
     <input type="text" id="EmailAddress" name="EmailAddress" class="Registration" required />

     <input class="SmallWhiteButton" type="submit" name="Operation" value="Add User" />
    </form>
  </header>
<?php
}
else
{
 print('<header id="List" class="SingleColumn"><h2 class="AlertText">Not Logged In Or No Privileges<br /></h2></header>');
}
?>
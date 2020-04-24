<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes')
{
?>
    <header id="List"><h1>Admin Home:</h1><p>Welcome <?php if($_SESSION["Name"]){print($_SESSION['Name']);} ?></p></header>
<?php
}else
{
?>
<header id="List">
<?php if(!empty($Message)){echo($Message);} ?>
 <h1>Log In</h1>
  <form action="<?php echo($root.$DirectoryPath.'/index/content/'.$StripContent).'/'; ?>" method="post">
   <label for="UserName">UserName:</label><input type="text" name="UserName" id="UserName" />
   <label for="Password">Password:</label><input type="password" name="Password" id="Password" />
   <input type="submit" name="Operation" value="Log In" class="SmallWhiteButton" />
  </form>
</header>
<?php
}
?>
<?php
if(isset($_SESSION["UserLoggedIn"]) && $_SESSION["UserLoggedIn"] == 'Yes')
{
?>
         <div style="padding: 10px 20px 500px 15px;">
          <h1>Admin Home:</h1><p>Welcome <?php if($_SESSION["Name"]){print($_SESSION['Name']);} ?></p>
         </div>
<?php
}else
{
?>
<div style="padding-left: 200px; padding-top: 40px; padding-bottom: 0px;">
<?php if(!empty($Message)){echo($Message);} ?>
 <h1>Log In</h1>
 <div>
  <form action="<?php echo($root.$DirectoryPath.'/index/content/'.$StripContent).'/'; ?>" method="post" style="width: 180px; padding: 10px 0px 30px 0px; margin: 0px 0px 0px 0px;">
   <label for="UserName">UserName:</label><input type="text" name="UserName" id="UserName" />
   <label for="Password">Password:</label><input type="password" name="Password" id="Password" />
   <input type="submit" name="Operation" value="Log In" class="SmallWhiteButton" />
  </form>
 </div>
</div>

<?php
}
?>

 <footer>&copy; <?php echo(date("Y"));?> <?php print("$WebsiteName");?></footer>

 </div>

</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
//close all data connections
@mysqli_close($MainConnection);
?>
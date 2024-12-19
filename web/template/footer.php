
<footer><cite>&copy;<?php echo(date("Y"));?> <?php print("$WebsiteName");?></cite></footer>

</div>
<script src="js/main.js"></script>
<script src="https://unpkg.com/htmx.org@1.9.10"></script>
<script src="js/plugins.js"></script>
</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
//close all data connections
@mysqli_close($MainConnection);
?>
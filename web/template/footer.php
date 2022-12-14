
<footer><cite>&copy;<?php echo(date("Y"));?> <?php print("$WebsiteName");?></cite></footer>

</div>
<script src="js/main.js"></script>
<script src="js/vendor/jquery-3.4.1.min.js"></script>
<script src="js/vendor/modernizr-3.8.0.min.js"></script>
<script src="js/plugins.js"></script>
</body>
</html>
<?php
//this file tracks where the user came from.
require_once("$ApplicationPath/functions/return.php");
//close all data connections
@mysqli_close($MainConnection);
?>
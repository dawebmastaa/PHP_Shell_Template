<?php
//this is the second data connection, where the 'timeshare data' is stored.
$AltConnection = mysqli_connect('localhost', 'LocalUser', 'LocalPW436');
mysqli_select_db($AltConnection,'sharetime');
?>
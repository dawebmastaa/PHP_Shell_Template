<?php
//this is for the main database connection for the site front end.
$MainConnection = mysqli_connect('localhost', 'root', 'blues12345');
mysqli_select_db($MainConnection,'shell');
?>

<?php
//Let's try something new
try {  
  // SQLite Database database driver:host;db (schema) name and charset,
    $MainConnection = new PDO('sqlite:/media/mikea/86022EF5022EE9BF/web/repos/PHP_Shell_Template/conf/shell.sqlite');
  }
  catch(PDOException $e) {
      echo $e->getMessage();
  }

//namespace Aura\Sql;

//USE Aura\Sql\ExtendedPdo;
//$MainConnection = new ExtendedPdo('sqlite:/media/mikea/86022EF5022EE9BF/web/repos/PHP_Shell_Template/conf/shell.sqlite');

//this is for the main database connection for the site front end.
//$MainConnection = mysqli_connect('localhost', 'root', 'blues12345');
//mysqli_select_db($MainConnection,'shell');
?>

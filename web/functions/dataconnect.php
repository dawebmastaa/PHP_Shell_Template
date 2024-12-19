<?php
//use Doctrine\DBAL\DriverManager;

//$connectionParams = [
  //  'url' => 'pdo-sqlite://notused:inthis@case//var/www/shell/conf/shell.sqlite',
  //  'driver' => 'pdo_sqlite',
//];

//$MainConnection = DriverManager::getConnection($connectionParams);


$MainConnection = new PDO('sqlite:/home/mikes/Work/web/repos/PHP_Shell_Template/conf/shell.sqlite')

//USE Aura\Sql\ExtendedPdo;
//$MainConnection = new ExtendedPdo('sqlite:/media/mikea/86022EF5022EE9BF/web/repos/PHP_Shell_Template/conf/shell.sqlite');

//this is for the main database connection for the site front end.
//$MainConnection = mysqli_connect('localhost', 'root', 'blues12345');
//mysqli_select_db($MainConnection,'shell');
?>

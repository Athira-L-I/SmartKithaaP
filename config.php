<?php
$databaseHost = 'localhost';
$databaseName = 'athira';
$databaseUsername = 'root';
$databasePassword = 'secret';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die("cannot connect to database");
?>
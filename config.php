<?php
$databaseHost = 'localhost';
$databaseName = '/*your database name*/';
$databaseUsername = 'root';
$databasePassword = '/*if your database has password enter here*/'
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die("cannot connect to database");
?>

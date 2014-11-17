<?php
$db_error_msg = "There are some problems connecting to the database. We are working on it.";

$host   = 'hearts.owl-ict.nl';
$user   = 'hearts2gosite';
$pass   = 'F1rstBl00d';
$db     = 'hearts2go';
$port   = '3306';

$con = mysqli_connect($host, $user, $pass, $db, $port) or die ($db_error_msg);
?>
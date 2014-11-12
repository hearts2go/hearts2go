<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
	<title>Hearts2Go</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/refresh.js"></script>
    <link href="css/forms.css" rel="stylesheet" type="text/css">
</head>
<body>
<a href="../help.php#<?=$helpChapter?>">Help</a>
<?php
if (isset($_SESSION['user'])) {
    ?><a href="logout.php">Logout</a><?php
}
require 'config.php';
require 'functions.php';
?>
<hr>

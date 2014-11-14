<?php
include_once "_inc/header.php";
print_array($_POST);
$p1 = 'Mathieu';
$p2 = 'Daan';
$p3 = 'Joey';
$p4 = 'Ogulcan';
echo '<a href="profile.php?username=' . $p1 .'">' . $p1 . '</a><br>';
echo '<a href="profile.php?username=' . $p2 .'">' . $p2 . '</a><br>';
echo '<a href="profile.php?username=' . $p3 .'">' . $p3 . '</a><br>';
echo '<a href="profile.php?username=' . $p4 .'">' . $p4 . '</a>';
?>
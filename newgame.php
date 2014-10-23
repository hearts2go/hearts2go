<?php
$helpChapter = 'newgame';
include_once "_inc/header.php";

$gameNr = str_pad(rand(1, 999999), 6, "0", STR_PAD_LEFT);

echo $gameNr;

include_once "_inc/footer.php";
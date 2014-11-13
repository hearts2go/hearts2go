<?php
$helpChapter = 'home';
include_once "_inc/header.php";
?>

<p>Welkom bij Hearts2Go</p>

<a href="newgame.php">Start nieuw spel</a><br>
<a href="loadgame.php">Spel laden</a><br>
<?php
if ($loggedIn = true) {																									?>
	<a href="settings.php">Profiel aanpassen</a>																			<?php
}
else {																													?>
	<a href="register.php">Registreren</a>																				<?php
}

include_once "_inc/footer.php";
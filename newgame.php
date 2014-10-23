<?php
$helpChapter = 'newgame';
include_once "_inc/header.php";

$gameNr = str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);																?>

<p>Game Number <?=$gameNr?></p>

<div>How many people will be playing?</div>
<div style="margin:30px">
	<span class="charButton">3</span>
	<span class="charButton">4</span>
	<span class="charButton">5</span>
	<span class="charButton">6</span>
</div>
<div></div>
<div>Which gametype would you like to play?</div>
<!--
TODO: Gametypes opzoeken.
-->
<script>
	$(document).ready(function(){
		var amountOfPlayers = 4;

		$(".charButton").click(function(){
			amountOfPlayers = $(this).text();
			$(".introducePlayer").remove();
			for (var playernr = amountOfPlayers; playernr >= 1; playernr--) {
				$("#playerListTitle").after("<tr class='introducePlayer'>" +
				"							<td>Player "+ playernr +"</td>" +
				"							<td><input type='text' name='username'></td>" +
				"							<td><input type='text' name='screenname'><td>" +
				"						</tr>");
			}
		})
	})
</script>

<form action="ingame.php?gameid=<?=$gameNr?>" method="post">
	<table>
		<tr id="playerListTitle">
			<th></th>
			<th>Username</th>
			<th>Screenname</th>
		</tr>
	</table>
	<input type="submit" name="playerlist" value="Confirm">
</form>




<?php include_once "_inc/footer.php"; ?>
<?php
$helpChapter = 'newgame';
include_once "_inc/header.php";

$gameNr = str_pad(rand(1, 99999999), 8, "0", STR_PAD_LEFT);																?>

<p>Game Number <?=$gameNr?></p>

<p><b>Which gametype would you like to play?</b></p>
<form action="ingame.php?gameid=<?=$gameNr?>" method="post">
	<div style="margin:30px;">
		<span class="charButton gamepicker" id="gameArg">Argentinan</span>
		<span class="charButton gamepicker" id="gameBla">Black Lady</span>
		<span class="charButton gamepicker" id="gameDut">Dutch</span>
		<span class="charButton gamepicker" id="gameNAm">North American</span>
	</div>

	<p><b>Rules:</b></p>
	<p id="rules">Please select a game from the list above.</p>

	<p><b>Players:</b></p>
	<div id="playerslist"></div>
	<button class="nextButton" type="submit" name="playerlist">Next</button>
</form>
<div style="margin:30px;">
	<span class="charButton" id="addPlayer">Add an anonymous player</span> <span class="charButton" id="addRegPlayer">Add an registered player</span>
</div>

<script>
	$(document).ready(function(){

		// Speler toevoegen
		$("#addPlayer").click(function(){
			$("#playerslist").append("<table class='singlePlayer' style='padding-bottom:30px;'>" +
									"<tr>" +
									"	<td>Screenname:</td>" +
									"	<td><input class='formtext screennameField' type='text'></input></td>" +
									"</tr>" +
									"<tr>" +
									"	<td></td><td class='removebutton charbutton'>Remove</td>" +
									"</tr>" +
									"</table>");
		});

		$("#addRegPlayer").click(function(){
			$("#playerslist").append("<table class='singlePlayer' style='padding-bottom:30px;'>" +
									"<tr>" +
									"	<td>Screenname:</td>" +
									"	<td><input class='formtext screennameField' type='text'></input></td>" +
									"</tr>" +
									"<tr>" +
									"	<td>Username:</td>" +
									"	<td><input class='formtext usernameField' type='text'></input></td>" +
									"</tr>" +
									"	<td>Password:</td>" +
									"	<td><input class='formtext passwordField' type='text'></input></td>" +
									"</tr>" +
									"<tr>" +
									"	<td></td><td class='removebutton charbutton'>Remove</td>" +
									"</tr>" +
									"</table>");
		});

		// Speler verwijderen
		$("#playerslist").on("click", "tr .removebutton", function(){
			$(this).parent().parent().remove();
		})

		// keuzefunctionaliteit
		$(".gamepicker").click(function(){
			$(".gamepicker").removeClass("charbuttonOn");
			$(".gamepicker").addClass("charbutton");
			$(this).removeClass("charbutton");
			$(this).addClass("charbuttonOn");
		})

		// Laat de juiste regels zien voor elk spel type
		$("#gameArg").click(function(){
			$("#rules").html("<ul>" +
							"	<li>Recommended players: 4-5 players</li>" +
							"	<li>Played with a full pack</li>" +
							"	<li>&spades;Q - 13 points</li>" +
							"	<li>J - 5 points</li>" +
							"	<li>&hearts; - 1 point</li>" +
							"</ul>")
		})

		$("#gameBla").click(function(){
			$("#rules").html("<ul>" +
							"	<li>Recommended players: 6-10 players</li>" +
							"	<li>Played with two full packs</li>" +
							"	<li>&spades;Q - 50 points</li>" +
							"	<li>&spades;A - 40 points</li>" +
							"	<li>&hearts;A, &hearts;K, &hearts;Q, &hearts;J - 10 points</li>" +
							"	<li>&hearts;2 to &hearts;10 - face value</li>" +
							"</ul>")
		})

		$("#gameDut").click(function(){
			$("#rules").html("<ul>" +
							"	<li>Recommended players: 3-4 players</li>" +
							"	<li>Played with a piquet pack</li>" +
							"	<li>&spades;Q - 5 points</li>" +
							"	<li>&clubs;J - 2 points</li>" +
							"	<li>&hearts; - 1 point</li>" +
							"</ul>")
		})

		$("#gameNAm").click(function(){
			$("#rules").html("<ul>" +
							"	<li>Recommended players: 4-5 players</li>" +
							"	<li>Played with a full pack</li>" +
							"	<li>&spades;Q - 13 points</li>" +
							"	<li>&hearts; - 1 point</li>" +
							"</ul>")
		})
	})
</script>


<?php include_once "_inc/footer.php"; ?>
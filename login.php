<?php
$helpChapter = 'login';
include_once "_inc/header.php";

// Als er op de login knop is gedrukt

if (isset($_POST['action'])) {
	if ($_POST['action'] == 'login') {
		if ($_POST['username'] != '' && $_POST['password'] != '') {
			$userData = mysqli_query($con, "SELECT password, screen_name FROM users WHERE username = '".$_POST['username']."'");

			// Bestaat de gebruiker?
			if (mysqli_num_rows($userData) > 0) {
				$user = array();
				foreach($userData as $data) {
					$user['screenname'] = $data['screen_name'];
					$user['password'] = $data['password'];
				}

				// Klopt het wachtwoord?
                $hash;
                foreach ($userData as $data) {
                    $hash = $data['password'];
                }
				if (password_verify($_POST['password'], $hash)) {
					$_SESSION['user'] = $user;																			?>
					<script>
						$(document).ready(function(){
							$('#msgfield').css("background-color", "#888800");
							$('#msgfield').html("Welcome back, <?=$user['screenname']?>.");
							$('#msgfield').fadeIn('slow');
						})
					</script>																							<?php
				}
				else {																									?>
					<script>
						$(document).ready(function(){
							$('#msgfield').text("Incorrect password.");
							$('#msgfield').fadeIn('slow');
						});
					</script>																							<?php
				}
			}
			else {																										?>
				<script>
				$(document).ready(function(){
					$('#msgfield').html('User not found. Would you like to <a href="register.php">register</a>?');
					$('#msgfield').fadeIn('slow');
				});
				</script>																								<?php
			}
		}
		else {																											?>
			<script>
				$(document).ready(function(){
					$('#msgfield').text("Please enter both a username and a password.");
					$('#msgfield').fadeIn('slow');
				});
			</script>																									<?php
		}
	}
}

// Inlogformulier

?>
<form action="" method="post">
    <ul>
        <li>
            <label>Username<br>
                <input type="text" name="username" placeholder="Username">
            </label>
        </li>
        <li>
            <label>Password<br>
                <input type="password" name="password" placeholder="Password">
            </label>
        </li>
        <li>
            <input type="submit" name="action" value="login">
        </li>
    </ul>
</form>

<p id="msgfield"></p>
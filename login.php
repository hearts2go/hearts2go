<?php
$helpChapter = 'login';
include_once "_inc/header.php";

// Als er op de login knop is gedrukt
if (isset($_POST['action'])) {
    //kijkt of of actie gelijk is aan login
	if ($_POST['action'] == 'login') {
        //kijkt of gegevens zijn ingevuld
		if (empty($_POST['username']) && empty($_POST['password'])) {
            //vraagt user gegevens op.
			$userData = mysqli_query($con, "SELECT password, screen_name, username FROM users WHERE username = '".$_POST['username']."'");

			// Bestaat de gebruiker?
			if (mysqli_num_rows($userData) > 0) {
				$user = array();
				foreach($userData as $data) {
					$user['screenname'] = $data['screen_name'];
					$user['password']   = $data['password'];
                    $user['username']   = $data['username'];
				}

                $hash;
                foreach ($userData as $data) {
					$hash = $data['password'];
                }
                //Klopt het wachtwoord?
				if (password_verify($_POST['password'], $hash)) {
                    //zet user gegevens in session
					$_SESSION['user'] = $user;
                    ?>
					<script>
						$(document).ready(function(){
							$('#msgfield').css("background-color", "#888800");
							$('#msgfield').html("Welcome back, <?=$user['screenname']?>.");
							$('#msgfield').fadeIn('slow');
						});
                    </script>
                    <?php
				}
				else {
                    ?>
					<script>
						$(document).ready(function(){
							$('#msgfield').text("Incorrect password.");
							$('#msgfield').fadeIn('slow');
						});
					</script>
                <?php
				}
			}
			else {
                ?>
				<script>
				$(document).ready(function(){
					$('#msgfield').html('User not found. Would you like to <a href="register.php">register</a>?');
					$('#msgfield').fadeIn('slow');
				});
				</script>
            <?php
			}
		}
		else {
            ?>
			<script>
				$(document).ready(function(){
					$('#msgfield').text("Please enter both a username and a password.");
					$('#msgfield').fadeIn('slow');
				});
			</script>
        <?php
		}
	}
}

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
<style src="css/forms.css" rel="stylesheet" type="text/css"></style>

<?php
$pageName = 'register';
include_once "_inc/header.php";
?>
<?php

// Als er op de login knop is gedrukt

if (isset($_POST['action'])) {
	if ($_POST['action'] == 'login') {
		if ($_POST['username'] != '' && $_POST['password'] != '') {
			$hashedPass = md5($_POST['password']);
			$userData = mysqli_query($con, "SELECT password, screen_name FROM users WHERE username = '".$_POST['username']."'");
			if (mysqli_num_rows($userData) > 0) {
				$user = array();
				foreach($userData as $data) {
					$user['screenname'] = $data['screen_name'];
					$user['password'] = $data['password'];
				}

				if ($user['password'] != $hashedPass) {																	?>
					<script>
					$(document).ready(function(){
						$('#errorfield').text("Incorrect password.");
					});
					</script>																							<?php
				}
				else {
					$_SESSION['user'] = $user;																			?>
					<p>Welcome, <?=$user['screenname']?></p>															<?php
				}
			}
			else {																										?>
				<script>
				$(document).ready(function(){
					$('#errorfield').text('User not found. Please check your username or go back to register.');
				});
				</script>																								<?php
			}
		}
		else {																											?>
			<script>
				$(document).ready(function(){
					$('#errorfield').text("Please enter both a username and a password.");
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

<p id="errorfield"></p>
<?php
include '_inc/header.php';
if (isset($_SESSION['user'])) {
    $user_data = array();
    $username = $_SESSION['user']['username'];

    //krijg gegevens met username en zet in array
    $username = trim($username);
    $query = "SELECT screen_name, password, email FROM users  WHERE username = '$username'";

    $data = mysqli_query($con, $query);

    foreach ($data as $info) {
        ?>
        <form action="" method="post">
            <ul>
                <li>
                    <label>ScreenName<br>
                        <input type="text" name="screen_name" value="<?= $info['screen_name'] ?>">
                    </label>
                </li>
                <li>
                    <label>Email<br>
                        <input type="email" name="email" value="<?= $info['email'] ?>">
                    </label>
                </li>
                <li>
                    <a href="changePassword.php">Change Password!</a>
                </li>
                <li>
                    <input type="submit" name="action" value="save">
                </li>
            </ul>
        </form>
<?php
    }
} else {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'login') {
            if ($_POST['username'] != '' && $_POST['password'] != '') {
                $userData = mysqli_query($con, "SELECT password, screen_name, username FROM users WHERE username = '".$_POST['username']."'");

                // Bestaat de gebruiker?
                if (mysqli_num_rows($userData) > 0) {
                    $user = array();
                    foreach($userData as $data) {
                        $user['screenname'] = $data['screen_name'];
                        $user['password']   = $data['password'];
                        $user['username']   = $data['username'];
                    }

                    // Klopt het wachtwoord?
                    $hash;
                    foreach ($userData as $data) {
                        $hash = $data['password'];
                    }

                    if (password_verify($_POST['password'], $hash)) {
                        $_SESSION['user'] = $user;
                        ?>
                        <script>
                            $(document).ready(function(){
                                $('#msgfield').css("background-color", "#888800");
                                $('#msgfield').html("Welcome back, <?=$user['screenname']?>.");
                                $('#msgfield').fadeIn('slow');
                            });
                        </script>
                        <meta http-equiv="refresh" content="2">
                    <?php
                    }
                    else {																									?>
                        <script>
                            $(document).ready(function(){
                                $('#msgfield').text("Incorrect password.");
                                $('#msgfield').fadeIn('slow');
                            });
                        </script>																						<?php
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
<?php
}
?>
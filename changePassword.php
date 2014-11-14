<?php
include '_inc/header.php';
//kijkt of session is gevuld
if (isset($_SESSION['user'])) {
    $user_data = array();
    $username = $_SESSION['user']['username'];

    //krijg gegevens met username en zet in array
    $username = trim($username);
    $query = "SELECT password FROM users  WHERE username = '$username'";

    $data = mysqli_query($con, $query);

    $hash;
    foreach ($data as $info) {
        $hash = $info['password'];
    }
    if (isset($_POST['changePass'])) {
        if (empty($_POST['currentPassword']) || empty($_POST['password']) || empty($_POST['rePassword'])) {
            ?>
            <script>
                $(document).ready(function(){
                    $('#msgfield').text("Fill in all fields.");
                    $('#msgfield').fadeIn('slow');
                });
            </script>
            <?php
        } else {
            if (password_verify($_POST['currentPassword'], $hash) == false) {
                ?>
                <script>
                    $(document).ready(function(){
                        $('#msgfield').text("Current password is incorrect.");
                        $('#msgfield').fadeIn('slow');
                    });
                </script>
                <?php
            } else {
                if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30) {
                    ?>
                    <script>
                        $(document).ready(function(){
                            $('#msgfield').text("Password must be between 6 and 30 characters.");
                            $('#msgfield').fadeIn('slow');
                        });
                    </script>
                    <?php
                } else {
                    if ($_POST['password'] !== $_POST['rePassword']) {
                        ?>
                        <script>
                            $(document).ready(function(){
                                $('#msgfield').text("The passwords do not match");
                                $('#msgfield').fadeIn('slow');
                            });
                        </script>
                    <?php
                    } else {
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        mysqli_query($con, "UPDATE users SET password = '$password' WHERE username = '$username'");
                        ?>
                        <script>
                            $(document).ready(function(){
                                $('#msgfield').css("background-color", "#888800");
                                $('#msgfield').html("Password changed.");
                                $('#msgfield').fadeIn('slow');
                            });
                        </script>
                        <meta http-equiv="refresh" content="1">
                        <?php
                    }
                }
            }
        }
    }
    ?>
    <form action="" method="post">
        <ul>
            <li>
                <label>Old Password<br>
                    <input type="password" name="currentPassword" placeholder="Current Password">
                </label>
            </li>
            <li>
                <label>Password<br>
                    <input type="password" name="password" placeholder="Password">
                </label>
            </li>
            <li>
                <label>Password<br>
                    <input type="password" name="rePassword" placeholder="Repeat Password">
                </label>
            </li>
            <li>
                <input type="submit" name="changePass" value="Change">
            </li>
            <li>
                <a href="settings.php">Settings</a>
            </li>
        </ul>
    </form>

    <p id="msgfield"></p>
    <?php

} else {
    //kijkt of knop is ingedrukt
    if (isset($_POST['login'])) {
        if ($_POST['login'] == 'login') {
            if (empty($_POST['username']) == false || empty($_POST['password']) == false) {
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
                        <meta http-equiv="refresh" content="1">
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
                <input type="submit" name="login" value="login">
            </li>
        </ul>
    </form>

    <p id="msgfield"></p>
<?php
}
?>
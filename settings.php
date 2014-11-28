<?php
include '_inc/header.php';
//kijkt of session is gevuld
if (isset($_SESSION['user'])) {
    $user_data = array();
    $username = $_SESSION['user']['username'];

    //krijg gegevens met username en zet in array
    $username = trim($username);
    $query = "SELECT screen_name, email FROM users  WHERE username = '$username'";

    $data = mysqli_query($con, $query);

    //zet alle data in velden
    $email;
    foreach ($data as $info) {
        $email = $info['email'];
        ?>
        <form action="" method="post">
            <ul>
                <li>
                    <label>ScreenName<br>
                        <input type="text" name="screen_name" value="<?php echo $info['screen_name'] ?>">
                    </label>
                </li>
                <li>
                    <label>Email<br>
                        <input type="email" name="email" value="<?php echo $info['email'] ?>">
                    </label>
                </li>
                <li>
                    <a href="changePassword.php">Change Password!</a>
                </li>
                <li>
                    <input type="submit" name="save" value="Save">
                </li>
            </ul>
        </form>
        <!-- error veld -->
        <p id="msgfield"></p>
    <?php
    }
    //kijkt of knop is ingedrukt
    if (isset($_POST['save'])) {
        //kijkt of velden zijn ingevuld
        if (empty($_POST['screen_name']) || empty($_POST['email'])) {
            ?>
            <script>
                $(document).ready(function () {
                    $('#msgfield').text("Fill in all fields.");
                    $('#msgfield').fadeIn('slow');
                });
            </script>
        <?php
        } else {
            //kijkt of data te kort of te lang is.
            if (strlen($_POST['screen_name']) < 1 || strlen($_POST['screen_name']) > 30) {
                ?>
                <script>
                    $(document).ready(function () {
                        $('#msgfield').text("Screen name must have 1 character and can be 30 character long.");
                        $('#msgfield').fadeIn('slow');
                    });
                </script>
            <?php
            } else {
                //checkt of email al bestaat
                if (doesEmailExist($_POST['email']) && $_POST['email'] != $email) {
                    ?>
                    <script>
                        $(document).ready(function () {
                            $('#msgfield').text("Email is already in use.");
                            $('#msgfield').fadeIn('slow');
                        });
                    </script>
                <?php
                } else {
                    //zet gegevens in array
                    $data = array(
                        'screen_name' => $_POST['screen_name'],
                        'email' => $_POST['email'],
                        'username' => $username
                    );
                    updateUser($data);
                    ?>
                    <script>
                        $(document).ready(function(){
                            $('#msgfield').css("background-color", "#888800");
                            $('#msgfield').html("Settings are saved.");
                            $('#msgfield').fadeIn('slow');
                        });
                    </script>
                    <?php
                    echo '<meta http-equiv="Refresh" content="1">';
                }
            }
        }
    }
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

                    //kijkt of wachtwoord klopt
                    if (password_verify($_POST['password'], $hash)) {
                        //zet gegevens in session
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
                <input type="submit" name="login" value="login">
            </li>
        </ul>
    </form>

    <p id="msgfield"></p>
<?php
}
?>
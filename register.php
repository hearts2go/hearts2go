<?php
$helpChapter = 'login';
include_once "_inc/header.php";

if (isset($_POST['register']) === true) {
    if (empty($_POST['username']) === true || empty($_POST['password']) === true || empty($_POST['re_password']) === true || empty($_POST['screenname']) === true) {
        $error[] = '';
        ?>
        <script>
            $(document).ready(function(){
                $('#msgfield').html('All fields marked with a \'*\' are required.');
                $('#msgfield').fadeIn('slow');
            });
        </script>
    <?php
    } else {
        if (doesUsernameExist($_POST['username']) === true) {
            $error[] = '';
            ?>
            <script>
                $(document).ready(function(){
                    $('#msgfield').html('The username \'' . $_POST['username'] . '\' is already taken.');
                    $('#msgfield').fadeIn('slow');
                });
            </script>
        <?php
        } if (strlen($_POST['username']) < 3 || strlen($_POST['username']) > 30) {
            $error[] = '';
            ?>
            <script>
                $(document).ready(function(){
                    $('#msgfield').html('This username is too long or too short; it must be between 3 and 30 characters long.');
                    $('#msgfield').fadeIn('slow');
                });
            </script>
        <?php
        } if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 40) {
            $error[] = '';
            ?>
            <script>
                $(document).ready(function(){
                    $('#msgfield').html('This password is too long or too short; it must be between 5 and 40 characters long.');
                    $('#msgfield').fadeIn('slow');
                });
            </script>
        <?php
        } if ($_POST['password'] !== $_POST['re_password']) {
            $error[] = '';
            ?>
                <script>
                    $(document).ready(function(){
                        $('#msgfield').html('The filled in passwords don\'t match.');
                        $('#msgfield').fadeIn('slow');
                    });
                </script>
            <?php
        }
    }

    if (empty($error)) {
        $register_data = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'screen_name' => $_POST['screenname'],
            'email' => $_POST['email']
        );

        $register_profile = array(
            'username' => 0,
            'gespeeld' => 0,
            'gewonnen' => 0,
            'laatste' => 0,
            'duimpjes' => 0,
            'moons' => 0,
            'totaal_heen' => 0,
            'totaal_terug' => 0
        );

        register_user($register_data, $register_profile);
        ?>
        <script>
            $(document).ready(function(){
                $('#msgfield').css("background-color", "#888800");
                $('#msgfield').html('Registration successful!');
                $('#msgfield').fadeIn('slow');
            });
        </script>
    <?php
    }
}
?>
<form action="" method="post">
    <label>Username *<br>
        <input type="text" name="username" placeholder="Username">
    </label>
    <br>
    <label>Password *<br>
        <input type="password" name="password" placeholder="Password">
    </label>
    <br>
    <label>Repeat Password *<br>
        <input type="password" name="re_password" placeholder="Repeat Password">
    </label>
    <br><br>
    <label>Screen Name *<br>
        <input type="text" name="screenname" placeholder="Screen Name">
    </label>
    <br>
    <label>E-Mail<br>
        <input type="email" name="email" placeholder="E-Mail">
    </label>
    <br><br>
    <label>
        <input type="submit" name="register" value="Register">
    </label>
</form>

<p>Fields marked with an asterisk (*) are required.</p>
<?php
include_once "_inc/footer.php";
?>

<p id="msgfield"></p>
<?php
//zet page name in variable
$helpChapter = 'login';
include_once "_inc/header.php";

//kijkt of submit is ingedrukt
if (isset($_POST['register']) === true) {
    //kijkt of alles is ingevuld
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
        //kijkt of username in database staat zoja dan geef error
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
            //kijkt of username te lang of te kort is.
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
            //kijkt of password te lang of te kort is.
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
            //kijkt of beide wachtwoorden die ingevuld zijn gelijk zijn.
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
    //kijkt of error list leeg is.
    if (empty($error)) {
        //zet gegevens in array
        $register_data = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'screen_name' => $_POST['screenname'],
            'email' => $_POST['email']
        );

        //vult gegevens in om profile te kunnen bekijken anders is profile leeg.
        $register_profile = array(
            'username' => $_POST['username'],
            'gespeeld' => 0,
            'gewonnen' => 0,
            'laatste' => 0,
            'duimpjes' => 0,
            'moons' => 0,
            'totaal_heen' => 0,
            'totaal_terug' => 0
        );

        //registreerd de user
        register_user($register_data, $register_profile);
        ?>
        <!-- voert na het registreren door naar homepage -->
        <meta http-equiv="refresh" content="1 ,URL=index.php">
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
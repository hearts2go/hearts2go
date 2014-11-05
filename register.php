<?php
$helpChapter = 'login';
include_once "_inc/header.php";


if (isset($_POST['register']) === true) {
    if (empty($_POST['username']) === true) {
        $error[] = '\'Username\' is not filled in.';
    } if (empty($_POST['password']) === true) {
        $error[] = '\'Password\' is not filled in.';
    } if (empty($_POST['re_password']) === true) {
        $error[] = '\'Repeated Password\' is not filled in.';
    } if (empty($_POST['screenname']) === true) {
        $error[] = '\'Screen Name\' is not filled in.';
    } else {
        if (doesUsernameExist($_POST['username']) === true) {
            $error[] = 'The username \'' . $_POST['username'] . '\' is already taken.';
        } if (strlen($_POST['username']) < 3 || strlen($_POST['username']) > 30) {
            $error[] = 'This username is too long or too short; it must be between 3 and 30 characters long.';
        } if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 40) {
            $error[] = 'This password is too long or too short; it must be between 5 and 40 characters long.';
        } if ($_POST['password'] !== $_POST['re_password']) {
            $error[] = 'The filled in passwords don\'t match.';
        }
    }

    $user_data = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'screen_name' => $_POST['screenname'],
        'email' => $_POST['email']
    );

    $profile_data = array(
        'username' => $_POST['username'],
        'gespeeld' => 0,
        'gewonnen' => 0,
        'laatste' => 0,
        'duimpjes' => 0,
        'moons' => 0,
        'totaal_heen' => 0,
        'totaal_terug' => 0
    );

    if (empty($error) === false) {
        echo error_handeling($error);
    } else {
        if (register_user($user_data, $profile_data) === true) {
            register_user($register_data, $profile_data);
            echo 'Registration successful!';
            exit();
        } else {
            echo 'Something went wrong with the registration. Please click here to submit a bug report!';
        }
    }
}
?>
<form action="" method="post">
    <table>
        <tr>
            <label>
                <td>Username *</td>
                <td><input type="text" name="username" placeholder="Username"></td>
                <!--<td>Available</td>-->
            </label>
        </tr>
        <tr>
            <label>
                <td>Password *</td>
                <td><input type="password" name="password" placeholder="Password"></td>
                <!--<td>Available</td>-->
            </label>
        </tr>
        <tr>
            <label>
                <td>Repeat Password *</td>
                <td><input type="password" name="re_password" placeholder="Repeat Password"></td>
                <!--<td>Available</td>-->
            </label>
        </tr>

        <tr>
            <label>
                <td>Screen Name *</td>
                <td><input type="text" name="screenname" placeholder="Screen Name"></td>
                <!--<td>Available</td>-->
            </label>
        </tr>
        <tr>
            <label>
                <td>E-Mail</td>
                <td><input type="email" name="email" placeholder="E-Mail"></td>
                <!--<td>Available</td>-->
            </label>
        </tr>
        <tr>
            <label>
                <td><input type="submit" name="register" value="Register"></td>
            </label>
        </tr>
    </table>
</form>

    <p class="required">Fields marked with an asterisk (*) are required.</p>
<?php
include_once "_inc/footer.php";
?>
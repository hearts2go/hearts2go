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
    
    $register_data = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'screen_name' => $_POST['screenname'],
        'email' => $_POST['email']
    );
    
    if (empty($error) === false) {
        echo error_handeling($error);
    } else {
        if (register_user($register_data) === true) {
            register_user($register_data);
            echo 'Registration successful!';
            exit();
        } else {
            echo 'Something went wrong with the registration. Please click here to submit a bug report!';
        }
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
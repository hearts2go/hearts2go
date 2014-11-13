<?php
function register_user($user_data, $profile_data) {
    global $con;
    $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);

    $fields_user = implode(', ', array_keys($user_data));
    $data_user = '\'' . implode('\', \'', $user_data) . '\'';

    $fields_profile = implode(', ', array_keys($profile_data));
    $data_profile = '\'' . implode('\', \'', $profile_data) . '\'';

    mysqli_query($con, "INSERT INTO users($fields_user) VALUES ($data_user)");
    mysqli_query($con, "INSERT INTO profile($fields_profile) VALUES ($data_profile)");
}

function updateUser($data) {
    global $con;
    $screenName = $data['screen_name'];
    $email = $data['email'];
    $username = $data['username'];
    mysqli_query($con, "UPDATE users SET screen_name = '$screenName', email = '$email' WHERE username = '$username'");
}

function doesUsernameExist($username) {
    global $con;
    $username = mysqli_real_escape_string($con, $username);

    return mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM users WHERE username = '$username'")) ? true : false;
}

function doesEmailExist($email) {
    global $con;
    $username = mysqli_real_escape_string($con, $email);

    return mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM users WHERE email = '$email'")) ? true : false;
}

function error_handeling($error) {
    return '<ul class="error"><li class="error">' . implode('</li><li class="error">', $error) . '</li></ul>';
}

function array_sanitize(&$item) {
    global $con;
    $item = htmlentities(mysqli_real_escape_string($con, $item));
}

function print_array($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
?>
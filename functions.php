<?php
//registreer je een nieuwe gebruiker.
function register_user($user_data, $profile_data) {
    global $con;
    $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);
    $user_data['date'] = date('Y-m-d');

    $fields_user = implode(', ', array_keys($user_data));
    $data_user = '\'' . implode('\', \'', $user_data) . '\'';

    $fields_profile = implode(', ', array_keys($profile_data));
    $data_profile = '\'' . implode('\', \'', $profile_data) . '\'';

    mysqli_query($con, "INSERT INTO users($fields_user) VALUES ($data_user)");
    mysqli_query($con, "INSERT INTO profile($fields_profile) VALUES ($data_profile)");
}
//update je de gegevens van de gebruiker!
function updateUser($data) {
    global $con;
    $screenName = $data['screen_name'];
    $email = $data['email'];
    $username = $data['username'];
    mysqli_query($con, "UPDATE users SET screen_name = '$screenName', email = '$email' WHERE username = '$username'");
}

//check je of de username bestaat of niet.
function doesUsernameExist($username) {
    global $con;
    $username = mysqli_real_escape_string($con, $username);

    return mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM users WHERE username = '$username'")) ? true : false;
}

//check je of de email bestaat of niet.
function doesEmailExist($email) {
    global $con;
    $username = mysqli_real_escape_string($con, $email);

    return mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM users WHERE email = '$email'")) ? true : false;
}

//print je de error(s) die in een array gezet zijn netjes uit.
function error_handeling($error) {
    return '<ul class="error"><li class="error">' . implode('</li><li class="error">', $error) . '</li></ul>';
}

//Print array mooi uit.
function print_array($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function dateToNL($date) {
    // Nederlandse namen van dagen en maanden, beginnend op 1 ipv 0 (is makkelijker);
    $dagen = array(1 => "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag", "zondag");
    $maanden = array(1 => "januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december");

    // Opsplitsen van de data;
    $temp = explode("-", $date);

    // Invullen variabelen;
    // Left trimmen om de voorlopende 0 te verwijderen
    $dag = ltrim($temp[2], "0");
    $maand = ltrim($temp[1], "0");
    $jaar = $temp[0];

    // Dag ophalen van de datum:
    // Waarbij N staat voor day of the week
    $dagnr = date("N", mktime(0, 0, 0, $maand, $dag, $jaar));

    // Teruggeven van de datum in het juiste formaat.
    return $dagen[$dagnr] . " " . $dag . " " . $maanden[$maand] . " " . $jaar;
}
?>
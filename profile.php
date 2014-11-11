<?php
include '_inc/header.php';

$user_data = array();
$username = 'mathieu';

//krijg gegevens met username en zet in array
$username = trim($username);
$query = "SELECT u.*, p.* FROM users AS u INNER JOIN profile as p ON u.username = p.username WHERE u.username = '$username'";

$data = mysqli_query($con, $query);

foreach ($data as $info) {
    //screen name
    echo 'Naam: ' . $info['screen_name'] . '<br>';

    //gespeelde games
    echo 'Aantal gespeelde games: ' . $info['gespeeld'] . '<br>';

    //gewonnen
    echo 'Aantal gewonnen games: ' . $info['gewonnen'] . '<br>';

    //laatste
    echo 'Aantal laatste geworden: ' . $info['laatste'] . '<br>';

    //duimpjes
    echo 'Aantal duimpjes: ' . $info['duimpjes'] . '<br>';

    //alles behaald
    echo 'Aantal alle punten: ' . $info['moons'] . '<br>';

    //totaal heen
    echo 'Totaal aantal punten heen: ' . $info['totaal_heen'] . '<br>';

    //totaal terug
    echo 'Totaal aantal punten terug: ' . $info['totaal_terug'] . '<br>';

    //registerd date
    echo 'Begonnen met \'Hearts2Go\' te gebruiken: ' . date("l j F Y", $info['date']) . '<br>';

    echo date("l j F Y");
}
?>
<?php

// Haetaan tekstitiedostolta yhteystiedot ja asetetaan ne muuttujiin.
$initials = parse_ini_file(".database_inifile.ini");
$database = $initials["database"];
$dbpasswd = $initials["dbpasswd"];
$dbuser = $initials["dbuser"];
$server = $initials["server"];
$tbFB = $initials["tbFB"];

$json = $_POST["review"];
$review = json_decode($json, false);

$star = $review->star;
$nickname = $review->nickname;
$email = $review->email;
$age = $review->age;
$guest = $review->guest;
$textarea = $review->textarea;
$status = '0';

// Testataan onko mikään lomakkeen osista jätetty tyhjäksi. Huom! Textarea saa olla tyhjä, joten ei listassa.
if (!isset($star) || !isset($nickname) || !isset($email) || !isset($age) || !isset($guest) 
|| empty($star) || empty($nickname) || empty($email) || empty($age) || empty($guest)) {
    print "Fill in all required fields!";
    exit;
    
// Kun tyhjiä ei ole, tsekataan onko Nickname ja Email kirjoitettu oikein.
} else {
    $nickname = test_nickname($nickname);
    $email = test_email($email);

    // Jos Nicknamen ja Emailin arvot selviävät molemmat tarkistuksesta, tarkistetaan ne ja Textarean mahdollinen teksti vielä eri tavoin.
    $nickname = test_input($nickname);
    $email = test_input($email);
    $textarea = test_input($textarea);
}

// Funktio validoinneille.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

// Funktio Nicknamen läpikäymiselle.
function test_nickname($nickname) {
    if (preg_match("/^[a-zA-Z-' ]*$/", $nickname)) {
        // echo("Nickname: $nickname is a valid nickname.<br>");
        return $nickname;
    
    } else {
        echo("Nickname: Only letters and whitespaces allowed.<br>");
        exit;
    }
}

// Funktio Emailin läpikäymiselle.
function test_email($email) {
    // Poistetaan sallimattomat merkit
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Emailin validointi
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // echo("Email: $email is a valid email address<br>");
        return $email;

    } else {
        echo("Email: Invalid email format.<br>");
        exit;
    }
}

//Tietokantaan yhdistys

// Määritetään yhteys (palvelin, käyttäjätunnus, salasana, tietokanta)
$yhteys = mysqli_connect($server, $dbuser, $dbpasswd, $database);

// Tarkistetaan yhteys
if (!$yhteys) {
    print "There seems to be an error in connection.";
    exit;
}

// Viedään tiedot tietokantaan
$sql = "insert into $tbFB(nickname, email, age, guest, rating, feedback, status) values(?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'sssssss', $nickname, $email, $age, $guest, $star, $textarea, $status);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

// Kerrotaan tietojen onnistuminen.
print "Review added successfully!<br>";

?>
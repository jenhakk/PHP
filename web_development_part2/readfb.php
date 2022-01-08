<?php
// Haetaan tunnukset tekstitiedostolta ja asetetaan ne muuttujiin.
$initials = parse_ini_file(".database_inifile.ini");
$database = $initials["database"];
$dbpasswd = $initials["dbpasswd"];
$dbuser = $initials["dbuser"];
$server = $initials["server"];
$tbFB = $initials["tbFB"];

//Tietokantaan yhdistys

// Määritetään yhteys (palvelin, käyttäjätunnus, salasana, tietokanta)
$yhteys = mysqli_connect($server, $dbuser, $dbpasswd, $database);

// Tarkistetaan yhteys
if (!$yhteys) {
    print "There seems to be an error in connection.";
    exit;
}

// Haetaan viimeinen rivi taulusta tiedot taulusta.
//$tulos = mysqli_query($yhteys, "SELECT * FROM amanda20104_feedback WHERE id = (SELECT max(id) FROM amanda20104_feedback)");

// Haetaan kolme viimeistä riviä laskevassa järjestyksessä.
//$tulos = mysqli_query($yhteys, "SELECT * FROM amanda20104_feedback ORDER BY id DESC LIMIT 3");

// Haetaan kolme viimeistä riviä nousevassa järjestyksessä.
//$tulos = mysqli_query($yhteys, "SELECT * FROM (SELECT * FROM $tbFB where status = 1 ORDER BY id DESC LIMIT 3) as threelatest ORDER BY id");

// Haetaan kolme viimeistä riviä laskevassa järjestyksessä.
$tulos = mysqli_query($yhteys, "SELECT * FROM $tbFB WHERE status = 1 ORDER BY id DESC LIMIT 3");
// Haetaan muuttujaan sql-haku ja asetetaan ne muuttujiin.
while ($row = mysqli_fetch_object($tulos)) {
    $nickname = $row->nickname;
    $rating = $row->rating;
    $feedback = $row->feedback;

    print "<b>$nickname&nbsp;&nbsp;$rating</b><br>
    <i>$feedback</i><br><hr>";
}

mysqli_close($yhteys);

?>
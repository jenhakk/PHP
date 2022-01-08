<?php
// Haetaan tunnukset tekstitiedostolta ja asetetaan ne muuttujiin.
$initials = parse_ini_file(".database_inifile.ini");
$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbFB = $initials["tbFB"];

// Jos 'nickname' syöte on olemassa, asetetaan muuttujaan muutettavan tietueen id.
if (isset($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
}

if (isset($_POST['feedback'])) {
    $feedback = $_POST['feedback'];
} 

if (isset($_POST['status'])) {
    $status = $_POST['status'];
} 

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} 

// Jos jotain arvoista ei ole asetettu, palataan toiselle sivulle.
if (!(isset($nickname) || isset($feedback) || isset($status) || isset($id))) {
    header('Location: feedbackadmin.php');
    exit;
}

// Määritetään yhteys (palvelin, käyttäjätunnus, salasana, tietokanta)
$yhteys = mysqli_connect($server, $dbuser, $dbpasswd, $database);

// Tarkistetaan yhteys
if (!$yhteys) {
    print "There seems to be an error in connection.";
    exit;
}

// Viedään tiedot tietokantaan
$sql = "update $tbFB set nickname = ?, feedback = ?, status = ? where id = ?";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ssii',  $nickname, $feedback, $status, $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

header('Location: feedbackadmin.php');
?>
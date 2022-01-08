<?php

session_start();


include "header.html";


//$username = $_SESSION["username"];
//$username= "nakke";
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tborder = $initials["tborder"];


$ruoka=(isset($_POST["ruoka"]) ? $_POST["ruoka"] : "");
$juoma=(isset($_POST["juoma"]) ? $_POST["juoma"] : "");
$maksutapa=(isset($_POST["maksutapa"]) ? $_POST["maksutapa"] : "");
$username = $_SESSION["username"];


#yhteys tietokantaan
 $yhteys = mysqli_connect($server, $dbuser, $dbpasswd);

#virheilmoitukset, jos tietokantaan ei saada yhteyttä
if (!$yhteys) {
	print "Tietojentallennuksessa tapahtui virhe.";
	exit;
}

$tietokanta=mysqli_select_db($yhteys, $database);

if (!$tietokanta) {
	print "Tietokannan valinta epäonnistui.";
	exit;
}

#jos tietokantaan saadaan yhteys, talletetaan tiedot valittuun tietokantaan. 
$sql="insert into jonna20122_tilaus1(ruoka, juoma, maksutapa, astunnus) values(?, ?, ?, ?)";


$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'iiis', $ruoka, $juoma, $maksutapa, $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);


include "vahvistus.php"; 

?>

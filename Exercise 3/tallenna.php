<?php

$enimi=$_POST["enimi"];
$snimi=$_POST["snimi"];


$yhteys = mysqli_connect("localhost", "trtkp20a3", "trtkp20a3passwd");

// Check connection
if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	header("Location:virhe.html");
	exit;
}

$tietokanta=mysqli_select_db($yhteys, "trtkp20a3");
if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	header("Location:virhe.html");
	exit;

}

$sql="insert into jenna20100_nimet(etunimi, sukunimi) values(?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $enimi, $snimi);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

header("Location:kiitos.html");
exit;

?>

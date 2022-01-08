<?php

//TÄNNE LÄHETÄÄN KÄYTTÄJÄTUNNUS JOLLA HAETAAN KÄYTTÄJÄN TIEDOT TIETOKANNASTA JA PAKATAAN JSONI:IKSI JOKA TAAS LÄHETETÄÄN TAKAISIN USERS.PHP:LLE


//otetaan tiedot ini-tiedostosta tietokantaa varten
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbusers = $initials["tbusers"];


//otetaan vastaan users.php:ltä tullut tieto muuttujaan $user
$user = $_GET['tunnus'];

$yhteys=mysqli_connect($server, $dbuser, $dbpasswd);

if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	print "Yhteyden muodostus epäonnistui!";
	exit;
  }



$tietokanta=mysqli_select_db($yhteys, $database);

if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	print "Tietokannan valinta epäonnistui!";	
	exit;
}


//Haetaan tietokannasta käyttäjän tiedot tunnuksen perusteella
$sql="select * from $tbusers where tunnus=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);
//$fname=$lname=$number=$email=$username="tadaa";

//puretaan rivi muuttujiksi
while ($rivi=mysqli_fetch_object($tulos)){

	
    $fname = $rivi->etunimi;
    $lname = $rivi->sukunimi; 
    $number = $rivi->puhelin; 
    $email = $rivi->email;
	$username = $rivi->tunnus;

}

//luodaan uusi luokkaolio
	$person=new class{};

	//annetaan sille tietokannan tiedot
	$person->fname=$fname;
	$person->lname=$lname;
	$person->number=$number;
	$person->email=$email;
	$person->user=$username;

	//pakataan jsoniksi
	$x=json_encode($person);

	//Tulostetaan json
	print $x; 

?>
<?php
//haetaan mysql-kirjautumistietot erillisestä tiedostosta
$initials=parse_ini_file(".db_inifile.ini");
$table = $initials["table"];

//laitetaan tiedot muuttujiin
$database = $initials["databasename"];
$user = $initials["user"];
$passwd = $initials["passwd"];
$server = $initials["server"];

//otetaan vastaan json-taulukko "kala" ja puretaan se muuttujiin
$json=$_POST["kala"];
$kala=json_decode($json, false);

$laji = $kala->laji;
$pituus = $kala->pituus;
$paino = $kala->paino;

//jos muuttujat tyhjiä, tulostetaan käyttäjälle ilmoitus
if (empty($laji) || empty($pituus) || empty($paino)) {
    print "Täytä kaikki kentät!";
    exit;
}

//jos paino tai pituus eivät ole numeroita, tulostetaan käyttäjälle ilmoitus
if(!is_numeric($pituus) || !is_numeric($paino)) {

	print "Pituus ja paino voivat olla vain numeromuodossa!";
	exit;
}

//jos laji on numeraalinen, tulostetaan käyttäjälle ilmoitus
if (is_numeric($laji)) {
    print "Kirjoita kalalaji";
    exit;
}

//luodaan yhteys tietokantaan, käytetään tiedoissa aiemmin määriteltyjä muuttujia
$yhteys = mysqli_connect("$server", "$user", "$passwd");

// Check connection
if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	print "Tallennus epäonnistui!";
	exit;
    }

$tietokanta=mysqli_select_db($yhteys, "$database");
if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	print "Tallennus epäonnistui!";	
	exit;

    
}

//syötetään tietokannan tauluun aikaisemmin lomakkeelta saadut tiedot
$sql="insert into $table(laji, pituus, paino) values(?, ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'sii', $laji, $pituus, $paino);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);

print "Tallennus onnistui!";
//exit;


?>
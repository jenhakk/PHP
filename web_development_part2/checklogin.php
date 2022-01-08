<?php

//MIKÄLI JOSSAIN KOHTAA TAPAHTUU VIRHE, LOGIN-SIVU PÄIVITETÄÄN VAIN UUDESTAAN, VIRHEILMOITUSTA EI TÄLLÄ HETKELLÄ TULE, PAITSI VIIMEISESTÄ OSIOSTA

//startataan session
session_start();

//luetaan ini-tiedostosta tietokantakäsittelyyn tarvittavat tiedot
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbID = $initials["tbID"];



//luetaan lomakkeelta käyttäjätunnus ja salasana ja napin painalluksesta siirrytään tähän tiedostoon,
//joka tarkistaa löytyykö tietokannasta syötettyjä tunnuksia.


//puretaan JSONin tiedot muuttujiin
$json=$_POST["log"];
$log=json_decode($json, false);

$username = $log->username;
$password = $log->password;


if (empty($username) || empty($password)) {
    
    //print "registration.html";
    exit;
	
} else {

	//Testataan tiedot (funktio lopussa)
	$username = test_input($username);
	$password = test_input($password);
}


$yhteys=mysqli_connect($server, $dbuser, $dbpasswd);

if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	//print "Yhteyden muodostus epäonnistui!";
	exit;
  }



$tietokanta=mysqli_select_db($yhteys, $database);

if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	//print "Tietokannan valinta epäonnistui!";	
	exit;

    
}

//haetaan tietokannasta onko tunnus ja salasana rekisteröity
$sql="select * from $tbID where tunnus=? and salasana=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, md5($password));
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);


//jos tunnus ja salasana löytyy, sessio on ok, ja sille asetetaan tunnus ja salasana, sekä printataan paluuosoite 
//(aina se mistä on lähdetty, määritelty niillä sivuilla erikseen)
if ($rivi=mysqli_fetch_object($tulos)) {
	$_SESSION["user_ok"]="ok";
	$_SESSION["username"]=$username;
	$_SESSION["password"]=md5($password);
	print $_SESSION["paluuosoite"];
	
	exit;

		
	} 
//jos ei löydy printataan käyttäjälle tämä

else {

	print "Logging in is not working! Please check your username and password.";

	

}
	//testataan dataa
function test_input($data) {

	//otetaan pois välilyönnit, tabulattorit, uudet rivit
	$data = trim($data);

	//poistetaan kenoviivat
	$data = stripslashes($data);
	//muunnetaan mahdolliset html-koodit eri merkeiksi jotta ne eivät toimi esim: &lt;script&gt;location.href('http://www.hacked.com')&lt;/script&gt;
	$data = htmlspecialchars($data);
	return $data;
}


?>
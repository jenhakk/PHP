<?php
//Tiedosto joka saa tiedot userlogged.php-tiedostosta

//haetaan tiedot ini-tiedostosta tietokantaa varten
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbID = $initials["tbID"];
$tbusers = $initials["tbusers"];


//puretaan JSON muuttujiin
$json=$_POST["useredit"];
$useredit=json_decode($json, false);

$fname = $useredit->firstname;
$lname = $useredit->lastname;
$number = $useredit->number;
$email = $useredit->email;
$username = $useredit->username;

//Tarkistetaan että mikään muuttuja ei ole tyhjä
if (empty($fname) || empty($lname) || empty($number) || empty($email) || !isset($fname) || !isset($lname) || !isset($number) || !isset($email)) {
    
  
    print"Fill all fields!";
	exit;

} else {

//testataan muuttujien oikeellisuus
	$email = test_email($email);
	$fname = test_input($fname);
	$lname = test_input($lname);
	$number = test_input($number);
	$username = test_input($username);

}

//luodaan yhteys tietokantaan, käytetään tiedoissa aiemmin määriteltyjä muuttujia
$yhteys = mysqli_connect($server, $dbuser, $dbpasswd);

// Check connection
if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	print "Connecting to database failed.";
	exit;
    }

$tietokanta=mysqli_select_db($yhteys, $database);
if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	print "Failed choosing database.";	
	exit;
   
}
//päivitetään tietokantaan lomakkeelta saadut tiedot
$sql="update $tbusers set etunimi=?, sukunimi=?, puhelin=?, email=? where tunnus=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ssiss', $fname, $lname, $number, $email, $username);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($yhteys);


//Jos päivitys onnistuu:
if ($ok == true) {
print "Edit succesful!";

exit;

//Jos ei:
} else {

	print "Edit failed. Please check your information and try again.";
}

//Email-osoitteen testaus
function test_email($email) {

	//otetaan pois välilyönnit, tabulattorit, uudet rivit
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	//katsotaan onko email-osoite oikeanlainen (@ ja .)
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		return $email;
	} else {

		print "Invalid email!";
		exit;
	}
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
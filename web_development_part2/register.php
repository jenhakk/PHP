<?php


//Luetaan ini-tiedostosta tietokannassa tarvittavat tiedot
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbID = $initials["tbID"];
$tbusers = $initials["tbusers"];

//Lomakkeelta lähetetyt tiedot puretaan muuttujiksi
$json=$_POST["user"];
$user=json_decode($json, false);

$fname = $user->firstname;
$lname = $user->lastname;
$number = $user->number;
$email = $user->email;
$username = $user->username;
$password = $user->password;

//Tarkistetaan että mikään muuttuja ei ole
if (empty($fname) || empty($lname) || empty($number) || empty($email) || empty($username) || empty($password)
|| !isset($fname) || !isset($lname) || !isset($number) || !isset($email) || !isset($username) || !isset($password)) {
    
    print"Fill all fields!";

} else {

//Testataan että muuttujat sisältävät sallittuja tietoja
$email = test_email($email);
$username = test_username($username);
}

$fname = test_input($fname);
$lname = test_input($lname);
$number = test_input($number);
$username = test_input($username);
$password = test_input($password);
$username = test_input($username);
$username = test_username($password);

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

//katsotaan onko käyttäjän valitsema tunnus jo olemassa, jos on, annetaan siitä ilmoitus
$resultset = mysqli_query($yhteys, "select * from $tbusers where tunnus = '$username' ");
 
//Jos tietorivejä löytyy muu kuin 0
if (mysqli_num_rows($resultset) != 0) {

	print "This username is already taken. Please choose another one.";
	mysqli_stmt_close($stmt);
	mysqli_close($yhteys);

	exit;


//Jos tietorivejä on 0:
} elseif (mysqli_num_rows($resultset) == 0) {

//syötetään tietokannan tauluihin aikaisemmin lomakkeelta saadut tiedot
$sql="insert into $tbusers(tunnus, salasana, etunimi, sukunimi, puhelin, email) values(?, md5(?), ?, ?, ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ssssss', $username, $password, $fname, $lname, $number, $email);
$ok = mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);



$sql="insert into $tbID(tunnus, salasana) values(?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $username, md5($password));
$ok = mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

mysqli_stmt_close($stmt);
mysqli_close($yhteys);

//Jos suoritus onnistuu, tulostetaan käyttäjälle ilmoitus joka sisältää linkin kirjautumiseen
 if ($ok == true) {
	
	print '<a href="userlogged.php">Registration succesful! Click to continue to login</a>';

	exit;

	
} else {

	print "Registration failed. Please check your information and try again.";
	
	exit;


}
}

//Email-osoitteen testaus
function test_email($email) {

	//Poistetaan laittomat merkit
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

//testataan tunnus
function test_username($username) {

	//vain kirjaimet ja välilyönnit sallittuja
	if (preg_match("/^[a-zA-Z-' ]*$/", $username)) {
		return $username;
	}
	else {

		print "Only letters a-z and whitespace allowed for username.";
		exit;
	}
}

?>  
<?php 
		 
//sis��nkirjautumisen tarkistus                
session_start();

if (!isset($_SESSION["user_ok"])) {
	$_SESSION["paluuosoite"]="bookings.php";
	header("Location:login.html");
	exit;
   
  } 
  
  $initials=parse_ini_file(".database_inifile.ini");
  
  $database = $initials["database"];
  $dbuser = $initials["dbuser"];
  $dbpasswd = $initials["dbpasswd"];
  $server = $initials["server"];
  
//puretaan JSONille l�hetetyn lauseen muuttujat yksinkertaisempaan muotoon
$json = $_POST["tiedot"];
$varaustiedot = json_decode($json, false);
$pvm = $varaustiedot->pvm;
$klo = $varaustiedot->klo;
$henkilomaara = $varaustiedot->henkilomaara;
$etunimi = $varaustiedot->etunimi;
$sukunimi = $varaustiedot->sukunimi;
$puhelin = $varaustiedot->puhelin;
$email = $varaustiedot->email;
$textbox = $varaustiedot->textbox;
                 
$username = $_SESSION["username"];
                        
 
//yhteyden muodostus tietokantaan
$yhteys = mysqli_connect($server, $dbuser, $dbpasswd);
if (!$yhteys) {
	print "Tietojentallennuksessa tapahtui virhe.";
	exit;
}

$tietokanta=mysqli_select_db($yhteys, $database);
if (!$tietokanta) {
	print "Tietokannan valinta epäonnistui.";
	exit;
}



 //lis�t��n tietokantaan formin kenttien sis�lt�m�t tiedot
//if ($etunimi && $sukunimi && $email && $pvm && $klo && $puhelin && $henkilomaara){
	$sql="insert into suvi20119_poytavaraukset1(etunimi, sukunimi, email, pvm, klo, puhelin, henkilomaara, tunnus, textbox) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$tunnus = $username;
	$stmt=mysqli_prepare($yhteys, $sql);
	mysqli_stmt_bind_param($stmt, "ssssssiss", $etunimi, $sukunimi, $email, $pvm, $klo, $puhelin, $henkilomaara, $tunnus, $textbox);
	
	
	$ok = mysqli_stmt_execute($stmt);

	//jos tietokantaan kirjoitus onnistui, printataan "reservation sent succesfully" nettisivulle formin alapuolelle. Muuten pyydet��n k�ytt�j�� t�ytt�m��n kaikki kent�t ensin.
	if ($ok==true) {

		print"Reservation sent successfully!";
	} else{
	
		print"Please fill all the fields!";
	

}
mysqli_stmt_close($stmt); 
?>



 






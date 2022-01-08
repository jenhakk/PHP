<!DOCTYPE html>
		
		<!--Vasen reuna: tyhjä column visualisaation vuoksi-->
		 <div class="col-sm-3">
		 </div>
		 <!--vahvistus-->
		 <div class="col-sm-9" style="padding-left:400px;">
<?php

 session_start();

if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="takeaway.php";
  header("Location:login.html");
  exit;
 
} 

$username = $_SESSION["username"];

$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tborder = $initials["tborder"]; 

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
#Haetaan tietokannasta tilausnro, ruuan nimi, juoman nimi, hinnat ja maksutapa sekä printataan vain viimeisin tilausnro
$tulos=mysqli_query($yhteys, "SELECT tilausnro, jonna20122_tuotteet.ruoka, jonna20122_tuotteet.rhinta, jonna20122_juomat.juoma, jonna20122_juomat.jhinta, jonna20122_maksu.tapa
FROM jonna20122_tilaus1 
INNER JOIN jonna20122_tuotteet on jonna20122_tilaus1.ruoka = jonna20122_tuotteet.ID
INNER JOIN jonna20122_juomat on jonna20122_tilaus1.juoma = jonna20122_juomat.ID
INNER JOIN jonna20122_maksu on jonna20122_tilaus1.maksutapa = jonna20122_maksu.ID ORDER BY tilausnro DESC LIMIT 1");

while ($rivi=mysqli_fetch_object($tulos)) {
#asetetaan hinnat valituille tuotteille muuttujiin ja lasketaan loppusumma yhteen
	$rhinta1=$rivi->rhinta;
	$jhinta1=$rivi->jhinta;
	$summa=$rhinta1+$jhinta1;
#printataan vahvistus
   	print "<br><h3>Order confirmation</h3><br>

    <b>Order number:</b> $rivi->tilausnro<br>
	<b>Food:</b> $rivi->ruoka<br>
	<b>Price:</b> $rivi->rhinta €<br>
	<b>Drink:</b> $rivi->juoma<br>
	<b>Price:</b> $rivi->jhinta €<br>
	- - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br>
    <b>Total:</b> $summa €<br>
	<b>Payment method:</b> $rivi->tapa<br>";}
?> 
<br><br><br>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="userlogged.php">Personal information</a></button>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="bookings.php">Book a table</a></button>  
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeaway.php">Order takeaway</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="orderhistory.php">Order history</a></button><br><br>                    
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button>

<?php
include "footer.html";
mysql_close($yhteys);

?>
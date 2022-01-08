<?php
session_start();

if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="orderhistory.php";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Admin's page">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Order history</title>
  
    



</head>
<body>
  <!--Container alkaa-->
  <div class="container-fluid" style="position:relative;">
      
    <!--"header alkaa"-->
  
  <div class="row" style="position:sticky; top: 0px; z-index: 1;">
  
    <div class="col-12 text-center" style="background-color: white; max-height: 180px; display:inline; ">
      
      <a href="index.html"><img src="images/Ravintolanlogo5.jpeg" class="logo" alt="Bistré's logo and name"></a>

    </div>
    <!--navbar alkaa-->
    <div class="row" style="background-color:white; min-height: 15px; position: relative; bottom:0px; margin:0;">
  <div class="col">
    <nav class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
       <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.html" style="color:black">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.html" style="color:black">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.html" style="color:black">About us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="book.html" style="color:black">Book a table</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html" style="color:black">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="userlogged.php" style="color:black">User page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="secret/admin.html" style="color:black">Admin</a>
          </li>
      </ul>
    </div>
  </nav>
  
</div>
</div> <!--navbar loppuu-->
</div><!--header loppuu-->
    
            <!--Sisältö alkaa-->
            <div class="row" style="min-height: 1000px; background-color: rgb(209, 205, 205);">
               
            <div class="col-md-5">
            </div>     

<div class = "col-md-5" style = "padding-bottom: 10px;">
<h2 style=" margin-top: 1em;">Take away orders</h2>
            

<?php
#Haetaan tietokannasta tilausnro, ruuan nimi, juoman nimi, hinnat ja maksutapa sekä printataan vain viimeisin tilausnro
$tulos=mysqli_query($yhteys, "SELECT tilausnro, jonna20122_tuotteet.ruoka, jonna20122_tuotteet.rhinta, jonna20122_juomat.juoma, 
jonna20122_juomat.jhinta, jonna20122_maksu.tapa, jenna20100_kayttajat.tunnus
FROM jonna20122_tilaus1 
INNER JOIN jonna20122_tuotteet on jonna20122_tilaus1.ruoka = jonna20122_tuotteet.ID
INNER JOIN jonna20122_juomat on jonna20122_tilaus1.juoma = jonna20122_juomat.ID
INNER JOIN jonna20122_maksu on jonna20122_tilaus1.maksutapa = jonna20122_maksu.ID 
INNER JOIN jenna20100_kayttajat on jonna20122_tilaus1.astunnus = jenna20100_kayttajat.tunnus 
WHERE tunnus='$username'
ORDER BY tilausnro DESC LIMIT 10");

print "<br><h3>Your orders</h3>";
while ($rivi=mysqli_fetch_object($tulos)) {
#asetetaan hinnat valituille tuotteille muuttujiin ja lasketaan loppusumma yhteen
	$rhinta1=$rivi->rhinta;
	$jhinta1=$rivi->jhinta;
	$summa=$rhinta1+$jhinta1;

   	print "* * * * * * * * * * * * * * * * * * * * * * * * * *<br>
	<b>Customer:</b> $rivi->tunnus<br>
	<b>Order number:</b> $rivi->tilausnro<br>
	<b>Food:</b> $rivi->ruoka<br>
	<b>Price:</b> $rivi->rhinta €<br>
	<b>Drink:</b> $rivi->juoma<br>
	<b>Price:</b> $rivi->jhinta €<br>
	<br>
    	<b>Total:</b> $summa €<br>
	<b>Payment method:</b> $rivi->tapa<br>";}
	print "* * * * * * * * * * * * * * * * * * * * * * * * * *";


?><br><br><br><br>
</div>

<div class="col-md-2">
</div>

<div class="row">
<div class="col-md-3">
</div>

<div class="col-md-6">

<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="userlogged.php">Personal information</a></button>
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeaway.php">Order take away</a></button>       
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="bookings.php">Book a table</a></button>
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="reservationhistory.php">Latest reservation</a></button><br><br> 
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button> 
<br><br>
</div>
<div class="col-md-2">
</div>

</div>         
            </div> <!--Sisältö loppuu-->

            <!--Footer alkaa-->
            <div class="row" style="min-height: 200px; background-color: rgb(0, 0, 0); color: white; padding-top: 40px;">
                  
              <!--Vasen reuna: tyhjä column visualisaation vuoksi-->
              <div class="col-sm-2">
              </div>

              <!--Contact info-->
              <div class="col-sm-3">
                <h4 style = "font-size: 20px;">CONTACT</h4>
                <p>Bistré<br>
                  Vankanlähde 9, 13101 Hämeenlinna<br>
                  Tel. +358 10 123 4567<br>
                  info@bistre.fi</p>
              </div>

              <!--Aukioloajat-->
              <div class="col-sm-3">
                <h4 style = "font-size: 20px;">OPEN</h4>
                <p>Monday-Friday:  11:00 - 22:00<br>
                  Saturday:  11:00 - 23:00<br>
                  Sunday:  12:00 - 23:00</p>
              </div>

              <!--Linkkejä: Menu-->
              <div class="col-sm-3">
                <div class="row" style = "margin-bottom: 15px;">
                  <h4 style = "font-size: 20px;">FOLLOW US ON</h4>
                  &nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/" class="fab fa-facebook"></a>
                  <a href="https://twitter.com/?lang=fi" class="fab fa-twitter"></a>
                  <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
              </div>

              <!--Oikea reuna: tyhjä column visualisaation vuoksi-->
              <div class="col-sm-2">
              </div>
            </div> <!--Footer loppuu-->
         
    </div> <!-- container loppuu-->
        
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</body>
</html>

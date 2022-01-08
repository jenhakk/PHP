<?php

//Startataan sessio
session_start();

//jos ei ole kirjauduttu, siirretään käyttäjä kirjautissivulle ja onnistuneen kirjautumisen jälkeen palataan takaisin tälle sivulle
if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="userlogged.php";
  header("Location:login.html");
  exit;

} 

//haetaan ini-tiedostosta tietokannassa tarvittavat tiedot
$initials=parse_ini_file(".database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];
$tbusers = $initials["tbusers"];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Users page">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>User page</title>
  

    <!-- Funktio joka hakee tiedot formilta ja lähettää ne edit.php-tiedostoon, joka päivittää tiedot tietokantaan-->
    <script>
      function sendData(form){
        //Tehdään uusi objeti useredit
          var useredit=new Object();

          //luodaan muuttujat jokaiselle formin arvolle ja trimmataan ja tarkistetaan että merkkejä on enemmän kuin 1, jos ei ole, annetaan window alert käyttäjälle
         var firstname = form.firstname.value;
          firstname = (firstname.trim());
          var lastname = form.lastname.value;
          lastname = (lastname.trim());
          var number = form.number.value;
          number = (number.trim());
          var email = form.email.value;
          email = (email.trim());
          var username = form.username.value;
          username = (username.trim());
          

            if (firstname.length < 1 || lastname.length <1 || number.length < 1 || email.length < 1 ) {
	          window.alert("Fill all fields!");
	          return;
	          }
           

          //annetaan arvot jsonia varten
          useredit.firstname=form.firstname.value;
          useredit.lastname=form.lastname.value;
          useredit.number=form.number.value;
          useredit.email=form.email.value;
          useredit.username=form.username.value;
         
          var x=JSON.stringify(useredit);
          
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

              //kun php on valmis, tulostetaan ilmoitus käyttäjälle p-tagiin
              document.getElementById("result").innerHTML = this.responseText;
              //document.getElementById("editform").reset();
            }
          };
          xmlhttp.open("POST", "edit.php", true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send("useredit=" + x);	
      }
          </script> 



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
            <div class="row" style="min-height: 600px; background-color: rgb(209, 205, 205);">
               
            <div class="col-md-2">
            </div>     

<div class = "col-md-8" style = "padding-bottom: 10px;">
<h1>Welcome to your page!</h1>
            
<p style="text-align:center;">Here you can check your user information, make table reservations and take away orders!</p><br>

<h2>User information</h2>
<p>Please check that your information is up to date.</p><br>

<!--asetetaan muuttujiin sessionista saatavat tunnus ja salasana joita voidaan käyttää tietokannasta haussa -->
<?php
$username = $_SESSION["username"];
$password = $_SESSION["password"];


$yhteys=mysqli_connect($server, $dbuser, $dbpasswd);

if (!$yhteys) {
	//die("Yhteyden muodostaminen epäonnistui: " . mysqli_connect_error());
	print "Connecting to database failed.";
	exit;
  }

$tietokanta=mysqli_select_db($yhteys, $database);

if (!$tietokanta) {
	//die("Tietokannan valinta epäonnistui: " . mysqli_connect_error());
	print "Failed choosing database";	
	exit;

    
}

//haetaan tietokannasta tunnuksen ja salasanan perusteella käyttäjän tiedot jotka tallennettu rekisteröinnissä
$sql="select * from $tbusers where tunnus=? and salasana=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

//jos tiedot löytyvät, ne asetetaan muuttujiin, jotka tulostetaan formissa inputtien arvoiksi

while ($rivi=mysqli_fetch_object($tulos)){
    $fname = $rivi->etunimi;
    $lname = $rivi->sukunimi; 
    $number = $rivi->puhelin; 
    $email = $rivi->email;
    $username = $rivi->tunnus;
}

$ok=mysqli_close($yhteys);
?>



    <form class = "row g-3" id="editform">
                               
                    <!--First name-->
                    <div class = "col-md-6">
                      <label for = "firstname" class = "form-label">First name</label>
                      <!-- Seuraavan rivin lopussa printattu tietokannasta saatu arvo formille-->
                      <input type = "text" class = "form-control" name = "firstname" value="<?php print $fname; ?>">
                    </div>
        
                    <!--Last Name-->
                    <div class = "col-md-6">
                        <label for = "lastname" class = "form-label">Last name</label>
                        <input type = "text" class = "form-control" name = "lastname" value="<?php print $lname; ?>">
                    </div>
        
                    <!--Phone Number-->
                    <div class = "col-md-6">
                      <label for = "number" class = "form-label">Phone number</label>
                      <input type = "tel" class = "form-control" name = "number" value="<?php print $number; ?>">
                    </div>
        
                    <!--Email Address-->
                    <div class = "col-md-6">
                        <label for = "email" class = "form-label">Email</label>
                        <input type = "email" class = "form-control" name = "email" value="<?php print $email; ?>">
                    </div>

                    <!--Username-->
                    <div class = "col-md-8">
                        <label for = "username" class = "form-label">Username</label>
                        <input type = "text" class = "form-control" name = "username" value="<?php print $username; ?>"disabled>
                      </div>


                    <!-- Tietoja voidaan muuttaa (paitsi tunnusta) kun kirjoitetaan kenttiin uudet tiedot ja painetaan Edit-nappia, suorittaa funktion joka headin sisällä-->
                    <div class = "col-8" style = "margin-bottom: 10px;">
                      <input  style = "color: white; background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);" type = "button" name="edit" value="Edit" onclick='sendData(this.form);'>
        
                    </div>
                
                    </form>

                    <!--Tähän tulostuu mahdolliset ilmoitukset käyttäjälle -->
                    <p id="result"></p>

                    <br><br>

                    <!-- Napit eri sivuille-->
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="bookings.php">Book a table</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="reservationhistory.php">Latest reservation</a></button>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeaway.php">Order take away</a></button>  
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="orderhistory.php">Order history</a></button><br><br>

                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button><br><br>
                   

</div>

<div class="col-md-2">
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


<?php




?>
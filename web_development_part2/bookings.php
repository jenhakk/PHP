<?php

session_start();

if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="bookings.php";
  header("Location:login.html");
  exit;
 
} 

$initials=parse_ini_file("database_inifile.ini");

$database = $initials["database"];
$dbuser = $initials["dbuser"];
$dbpasswd = $initials["dbpasswd"];
$server = $initials["server"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Check your table bookings">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Booking history</title>

    <!--Tehd  n AJAXilla olio nimelt  varaustiedot, joka sis lt   tekstikenttiin sy tetyt arvot. Olio l hetet  n JSONilla varaustietokantaan.php-tiedostoon, josta ne tallentuvat phpMyAdmin-tietokantaan-->
    <script>
      function send_data(form) {
        var varaustiedot = new Object();
        varaustiedot.pvm = form.pvm.value;
        varaustiedot.klo = form.klo.value;
        varaustiedot.henkilomaara = form.henkilomaara.value;
        varaustiedot.etunimi = form.etunimi.value;
        varaustiedot.sukunimi = form.sukunimi.value;
        varaustiedot.puhelin = form.puhelin.value;
        varaustiedot.email = form.email.value;
        varaustiedot.textbox = form.textbox.value;

        var x = JSON.stringify(varaustiedot);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "bookings.php") {
      var response = this.responseText;
      window.location.assign(response);
      } else {
       document.getElementById("palaute").innerHTML = this.responseText;
       document.getElementById("form").reset();
      }
      }
    };
    xhttp.open("POST", "varaustietokantaan.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tiedot=" + x);
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
            <div class="row" style="min-height: 1000px; background-color: rgb(209, 205, 205);">
               
            <div class="col-md-2">
            </div>     
            <div class = "col-sm-8" style = "padding-top: 20px; padding-bottom: 60px;">
          <article>
            <h1 style = "padding-bottom: 20px;">Welcome to Bistré!</h1>
          
            <p>Duration of your reservation is 2 hours. If there is need for longer reservation, 
            be in touch with the restaurant beforehand either by email <b>reservations@bistre.fi</b> or 
            by calling us to a number <b>+358 10 123 4567</b>.
            <br><br>

            Note that if you have not arrived in 15 minutes since your reservation has started, 
            the restaurant releases the reserved table.
            <br><br>

            If you would like to book a table for <b>more than 8 people</b>, please call us to make a reservation.</p>
          </article>
        
          <h2 style = "font-size: 22px; padding-bottom: 20px; padding-top: 20px;">Book a table online</h2>
          <!--<p><a href="login.html">Login</a> or <a href="registration.html">register</a> to save your reservation for editing!</p> -->
        
          <!--Reservation form-->
             <form class = "row lg-12">
            <!--Datetime-->
            <div class = "col-md-5">
              <label id = "inputDate" class = "form-label">Date</label>
              <input type = "date" class = "form-control" name = "pvm" placeholder = "DD.MM.YYYY" aria-label = "Date" id = "pvm" value=''>
            </div>
            
            <div class = "col-md-4">
              <label id = "inputTime" class = "form-label">Time</label>
              <input type = "time" class = "form-control" name = "klo" placeholder = "HH.MM" aria-label = "Time" id = "klo" value=''>
            </div>

            <!--How many guests-->
            <div class = "col-md-3">
                <label id = "number" class = "form-label">Guests</label>
                <input type = "number" class = "form-control" name = "henkilomaara" aria-label = "number" value = "1" id = "henkilomaara" value=''>
            </div>

            <!--First name-->
            <div class = "col-md-6">
              <label id = "inputFirstName" class = "form-label">First name</label>
              <input type = "text" class = "form-control" name = "etunimi" placeholder = "First Name" aria-label = "First name" id = "etunimi" value=''>
            </div>

            <!--Last Name-->
            <div class = "col-md-6">
                <label id = "inputLastName" class = "form-label">Last name</label>
                <input type = "text" class = "form-control" name = "sukunimi" placeholder = "Last Name" aria-label = "Last name" id = "sukunimi" value=''>
            </div>

            <!--Number-->
            <div class = "col-md-6">
              <label id = "inputNumber" class = "form-label">Phone number</label>
              <input type = "text" class = "form-control" name = "puhelin" placeholder = "E.g. +358 501234567" id = "puh" value=''>
            </div>

            <!--Email Address-->
            <div class = "col-md-6">
                <label id = "inputEmail" class = "form-label">Email</label>
                <input type = "email" class = "form-control" name = "email" placeholder = "E.g. firstname.lastname@email.com" id = "email" value=''>
            </div>

            <!--Message box-->
            <div class = "col-md-12">
                <label for = "exampleFormControlTextarea1" class = "form-label">Anything else?</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name = "textbox" placeholder = "Tell us more about your reservation." rows="3" id = "textbox" value=''></textarea>
            </div>
            <br><br>

            <!--Napin painallus kutsuu metodeja send data ja myfunction. Send data on selitetty sivun alussa. Myfunction asettaa varaushistoriasi-napin n kyviin, kun Send-nappia on painettu ensin-->
            <div class = "col-8" style = "margin-bottom: 10px; padding-top: 10px;">
               <input type = "button"  style = "color: white; background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);" name="send" value='Send' id = "button" onclick="send_data(this.form); myFunction();">              </form>
              
              <p id='palaute'></p>

              <!--L hetet  n lomakkeen tiedot varaustietokantaan.php:lle-->

        
              <script>
               $(document).ready(function(){
               $("#button").click(function(){
               $.post("varaustietokantaan.php",
               {
                 pvm:$("#pvm").val(),
                 klo:$("#klo").val(),
                 henkilomaara:$("#henkilomaara").val(),
                 etunimi:$("#etunimi").val(),
                 sukuimi:$("#sukunimi").val(),
                 puhelin:$("#puhelin").val(),
                 email:$("#email").val(),
                 textbox:$("#textbox").val(),
               },
               function(data, status){
               $("#tulos").html(data);
               });
          });
   });
              </script>
               

<div id="myDIV">
  <button type="button" id="hiddenbutton" style = "display:none; background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="reservationhistory.php">Check your latest reservation on your own page</a></button> <br><br> 

</div>
<script>
function myFunction() {
	var x = document.getElementById("hiddenbutton");
   	if(x.style.display === "none") {
		x.style.display = "block";
	}
}
</script>
                          <!--Alert box-->
          <div class = "col-sm-12" style = "margin-top: 10px; padding: 10px; border: rgb(59, 59, 59) 2.2px solid; 
          border-radius: 5px; background-color: white;">
              <p><b>These restaurant pages are a school project.</b></p>

                    <p>Thus, the restaurant and all information connected to it are made-up.<br><br> 
                      For instance, Bistré's address is pointed at Häme University of Applied Sciences HAMK.<br><br>
                      We still hope you have lots of fun on our website!</p>          </div>
        </div>

<!--<div class = "col-md-8" style = "padding-bottom: 10px; padding-top: 20px;"> -->







                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="userlogged.php">Personal information</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="reservationhistory.php">Latest reservation</a></button>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeaway.php">Order take away</a></button> 
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="orderhistory.php">Order history</a></button> <br><br>

                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button>
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
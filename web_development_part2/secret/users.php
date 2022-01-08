<?php

//ADMININ KÄYTTÄMÄ SIVU, JOSSA VOI KATSOA KÄYTTÄJÄTUNNUKSEN PERUSTEELLA KÄYTTÄJIEN TIETOJA

//haetaan ini-tiedosta tietokantaan tarvittavat tiedot
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
    <meta name="description=" content="Admin's page">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Admin - Users</title>
  

    <!--Funktio joka ottaa selectissä klikatun arvon (tunnuksen), asettaa sen muuttujaan, lähettää sen GET-pyynnöllä select.php-tiedostoon,
    joka etsii tietokannasta tunnuksen avulla käyttäjän tiedot, laittaa ne JSONiin ja lähettää takaisin tälle sivulle, jossa se puretaan muuttujiin ja 
    asetetaan niiden arvot lomakkeelle.-->
   <script> 
   function singleSelectChangeValue() {
        //Getting Value
        var selValue = document.getElementById("selectUser").value;
       
      
        xmlhttp = new XMLHttpRequest();
	      xmlhttp.onreadystatechange = function() {
	       if (this.readyState == 4 && this.status == 200) {
		      //Ensin result-kenttään JSON sellaisenaan
		        var tulos=this.responseText;

            //tulostetaan mahdolliset printtaukset
	          document.getElementById("result").value = tulos;
		
	    //puretaan JSON muuttujiksi ja asetetaan ne lomakkeen arvoiksi jokaisen inputin "id":n perusteella
     person = JSON.parse(tulos);
			
      fname.value = person.fname;
      lname.value = person.lname;
      number.value = person.number;
      email.value = person.email;
      username.value = person.user;
 


	  }
	};

  //lähetetään tunnus (joka on selValue:ssa) php-tiedostolle
	xmlhttp.open("GET", "select.php?tunnus="+selValue, true);
	xmlhttp.send();	
};
          
   
</script> 
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
          xmlhttp.open("POST", "editadmin.php", true);
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
      
      <a href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/index.html"><img src="Ravintolanlogo5.jpeg" class="logo" alt="Bistré's logo and name"></a>

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
          <a class="nav-link" aria-current="page" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/index.html" style="color:black">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/menu.html" style="color:black">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/aboutus.html" style="color:black">About us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/book.html" style="color:black">Book a table</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/contact.html" style="color:black">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://shell.hamk.fi/~jenna20100/Projekti/web-development/userlogged.php" style="color:black">User page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin.html" style="color:black">Admin</a>
          </li>
      </ul>
    </div>
  </nav>
  
</div>
</div> <!--navbar loppuu--></div><!--header loppuu-->
    
            <!--Sisältö alkaa-->
            <div class="row" style="min-height: 600px; background-color: rgb(209, 205, 205);">

                
            <div class="col-md-2">
            </div>     

<div class = "col-md-8" style = "padding-bottom: 10px;">
<h2 style="text-align: center; margin-top: 1em;">Users</h2>
            <br><br>

<p style="text-align: center;"><b>Search user by selecting username. You can also edit the user's information.</b></p><br>



<!--Haetaan tietokannasta kaikki tunnukset select-elementtiin-->
<?php
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


  $sql="select * from $tbusers";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);



//formi alkaa selectille
 print "<form>";
 print "<label for = 'selectUser' class = 'form-label'>Choose user</label>";

 //select, jossa kutsutaan muuttujaa (headin sisällä), kun arvoa vaihdetaan
  print "<select id='selectUser' class='form-control' onchange='singleSelectChangeValue();'>";

  $useroption = 0;

 
  while ($rivi= $tulos ->fetch_assoc()){
    
    //lisätään jokaiselle tunnukselle oma juokseva id
    $useroption++;

     //tietokannasta haetut tunnukset asetetaan $username-muuttujaan, jotka asetetaan eri vaihtoehdoiksi optioniin
    $username = $rivi['tunnus'];

        print '<option id=useroption'.$useroption.' value="'.$username.'">'.$username.'</option>';

      }
    
      //select ja sen formi loppuu
      print "</select>";
      print "</form><br>";
      



$ok=mysqli_close($yhteys);
 
 ?>
                    <!-- Formi johon tulee käyttäjien tiedot -->

                   <form class = "row g-3" id="editform">

                    <!-- First name-->
                    <div class = "col-md-6">
                      <label for = "firstname" class = "form-label">First name</label>
                      <input type = "text" id="fname" class = "form-control" name = "firstname" value="">
                    </div>
        
                    <!--Last Name-->
                    <div class = "col-md-6">
                        <label for = "lastname" class = "form-label">Last name</label>
                        <input type = "text" id="lname" class = "form-control" name = "lastname" value="">
                    </div>
        
                    <!--Phone Number-->
                    <div class = "col-md-6">
                      <label for = "number" class = "form-label">Phone number</label>
                      <input type = "tel" id="number" class = "form-control" name = "number" value="">
                    </div>
        
                    <!--Email Address-->
                    <div class = "col-md-6">
                        <label for = "email" class = "form-label">Email</label>
                        <input type = "email" id="email" class = "form-control" name = "email" value="">
                    </div>

                    <!--Username-->
                    <div class = "col-md-8">
                        <label for = "username" class = "form-label">Username</label>
                        <input type="text" id="username" class="form-control" value="" disabled>
                      </div>

                    <div class = "col-8" style = "margin-bottom: 10px;">
                      <input  style = "color: white; background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);" type = "button" name="edit" value="Edit" onclick='sendData(this.form);'>
        
                    </div>
                
                    </form>
                    <!--Tähän tulostuu mahdolliset ilmoitukset käyttäjälle -->
                    <p id="result"></p>


<br><br><br><br><br><br><br><br><br><br>
<!-- Linkit eri toimintoihin-->
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="admin.html">Home Admin</a></button>
                 
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="feedbackadmin.php">Feedbacks</a></button>
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeawayadmin.php">Take away orders</a></button> <br><br> 
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

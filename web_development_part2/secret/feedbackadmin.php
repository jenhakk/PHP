
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Admin's page">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">
    <meta name = "description" content = "This page is part of a school project to practise PHP/AJAX/JSON. 
    The web page is admin page for feedbacks.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Admin - Feedback</title>

</head>
<body onload = "readlatestfbinterval();">
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
</div> <!--navbar loppuu-->
</div><!--header loppuu-->
    
            <!--Sisältö alkaa-->
            <div class="row" style="min-height: 1000px; background-color: rgb(209, 205, 205);">
               
            <div class="col-md-2">
            </div>     

<div class = "col-md-8" style = "padding-bottom: 10px;">
  <h2 style="text-align: center; margin-top: 1em;">Feedbacks</h2>
  <br><br>

  <p style="text-align: left;"><b>STATUS:</b>&nbsp;&nbsp;&nbsp; 0 - unpublished&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 - published</p>
  <p style = 'border-bottom: 5px dotted #b6ff7b; padding-bottom: 10px;'></p>

  <p id = "readdb"></p>

  <!--Scripti tietokannasta tulevan tiedon päivittämiselle.-->
  <script>
    function readlatestfb() {
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("readdb").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "readfba.php", true);
      xhttp.send();
    }

    // Kun sivu latautuu kutsutaan tämä funktio, joka puolestaan kutsuu readlatestfb() -funktiota 3s päästä.
    function readlatestfbinterval() {
      setInterval(readlatestfb, 3000);
    }
  </script>


<br><br>

<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="admin.html">Home Admin</a></button>
<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="users.php">Users</a></button>       

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

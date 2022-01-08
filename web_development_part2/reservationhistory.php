<?php

 session_start();

if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="reservationhistory.php";
  header("Location:login.html");
  exit;
 
} 

$username = $_SESSION["username"];

$initials=parse_ini_file(".database_inifile.ini");

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
    <meta name="description=" content="Fake restaurant Bistré's menu with fake foods">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Your reservations</title>

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
      <div class="row" style="min-height: 1000px; background-color:  rgb(209, 205, 205);">
        
        <!--Vasen reuna: tyhjä column marginiksi reunustoille-->
        <div class="col-sm-3">
          
        </div>

        <!--Ajanvaraus-->
        <div class = "col-sm-6" style = "padding-top: 20px; padding-bottom: 60px;">
          <article>
            <h1 style = "padding-bottom: 20px;">Your reservations</h1>
          
             <!--Reservation form-->
             <p>Information that you've given to us: </p>
<?php
$username = $_SESSION["username"];
$user = $username;

$yhteys=mysqli_connect("localhost", "trtkp20a3", "trtkp20a3passwd");
$tietokanta=mysqli_select_db($yhteys, "trtkp20a3");
$sql = "SELECT * FROM suvi20119_poytavaraukset1 WHERE tunnus='$user' order by varausID desc limit 1";
$tulos = mysqli_query($yhteys,$sql);

  while($row=mysqli_fetch_assoc($tulos))
  {
  ?>
          <form class = "row g-3">
            <!--Datetime-->
            <div class = "col-md-5">
              <label id = "inputDate" class = "form-label">Date</label>
              <input type = "date" class = "form-control" name = "date" placeholder readonly= "" aria-label = "Date" value="<?php echo $row['pvm'] ?>">
            </div>
            
            <div class = "col-md-4">
              <label id = "inputTime" class = "form-label">Time</label>
              <input type = "time" class = "form-control" name = "time" placeholder readonly= "" aria-label = "Time" value="<?php echo $row['klo'] ?>">

            </div>

            <!--How many guests-->
            <div class = "col-md-3">
                <label id = "number" class = "form-label">Guests</label>
                <input readonly type = "number" class = "form-control" name = "number" aria-label = "number" value="<?php echo $row['henkilomaara'] ?>">
            </div>

            <!--First name-->
            <div class = "col-md-6">
              <label id = "inputFirstName" class = "form-label">First name</label>
              <input type = "text" class = "form-control" name = "firstname" placeholder readonly= "" aria-label = "First name" value="<?php echo $row['etunimi'] ?>">
            </div>

            <!--Last Name-->
            <div class = "col-md-6">
                <label id = "inputLastName" class = "form-label">Last name</label>
                <input type = "text" class = "form-control" name = "lastname" placeholder readonly= "" aria-label = "Last name"value="<?php echo $row['sukunimi'] ?>">
            </div>

            <!--Number-->
            <div class = "col-md-6">
              <label id = "inputNumber" class = "form-label">Phone number</label>
              <input type = "text" class = "form-control" name = "number" placeholder readonly= "" id = "Number"value="<?php echo $row['puhelin'] ?>">
            </div>

            <!--Email Address-->
            <div class = "col-md-6">
                <label id = "inputEmail" class = "form-label">Email</label>
                <input type = "email" class = "form-control" name = "email" placeholder readonly = "" id = "Email"value="<?php echo $row['email'] ?>">

            </div>

            <!--Message box-->
            <div class = "col-md-12">
                <label for = "exampleFormControlTextarea1" class = "form-label">You told us:</label>
                <textarea readonly class="form-control" id="exampleFormControlTextarea1" name = "textarea" placeholder = "" rows="3"><?php echo $row['textbox'] ?></textarea>            
</div>
</form>

<?php
  }
?>
            <br>
            <p>*If you'd like to edit your reservation, please <a>call us</a> to our number: <br>+358 10 123 4567.</p>
            

            <div class = "col-sm-12" style = "margin-top: 30px; padding: 10px; border: rgb(59, 59, 59) 2.2px solid; 
                border-radius: 5px; background-color: white;">
                    <p><b>These restaurant pages are a school project.</b></p>

                    <p>Thus, the restaurant and all information connected to it are made-up.<br><br> 
                      For instance, Bistré's address is pointed at Häme University of Applied Sciences HAMK.<br><br>
                      We still hope you have lots of fun on our website!</p>
                </div>
          </article>

          <br>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="userlogged.php">Personal information</a></button>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="bookings.php">Book a table</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="takeaway.php">Order take away</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="orderhistory.php">Order history</a></button> <br><br> 
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button>
        

        </div></div>


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
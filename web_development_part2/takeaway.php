<?php

//startataan session, mikäli ei ole kirjauduttu, ohjataan kirjautumissivulle ja sen jälkeen takaisin tälle sivulle
session_start();

if (!isset($_SESSION["user_ok"])) {
  $_SESSION["paluuosoite"]="takeaway.php";
  header("Location:login.html");
  exit;
 
} 

//$username = $_SESSION["username"];
//$username = "nakke";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Order take away">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Order take away</title>
  
    



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

                <div class = "col-md-8" style = "padding-bottom: 10px;">
                <h1>Make your order</h1>
                            

                    <!--Menu alkaa-->
                    <div class="row" style="margin-left: 30px; margin-right: 30px; margin-bottom: 40px;">
                    <div class="col-sm">
                      <!--1. sarakkeen 1. osa-->
                      <h3>Pasta</h3>
                      <form action="tilaus.php" method='POST' id="takeaway">
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="1"></th>
                            <td><b>RIGATONI DI POLLO</b><br>Chicken fillet, goat chese, spinach, sun-dried tomatoes, heavy cream and Parmigiano-Reggiano.</td>
                            <td><b>15,00</b></td>
                          </tr>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="2"></th>
                            <td><b>SPAGHETTI ALLA CARBONARA</b><br>Bacon, heavy cream, onion, egg yolk, Parmigiano-Reggiano and black pepper.</td>
                            <td><b>18,00</b></td>
                          </tr>
                            <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="3"></th>
                            <td><b>RISOTTO AL FUNGI PORCINI</b><br>Creamy risotto with parcini mushrooms and Parmigiano-Reggiano.</td>
                            <td><b>18,00</b></td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                      <!--1. sarakkeen 2. osa-->
                      <h3>Salads</h3>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="4"></th>
                            <td><b>CAESAR CARDINI SALLAD</b><br>Herb marinated grilled cornfeed chicken file, romaine salad, classic Caesar dressing, Prmigiano-Reggiano, crispy bacon, croutons and herb marinated tomatoes.</td>
                            <td><b>18,00</b></td>
                          </tr>
                           <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="5"></th>
                            <td><b>INSALATA DI SALMONE</b><br>Grilled salmon fillet served with napolitan salad, candied walnuts, capers, creamy line and herb dressing.</td>
                            <td><b>18,00</b></td>
                          </tr>
                           <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="6"></th>
                            <td><b>INSALATA DI AVOCADO CON GAMBERETTI</b><br>Herb fried scampi served with napolitan salad with avocado, red onion, black olives and honey vinagrette.</td>
                            <td><b>18,00</b></td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                         <!--1. sarakkeen 3. osa-->
                       <h3>Fish</h3>
                       <table class="table">
                             <tbody>
                              <tr>
                                <th scope="row"><input type="radio" name="ruoka" value="7"></th>
                                <td><b>LUCIOPERCA CON AGLIO AL FORNO</b><br>Herb and garlic baked pike-perch served with butter fried capers, tomato and rosted lemon. Served with potato puree and cream of Amalfi lemons.</td>
                                <td><b>25,00</b></td>
                              </tr>
                              <tr>
                                <th scope="row"><input type="radio" name="ruoka" value="8"></th>
                                <td><b>ZUPPA DI PESCE E FRUTTI DI MARE</b><br>Fish and seafood soup with grilled crayfish, served with herbal aioli.</td>
                                <td><b>18,00</b></td>
                              </tr>
                    </tbody>
                    </table>
                    <br>
                    </div>
                    <div class="col-sm">
                     <h3>Starters</h3>
                      <!--2. sarakkeen 1. osa-->
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="9"></th>
                            <td><b>BRUSCHETTA AL POMODORO E PROSCIUTTO</b><br>Grilled sourdough bread, plum tomato, basil, garlic and extra virgin olive oil.</td>
                            <td><b>10,00</b></td>
                          </tr>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="10"></th>
                            <td><b>GAMBERI ALLAGLIO</b><br>Scampi fried in olive oil, garlic, parsley, marinated tomato and chili oil. Served on butter fried bread.</td>
                            <td><b>12,00</b></td>
                          </tr>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="11"></th>
                            <td><b>MOZZARELLA DI BUFFOLA</b><br>Buffalo mozzarella, herb marinated cherry tomatoes, garlic croutons and herb oil.</td>
                            <td><b>10,00</b></td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                      <h3>Dessert</h3>
                      <!--2. sarakkeen 2. osa-->
                      <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="12"></th>
                            <td><b>GELATO NAPOLETANO</b><br>3 scoops ice cream or sorbet, flavours vary by season.</td>
                            <td><b>10,00</b></td>
                          </tr>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="13"></th>
                            <td><b>TORTA CAPRESE</b><br>Rich chocolate and almond cake from Capri. Served with whipped cream and cherry compote.</td>
                            <td><b>10,00</b></td>
                          </tr>
                          <tr>
                            <th scope="row"><input type="radio" name="ruoka" value="14"></th>
                            <td><b>PANNA COTTA</b><br>Chilled  heavy cream pudding served with raspberry coulis and fresh berries.</td>
                            <td><b> 9,00</b></td>
                          </tr>
                          
                        </tbody>
                      </table>
                      <br>
                             <!--2. sarakkeen 3. osa-->
                             <h3>Drinks</h3>
                             <table class="table">
                               <tbody>
                                 <tr>
                                   <th scope="row"><input type="radio" name="juoma" value="1"></th>
                                   <td><b>SODA 0,33L</b></td>
                                   <td style="text-align: right;"><b>3,00</b></td>
                                 </tr>
                                  <tr>
                                   <th scope="row"><input type="radio" name="juoma" value="2"></th>
                                   <td><b>FRUIT JUICE 0,33L</b></td>
                                   <td style="text-align: right;"><b>2,00</b></td>
                                 </tr>
                                  <tr>
                                   <th scope="row"><input type="radio" name="juoma" value="3"></th>
                                   <td><b>BIRRA MORETTI 0,33L</b></td>
                                   <td style="text-align: right;"><b>7,00</b></td>
                                 </tr>
                               </tbody>
                             </table>
                    </div>
                  
                    <h1>Payment method</h1><br>
		                  	<center>
                        Payment when you pick <input type="radio" name="maksutapa" value="1"> <br>
                        Online payment 
                        <br><input type="radio" name="maksutapa" value="2" />
                        <label for="2"><img src="images/pop.jpg" /></label>
                        <input type="radio" name="maksutapa" value="3" />
                        <label for="3"><img src="images/op.jpg" /></label>
                        <input type="radio" name="maksutapa" value="4" />
                        <label for="4"><img src="images/danske.jpg" /></label><br><br>
                        <!--<input type = "text" name = "username" value=""/> -->
                        <input type='submit' style="margin-bottom: 1em;" name='ok' id="laheta" value='Send'><br><br>
						
						<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="userlogged.php">Personal information</a></button>
                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="bookings.php">Book a table</a></button>  
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="reservationhistory.php">Latest reservation</a></button>
					<button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="orderhistory.php">Order history</a></button> <br><br>

                    <button type="button" style = "background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);"><a href="logout.php">Log out</a></button>
					<br><br>			               



 				</center>
                </form>

				<br>

                    
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


<?php




?>
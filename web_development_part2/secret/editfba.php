<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description=" content="Admin's page">
    <meta name = "author" content = "Jonna Hautakangas, Amanda Karjalainen, Jenna Hakkarainen, Suvi Känsäkoski">
    <meta name = "description" content = "This page is part of a school project to practise PHP/AJAX/JSON. 
    The web page is part of an admin page for feedbacks.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/3c1fe89ab3.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/harpake.jpg">
    <title>Admin - Feedback</title>

</head>
<body>
  <!--Container alkaa-->
  <div class="container-fluid" style="position:relative;">
      
    <!--"header alkaa"-->
  
  <div class="row" style="position:sticky; top: 0px; z-index: 1;">
  
    <div class="col-12 text-center" style="background-color: white; max-height: 180px; display:inline; ">
      
      <a href="index.html"><img src="Ravintolanlogo5.jpeg" class="logo" alt="Bistré's logo and name"></a>

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
        
    <div class="col-md-4">
    </div>     

    <div class = "col-md-8" style = "padding-bottom: 10px;">

        <?php
        // Määriteään tunnukset
        $initials = parse_ini_file(".database_inifile.ini");
        $database = $initials["database"];
        $dbuser = $initials["dbuser"];
        $dbpasswd = $initials["dbpasswd"];
        $server = $initials["server"];
        $tbFB = $initials["tbFB"];

        // Jos 'edit' syöte on olemassa, asetetaan muuttujaan muutettavan tietueen id.
        if (isset($_GET['edit'])) {
            $edit = $_GET['edit'];
        }

        // Jos 'edit' syötettä ei ole olemassa, ohjataan toiselle sivulle.
        if (!isset($edit)) {
            header("Location: feedbackadmin.php");
            exit;
        }

        //Tietokantaan yhdistys

        // Määritetään yhteys (palvelin, käyttäjätunnus, salasana, tietokanta)
        $yhteys = mysqli_connect($server, $dbuser, $dbpasswd, $database);

        // Tarkistetaan yhteys
        if (!$yhteys) {
            print "There seems to be an error in connection.";
            exit;
        }

        // Haetaan kaikki rivit, jotka mätsäävät annettuun id:een.
        $sql = "SELECT * FROM $tbFB WHERE id = ?";
        $stmt = mysqli_prepare($yhteys, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $edit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_object($result)) { 
        ?>

        <h2 style="margin-top: 1em;">Edit feedbacks</h2><br>

        <form action = 'updatefba.php' method = 'post'>
            <input type = 'hidden' name = 'id' value = '<?php print $row->id;?>'><br>
            
            <div class = "col-md-6">
                Nickname:<br>
                <input type = 'text' class = "form-control" name = 'nickname' value = '<?php print $row->nickname;?>' style = 'margin-bottom: 10px;'>
            </div>
            
            <div class = "col-md-6">
                Feedback<br>
                <input type = 'text' class = "form-control" name = 'feedback' value = '<?php print $row->feedback;?>' style = 'margin-bottom: 10px;'>
            </div>
            
            <div class = "col-md-6">
            Status (0 or 1)<br>
                <input type = 'number' class = "form-control" name = 'status' value = '<?php print $row->status;?>' style = 'margin-bottom: 10px;'>
            </div>

            <div class = "col-6" style = "margin-bottom: 10px;">
                <input type = 'submit' class = "btn btn-primary active" name = 'update' value = 'Update' style = 'background-color: rgba(59, 59, 59, 0.897); border-color: rgb(59, 59, 59);'>
            </div>
        </form>
        
        <?php       
        }
        ?>
    </div>
    
    <div class="col-md-3">
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

<?php

/*Ohjelmalla käyttäjä voi lisätä koneeltaan oman kuvan kansioon.
1. Ensimmäiseksi asetetaan kohdekansio ja luodaan muuttuja johon tallentuu tiedoston pääte.
2. Tarkistetaan onko kuva oikea/olemassa, jos on jatketaan, jos ei annetaan virheilmoitus
asetetaan muuttujalle uploadOk arvoksi 0
3. Seuraavaksi tarkistetaan tiedosto jo olemassa kohdekansiossa, jos on annetaan virheilmoitus.
4. Tarkistetaan onko kuvan koko pienempi kuin 500kb, jos suurempi annetaan virheilmoitus.
5. Määritellään sallitut tiedostotyypit (jpg, png, jpeg, gif), tarkistetaan onko tiedosto sopiva.
6. Lopuksi tarkistetaan vielä onko muuttuja uploadOk saanut arvon 0, jos on annetaan virheilmoitus. 
Jos ei, yritetään ladata kuva. Mikäli onnistuu käyttäjälle annetaan siitä ilmoitus, jos ei annetaan virheilmoitus.*/


$target_dir = "/home/jenna20100/public_html/Tehtava4/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Tarkistetaan onko kuva oikea kuva
if(isset($_POST["submit"])) {  
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
   
  } else {
    echo "Tiedostoa ei ole valittu. ";
    $uploadOk = 0;
    exit;
    
  } 
}

// Tarkistetaan onko tiedosto olemassa
if (file_exists($target_file)) {
    echo "Tiedosto on jo olemassa. ";
    $uploadOk = 0;
	
  }

// Tarkistetaan onko tiedoston koko alle 500KB
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Kuvasi on liian suuri.";
    $uploadOk = 0;

  }

// Sallitaan vain tietyt päätteet tiedostoissa
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Vain JPG, JPEG, PNG ja GIF -päätteiset tiedostot ovat sallittuja.";
  $uploadOk = 0;

}

// Tarkisteaan onko $uploadOk saanut arvon 0 virheen vuoksi
if ($uploadOk == 0) {
    echo " Pahoittelut, tiedostoasi ei voitu ladata. ";
  // Jos kaikki on kunnossa, yritetään ladata tiedosto
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "Tiedostosi ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " on nyt ladattu.";
    } else {
      echo " Pahoittelut, tiedostosi lataamisessa ilmeni virhe. ";
    }
  }
  ?>
<?php

    $tulos="Tallennus onnistui!";
    $nimi=$_POST['nimi'];
    $postinro=$_POST['postinro'];
    $postitmp=$_POST['postitmp'];

if (!isset($nimi) || !isset($postinro) || !isset($postitmp) || empty($nimi) || empty($postinro) || empty($postitmp)) {
    
  $tulos="Täytä kaikki kentät!";
   print $tulos;

    } else {

print $tulos;
}


?>
<?php
 include './laskin.html';
 ?>
 <h4>
 
 <?php

if (isset($_GET['luku1']) && isset($_GET['luku2']) && is_numeric($_GET['luku1']) && is_numeric($_GET['luku2'])) {
    
    $luku1=$_GET['luku1'];
    $luku2=$_GET['luku2'];
    
   
        
if (isset($_GET['plus'])) {
    
    print "Lukujen $luku1 ja $luku2 summa on: ";
    print $luku1 + $luku2;

} else if (isset($_GET['miinus'])) {
    
    print "Lukujen $luku1 ja $luku2 erotus on: ";
    print $luku1 - $luku2;
    
} else if (isset($_GET['kerto'])) {
    
    print "Lukujen $luku1 ja $luku2 tulo on: ";
    print $luku1 * $luku2;
    
} else if (isset($_GET['jako']) && $luku1 == 0 || $luku2 == 0) {
    
    print "Nollaa ei voi käyttää jakolaskussa!";

} else if (isset($_GET['jako']) && $luku1 !=0 && $luku2 !=0) {
    
    print "Lukujen $luku1 ja $luku2 osamäärä on: ";
    print $luku1 / $luku2;
}
} 
?>
</h4>



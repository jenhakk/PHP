<?php 
include "header.html";
?>

 
<?php 
include "lomake.html";
?>

<?php 
$ok=false;

if (isset($_GET['enimi']) && isset($_GET['snimi']) && !empty($_GET['enimi']) && !empty($_GET['snimi'])) {
    
    $ok=true;
    $enimi=$_GET['enimi'];
    $snimi=$_GET['snimi'];
}

print "Tähän tulostuu etunimesi ja sukunimesi<br><br>";


if ($ok==true) {

print "Etunimi: $enimi<br>";
print "Sukunimi: $snimi<br>";

}
?>

<?php 
include "footer.html"
?>
<?php
    // Haetaan tunnukset tekstitiedostolta ja asetetaan ne muuttujiin
    $initials=parse_ini_file(".database_inifile.ini");
    $database = $initials["database"];
    $dbuser = $initials["dbuser"];
    $dbpasswd = $initials["dbpasswd"];
    $server = $initials["server"];
    $tbFB = $initials["tbFB"];

    // Jos 'delete' syöte on olemassa, asetetaan muuttujaan poistettavan tietueen id.
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
    }

    //Tietokantaan yhdistys

    // Määritetään yhteys (palvelin, käyttäjätunnus, salasana, tietokanta)
    $yhteys = mysqli_connect($server, $dbuser, $dbpasswd, $database);

    // Tarkistetaan yhteys
    if (!$yhteys) {
        print "There seems to be an error in connection.";
        exit;
    }

    // Onko $poistettavaa olemassa, jos on, tehdään poistotoimenpiteitä.
    if (isset($delete)) {
        $sql = "DELETE FROM $tbFB WHERE id = ?";
        $stmt = mysqli_prepare($yhteys, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $delete);
        mysqli_stmt_execute($stmt);
    }

    // Haetaan kaikki rivit ja asetetaan tiedot muuttujiin.
    $tulos = mysqli_query($yhteys, "SELECT * FROM $tbFB ORDER BY id DESC");

    // Loopataan jokainen tietokanna rivi ja laitetaan arvot muuttijiin.
    while ($row = mysqli_fetch_object($tulos)) {
        $id = $row->id;
        $nickname = $row->nickname;
        $email = $row->email;
        $age = $row->age;
        $guest = $row->guest;
        $rating = $row->rating;
        $feedback = $row->feedback;
        $status = $row->status;

        print "<b>ID:&nbsp; $id&nbsp;&nbsp;&nbsp; STATUS:</b>&nbsp; <b style = 'color: #54b307;'>$status</b><br><br>
        <b>NICKNAME:</b>&nbsp; $nickname<br>
        <b>EMAIL:</b>&nbsp; $email<br>
        <b>AGE:</b>&nbsp; $age<br>
        <b>GUESTS:</b>&nbsp; $guest<br>
        <b>RATING:</b>&nbsp; $rating<br>
        <b>FEEDBACK:</b>&nbsp; $feedback<br><br>
        
        <a href = 'readfba.php?delete=".$id."'>DELETE</a> &nbsp;&nbsp; <a href = 'editfba.php?edit=".$id."'>EDIT</a><br>
        <p style = 'border-bottom: 5px dotted #b6ff7b; padding-bottom: 10px;'></p>";
    }

    mysqli_close($yhteys);
?>

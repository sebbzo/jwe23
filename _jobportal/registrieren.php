<?php

error_reporting(E_ALL);

include "setup.php";
include "kopf-frontend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Mysql;



// Formular abgeschickt
if (! empty($_POST)) {

    //Formularfelder validieren
    $validieren = new Validieren();
    
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    $validieren->benutzername_existiert($_POST["benutzername"]);

    if (!$validieren->fehler_aufgetreten()) {

        // PASSWORT HASH ERSTELLEN

        //Ist ein Einweg-Hashing-Algorithmus und kann nicht mehr zurückverfolgt werden
        $pw_hash = password_hash($_POST["passwort"], PASSWORD_DEFAULT);

        //Verbindung zu Datenbank aufbauen
        $db = Mysql::getInstanz();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $sql_passwort = $db->escape($pw_hash);
        
        $db->query("INSERT INTO `benutzer`(`benutzername`, `passwort`) VALUES ('{$sql_benutzername}','{$sql_passwort}')");

        echo "Ein neuer Account wurde erstellt. Bitte melde dich nochmal an.<br>";
        echo '<a href="login.php">Zurück zum Login</a>';

    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginbereich für Arbeitgeber</title>
</head>
<body>

<h1>Neues Konto erstellen</h1>

<?php

// Fehler ausgeben
if(!empty($validieren)) {
    echo $validieren->fehler_html();
    echo "hallo";
}

?>

<form action="registrieren.php" method="post">
    <div>
        <label for="benutzername">Benutzername</label>
        <input type="text" name="benutzername" id="benutzername">
    </div>
    <div>
        <label for="passwort">Passwort</label>
        <input type="password" name="passwort" id="passwort">
    </div>
    <div class="submit-button">
        <button type="submit">Registrieren</button>

    </div>
</form>
    
<?php

include "fuss.php";

?>
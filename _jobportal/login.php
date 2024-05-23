<?php

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

    if (!$validieren->fehler_aufgetreten()) {

        // Verbindung zu Datenbank aufbauen
        $db = Mysql::getInstanz();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $ergebnis = $db->query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
        $benutzer = $ergebnis->fetch_assoc();

        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {

            // Passwort falsch oder Benutzer existiert nicht in DB
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
            
        } else {

            // Alles ok -> Login Session merken
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzer["benutzer"];
            $_SESSION["benutzer_id"] = $benutzer["id"];

            // Umleitung zum Admin-System
            header("Location: index.php");
            exit;
        }
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

<h1>Loginbereich für Arbeitgeber</h1>

<?php

// Fehler ausgeben
if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

?>

<form action="login.php" method="post">
    <div>
        <label for="benutzername">Benutzername</label>
        <input type="text" name="benutzername" id="benutzername">
    </div>
    <div>
        <label for="passwort">Passwort</label>
        <input type="password" name="passwort" id="passwort">
    </div>
    <div class="submit-button">
        <button type="submit">Einloggen</button>

    </div>
</form>

<a href="registrieren.php">Neues Konto erstellen</a>
    
<?php
include "fuss.php";
?>

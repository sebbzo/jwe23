<?php

// Einbindung der erforderlichen Dateien
include "setup.php";
include "kopf-frontend.php";

// Verwendung der Klassen aus dem Namespace WIFI\Jobportal\Fdb
use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Mysql;

// Prüfen, ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    // Instanz der Validierungs-Klasse erstellen
    $validieren = new Validieren();
    
    // Benutzername und Passwort auf Ausfüllung prüfen
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    $validieren->benutzername_existiert($_POST["benutzername"]);

    // Wenn keine Fehler aufgetreten sind
    if (!$validieren->fehler_aufgetreten()) {

        // Passwort hashen (Einweg-Hashing)
        $pw_hash = password_hash($_POST["passwort"], PASSWORD_DEFAULT);

        // Datenbankverbindung aufbauen
        $db = Mysql::getInstanz();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $sql_passwort = $db->escape($pw_hash);
        
        // SQL-Befehl zum Einfügen des Benutzers in die Datenbank
        $db->query("INSERT INTO `benutzer`(`benutzername`, `passwort`) VALUES ('{$sql_benutzername}','{$sql_passwort}')");

        // Erfolgsmeldung ausgeben und Link zum Login anzeigen
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

    <!-- Bootstrap einbinden -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Neues Konto erstellen</h1>

    <?php
    // Fehler ausgeben, falls vorhanden
    if (!empty($validieren)) {
        echo $validieren->fehler_html();
    }
    ?>

    <!-- Registrierungsformular mit Bootstrap-Klassen -->
    <form class="mt-3" action="registrieren.php" method="post">
        <div class="mb-3">
            <label for="benutzername" class="form-label">Benutzername</label>
            <input type="text" name="benutzername" id="benutzername" class="form-control">
        </div>
        <div class="mb-3">
            <label for="passwort" class="form-label">Passwort</label>
            <input type="password" name="passwort" id="passwort" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>

<!-- Einbindung des Fußbereichs -->
<?php
include "fuss.php";
?>

</body>
</html>

<?php

include "setup.php";

include "kopf-frontend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Mysql;

// Überprüfen, ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    // Validierung der Formularfelder initialisieren
    $validieren = new Validieren();
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");

    // Überprüfen, ob Validierungsfehler aufgetreten sind
    if (!$validieren->fehler_aufgetreten()) {

        // Verbindung zur Datenbank herstellen
        $db = Mysql::getInstanz();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $ergebnis = $db->query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
        $benutzer = $ergebnis->fetch_assoc();

        // Überprüfen, ob Benutzer existiert und das Passwort korrekt ist
        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {

            // Fehlermeldung hinzufügen
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
            
        } else {

            // Benutzer erfolgreich authentifiziert -> Login-Session speichern
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzer["benutzer"];
            $_SESSION["benutzer_id"] = $benutzer["id"];

            // Weiterleitung zum Admin-System
            header("Location: index.php");
            exit;
        }
    }
}

?>


<div class="container">
    <h1>Loginbereich für Arbeitgeber</h1>

    <?php
    // Fehlermeldungen ausgeben
    if (!empty($validieren)) {
        echo $validieren->fehler_html();
    }
    ?>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="benutzername">Benutzername</label>
            <input type="text" name="benutzername" id="benutzername" class="form-control">
        </div>
        <div class="form-group">
            <label for="passwort">Passwort</label>
            <input type="password" name="passwort" id="passwort" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Einloggen</button>
    </form>

    <a href="registrieren.php" class="mt-3">Neues Konto erstellen</a>
</div>

<!-- Bootstrap JS einbinden -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php
include "fuss.php";
?>

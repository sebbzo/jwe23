<?php

// Inkludieren der Setup-Datei
include "setup.php";

// Überprüfen, ob der Benutzer eingeloggt ist
ist_eingeloggt();

// Inkludieren der Header-Datei für das Backend
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Model\Row\Job;
use WIFI\Jobportal\Fdb\Model\Kategorien;
use WIFI\Jobportal\Fdb\Mysql;

$erfolg = false;

if (!empty($_POST)) {
    // Validieren der Formulardaten
    $validieren = new Validieren();

    $validieren->ist_ausgefuellt($_POST["titel"], "Jobtitel");
    $validieren->ist_ausgefuellt($_POST["beschreibung"], "Beschreibung");
    $validieren->ist_ausgefuellt($_POST["qualifikation"], "Qualifikation");
    $validieren->ist_ausgefuellt($_POST["dienstort"], "Dienstort");
    $validieren->ist_ausgefuellt($_POST["stunden"], "Stunden");
    $validieren->ist_ausgefuellt($_POST["gehalt"], "Gehalt");
    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategorie");

    if (!$validieren->fehler_aufgetreten()) {
        // Datenbankverbindung
        $db = Mysql::getInstanz();

        // Escapen der Eingaben
        $sql_titel = $db->escape($_POST["titel"]);
        $sql_beschreibung = $db->escape($_POST["beschreibung"]);
        $sql_qualifikation = $db->escape($_POST["qualifikation"]);
        $sql_dienstort = $db->escape($_POST["dienstort"]);
        $sql_stundenaussmass = $db->escape($_POST["stunden"]);
        $sql_gehalt = $db->escape($_POST["gehalt"]);
        $sql_kategorie_id = $db->escape($_POST["kategorie"]);
        $sql_benutzer_id = $db->escape($_SESSION["benutzer_id"]);

        // Einfügen in die Datenbank
        $insert_query = "INSERT INTO `jobs`(`titel`, `beschreibung`, `qualifikation`, `dienstort`, `stundenausmass`, `gehalt`, `kategorie_id`, `benutzer_id`) VALUES ('{$sql_titel}','{$sql_beschreibung}','{$sql_qualifikation}','{$sql_dienstort}','{$sql_stundenaussmass}','{$sql_gehalt}','{$sql_kategorie_id}','{$sql_benutzer_id}')";

        if ($db->query($insert_query)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Einfügen in die Datenbank. Bitte überprüfe nochmal deine Eingaben!";
        }
    }
}

?>

<h1>Job erstellen</h1>

<?php
// Erfolgsmeldung anzeigen
if ($erfolg) {
    echo "<p><strong>Job wurde erstellt</strong><br><a href='jobs_liste.php'>Zurück zur Liste</a></p>";
}

// Fehler anzeigen
if (!empty($validieren)) {
    echo $validieren->fehler_html();
}
?>

<!-- Job-Erstellen-Formular -->
<form action="job_erstellen.php" method="post" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="titel">Jobtitel</label>
        <input type="text" class="form-control" name="titel" id="titel" required>
    </div>

    <div class="form-group">
        <label for="beschreibung">Beschreibung</label>
        <textarea class="form-control" name="beschreibung" id="beschreibung" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <label for="qualifikation">Qualifikation</label>
        <input type="text" class="form-control" name="qualifikation" id="qualifikation" required>
    </div>

    <div class="form-group">
        <label for="dienstort">Dienstort</label>
        <input type="text" class="form-control" name="dienstort" id="dienstort" required>
    </div>

    <div class="form-group">
        <label for="stunden">Stundenaussmaß</label>
        <input type="text" class="form-control" name="stunden" id="stunden" required>
    </div>

    <div class="form-group">
        <label for="gehalt">Gehalt</label>
        <input type="text" class="form-control" name="gehalt" id="gehalt" required>
    </div>

    <div class="form-group">
        <label for="kategorie">Kategorie</label>
        <select class="form-control" name="kategorie" id="kategorie" required>
            <option value="">--Bitte wählen--</option>
            <?php
                // Kategorien aus der Datenbank abrufen und in das Dropdown-Menü einfügen
                $kategorien = new Kategorien();
                $alle_kategorien = $kategorien->alle_kategorien();

                foreach ($alle_kategorien as $kategorie) {
                    echo "<option value='{$kategorie->id}'>{$kategorie->kategorie}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Job speichern</button>
    </div>
</form>

<?php
// Inkludieren der Footer-Datei
include "fuss.php";
?>

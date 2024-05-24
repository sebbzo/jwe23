<?php

include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Model\Row\Job;
use WIFI\Jobportal\Fdb\Model\Kategorien;
use WIFI\Jobportal\Fdb\Mysql;

$erfolg = false;

if (! empty($_POST)) {

    $validieren = new Validieren();

    $validieren->ist_ausgefuellt($_POST["titel"], "Jobtitel");
    $validieren->ist_ausgefuellt($_POST["beschreibung"], "Beschreibung");
    $validieren->ist_ausgefuellt($_POST["qualifikation"], "Qualifikation");
    $validieren->ist_ausgefuellt($_POST["dienstort"], "Dienstort");
    $validieren->ist_ausgefuellt($_POST["stunden"], "Stunden");
    $validieren->ist_ausgefuellt($_POST["gehalt"], "Gehalt");
    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategorie");


    if (!$validieren->fehler_aufgetreten()) {

        $db = Mysql::getInstanz();

        $sql_titel = $db->escape($_POST["titel"]);
        $sql_beschreibung = $db->escape($_POST["beschreibung"]);
        $sql_qualifikation = $db->escape($_POST["qualifikation"]);
        $sql_dienstort = $db->escape($_POST["dienstort"]);
        $sql_stundenaussmass = $db->escape($_POST["stunden"]);
        $sql_gehalt = $db->escape($_POST["gehalt"]);
        $sql_kategorie_id = $db->escape($_POST["kategorie"]);
        $sql_benutzer_id = $db->escape($_SESSION["benutzer_id"]);
        
        // Einfügen in die Datenbank mit passender Benutzer ID

        $insert_query = "INSERT INTO `jobs`(`titel`, `beschreibung`, `qualifikation`, `dienstort`, `stundenausmass`, `gehalt`, `kategorie_id`, `benutzer_id`) VALUES ('{$sql_titel}','{$sql_beschreibung}','{$sql_qualifikation}','{$sql_dienstort}','{$sql_stundenaussmass}','{$sql_gehalt}','{$sql_kategorie_id}','{$sql_benutzer_id}')";

        if ($db->query($insert_query)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Einfügen in die Datenbank. Bitte überprüfe nochmal deine Eingaben! ";
        }
    }
}

?>

<h1>Job erstellen</h1>

<?php

if ($erfolg) {
    echo "<p><strong>Job wurde erstellt</strong><br>
    <a href='jobs_liste.php'>Zurück zur Liste</a></p>";
}

if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

?>

<form action="job_erstellen.php" method="post">
    <div>
        <label for="titel">Jobtitel</label>
        <input type="text" name="titel" id="titel">
    </div>

    <div>
        <label for="beschreibung">Beschreibung</label>
        <textarea name="beschreibung" id="beschreibung" cols="30" rows="10"></textarea>
    </div>

    <div>
        <label for="qualifikation">Qualifikation</label>
        <input type="text" name="qualifikation" id="qualifikation">
    </div>

    <div>
        <label for="dienstort">Dienstort</label>
        <input type="text" name="dienstort" id="dienstort">
    </div>

    <div>
        <label for="stunden">Stundenaussmaß</label>
        <input type="text" name="stunden" id="stunden">
    </div>

    <div>
        <label for="gehalt">Gehalt</label>
        <input type="text" name="gehalt" id="gehalt">
    </div>

    <div>
        <label for="kategorie">Kategorie</label>
        <select name="kategorie" id="kategorie">
            <option value="">--Bitte wählen--</option>
            <?php

                $kategorien = new Kategorien();
                $alle_kategorien = $kategorien->alle_kategorien();

                foreach ($alle_kategorien as $kategorie) {
                    echo "<option value='{$kategorie->id}'>{$kategorie->kategorie}</option>";
                };

            ?>
        </select>
    </div>

    <div class="submit-button">
        <button type="submit">Job speichern</button>
    </div> 
</form>

<?php

include "fuss.php";

?>
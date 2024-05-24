<?php

include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Model\Row\Job;
use WIFI\Jobportal\Fdb\Model\Kategorien;
use WIFI\Jobportal\Fdb\Mysql;

$erfolg = false;

if (!empty($_POST)) {

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

        // Aktuelles Datum herausfinden
        $aktuelles_datum = date("Y-m-d H:i:s");
        
        // Einfügen in die Datenbank mit passender Benutzer ID

        $insert_query = "UPDATE `jobs` SET `titel`='{$sql_titel}',`beschreibung`='{$sql_beschreibung}',`qualifikation`='{$sql_qualifikation}',`dienstort`='{$sql_dienstort}',`stundenausmass`='{$sql_stundenaussmass}',`gehalt`='{$sql_gehalt}',`kategorie_id`='{$sql_kategorie_id}', `aenderungsdatum`='{$aktuelles_datum}' WHERE `id`='{$_GET["id"]}'";

        if ($db->query($insert_query)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Bearbeiten in der Datenbank. Bitte überprüfe nochmal deine Eingaben! ";
        }
    }
}

?>

<div class="container mt-5">
    <h1>Job bearbeiten</h1>

    <?php if ($erfolg): ?>
        <div class="alert alert-success" role="alert">
            <strong>Job wurde bearbeitet</strong><br>
            <a href='jobs_liste.php' class="alert-link">Zurück zur Liste</a>
        </div>
    <?php endif; ?>

    <?php if (!empty($validieren)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $validieren->fehler_html(); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_GET["id"])): 
        //Bearbeiten-Modus - Fehrzeugdaten ermitteln zum Formular vorausfüllen
        $job = new Job($_GET["id"]);
    endif; ?>

    <form action="job_bearbeiten.php<?php if (!empty($job)) echo "?id=" . $job->id; ?>" method="post">
        <div class="mb-3">
            <label for="titel" class="form-label">Jobtitel</label>
            <input type="text" class="form-control" name="titel" id="titel" value="<?php echo !empty($_POST["titel"]) ? htmlspecialchars($_POST["titel"]) : (!empty($job) ? htmlspecialchars($job->titel) : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="beschreibung" class="form-label">Beschreibung</label>
            <textarea class="form-control" name="beschreibung" id="beschreibung" cols="30" rows="10"><?php echo !empty($_POST["beschreibung"]) ? htmlspecialchars($_POST["beschreibung"]) : (!empty($job) ? htmlspecialchars($job->beschreibung) : ''); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="qualifikation" class="form-label">Qualifikation</label>
            <input type="text" class="form-control" name="qualifikation" id="qualifikation" value="<?php echo !empty($_POST["qualifikation"]) ? htmlspecialchars($_POST["qualifikation"]) : (!empty($job) ? htmlspecialchars($job->qualifikation) : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="dienstort" class="form-label">Dienstort</label>
            <input type="text" class="form-control" name="dienstort" id="dienstort" value="<?php echo !empty($_POST["dienstort"]) ? htmlspecialchars($_POST["dienstort"]) : (!empty($job) ? htmlspecialchars($job->dienstort) : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="stunden" class="form-label">Stundenaussmaß</label>
            <input type="text" class="form-control" name="stunden" id="stunden" value="<?php echo !empty($_POST["stunden"]) ? htmlspecialchars($_POST["stunden"]) : (!empty($job) ? htmlspecialchars($job->stundenausmass) : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="gehalt" class="form-label">Gehalt</label>
            <input type="text" class="form-control" name="gehalt" id="gehalt" value="<?php echo !empty($_POST["gehalt"]) ? htmlspecialchars($_POST["gehalt"]) : (!empty($job) ? htmlspecialchars($job->gehalt) : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="kategorie" class="form-label">Kategorie</label>
            <select class="form-select" name="kategorie" id="kategorie">
                <option value="">--Bitte wählen--</option>
                <?php
                $kategorien = new Kategorien();
                $alle_kategorien = $kategorien->alle_kategorien();

                foreach ($alle_kategorien as $kategorie) {
                    echo "<option value='{$kategorie->id}'";
                    if (!empty($_POST["kategorie"]) && ($_POST["kategorie"]) == $kategorie->id) {
                        echo " selected";
                    } else if (!empty($job) && $job->kategorie_id == $kategorie->id) {
                        echo " selected";
                    }
                    echo ">{$kategorie->kategorie}</option>";
                };
                ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Job speichern</button>
        </div>
    </form>
</div>

<?php

include "fuss.php";

?>

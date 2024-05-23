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
        
        // Einfügen in die Datenbank mit passender Benutzer ID

        $insert_query = "UPDATE `jobs` SET `titel`='{$sql_titel}',`beschreibung`='{$sql_beschreibung}',`qualifikation`='{$sql_qualifikation}',`dienstort`='{$sql_dienstort}',`stundenausmass`='{$sql_stundenaussmass}',`gehalt`='{$sql_gehalt}',`kategorie_id`='{$sql_kategorie_id}' WHERE `id`='{$_GET["id"]}'";

        if ($db->query($insert_query)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Bearbeiten in der Datenbank. Bitte überprüfe nochmal deine Eingaben! ";
        }
    }
}

?>

<h1>Job bearbeiten</h1>

<?php

if ($erfolg) {
    echo "<p><strong>Job wurde bearbeitet</strong><br>
    <a href='jobs_liste.php'>Zurück zur Liste</a></p>";
}

if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

if (!empty($_GET["id"])) {
    //Bearbeiten-Modus - Fehrzeugdaten ermitteln zum Formular vorausfüllen
    $job = new Job($_GET["id"]);
}

?>

<form action="job_bearbeiten.php<?php 
    if (!empty($job)) {
     echo "?id=" . $job->id;
    }
    ?>" method="post">
    <div>
        <label for="titel">Jobtitel</label>
        <input type="text" name="titel" id="titel" value="<?php
            if (!empty($_POST["titel"])) {
                echo htmlspecialchars($_POST["titel"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->titel);
            }
        ?>">
    </div>

    <div>
        <label for="beschreibung">Beschreibung</label>
        <textarea name="beschreibung" id="beschreibung" cols="30" rows="10"><?php
            if (!empty($_POST["beschreibung"])) {
                echo htmlspecialchars($_POST["beschreibung"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->beschreibung);
            }
        ?></textarea>
    </div>

    <div>
        <label for="qualifikation">Qualifikation</label>
        <input type="text" name="qualifikation" id="qualifikation" value="<?php
            if (!empty($_POST["qualifikation"])) {
                echo htmlspecialchars($_POST["qualifikation"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->qualifikation);
            }
        ?>">
    </div>

    <div>
        <label for="dienstort">Dienstort</label>
        <input type="text" name="dienstort" id="dienstort" value="<?php
            if (!empty($_POST["dienstort"])) {
                echo htmlspecialchars($_POST["dienstort"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->dienstort);
            }
        ?>">
    </div>

    <div>
        <label for="stunden">Stundenaussmaß</label>
        <input type="text" name="stunden" id="stunden" value="<?php
            if (!empty($_POST["stunden"])) {
                echo htmlspecialchars($_POST["stunden"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->stundenausmass);
            }
        ?>">
    </div>

    <div>
        <label for="gehalt">Gehalt</label>
        <input type="text" name="gehalt" id="gehalt" value="<?php
            if (!empty($_POST["gehalt"])) {
                echo htmlspecialchars($_POST["gehalt"]);
            } 

            // Wenn noch nichts neues eingefügt wurde oder das Feld leer ist, dann soll der wirkliche Jobtitel ausgegeben werden
            
            else if (!empty($job)) {
                echo htmlspecialchars($job->gehalt);
            }
        ?>">
    </div>

    <div>
        <label for="kategorie">Kategorie</label>
        <select name="kategorie" id="kategorie">
            <option value="">--Bitte wählen--</option>
            <?php

                $kategorien = new Kategorien();
                $alle_kategorien = $kategorien->alle_kategorien();

                foreach ($alle_kategorien as $kategorie) {

                    // Kategorie ID ausgeben
                    echo "<option value='{$kategorie->id}'";

                    //Dieser Teil prüft, ob die aktuelle Kategorie mit der aus dem Formular übermittelten Kategorie übereinstimmt. Wenn ja, wird das Attribut "selected" hinzugefügt, um diese Option als vorausgewählt zu markieren.


                    if (!empty($_POST["kategorie"]) && ($_POST["kategorie"]) == $kategorie->id) {
                        echo " selected";
                    } 

                    //  Hier wird überprüft, ob ein bearbeiteter Job vorhanden ist und ob die Kategorie dieses Jobs mit der aktuellen Kategorie übereinstimmt. Wenn ja, wird auch das Attribut "selected" hinzugefügt.
                    
                    else if (!empty($job) && $job->kategorie_id == $kategorie->id) {
                        echo " selected";
                    }

                    echo ">{$kategorie->kategorie}</option>";

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
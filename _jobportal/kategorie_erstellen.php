<?php

// Einbindung der Setup-Datei und Überprüfung, ob der Benutzer eingeloggt ist
include "setup.php";
ist_eingeloggt();
// Einbindung des Backend-Kopfbereichs
include "kopf-backend.php";

// Verwendung der Klassen Validieren und Mysql aus dem Namespace WIFI\Jobportal\Fdb
use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Mysql;

// Initialisierung von Variablen
$erfolg = false;
$fehlermeldung = "";

// Verarbeitung des Formulars nach dem Absenden
if (!empty($_POST)) {

    $validieren = new Validieren();

    // Validierung des Kategorienamens
    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategoriename");

    // Überprüfung, ob Validierungsfehler aufgetreten sind
    if (!$validieren->fehler_aufgetreten()) {

        $db = Mysql::getInstanz();

        // Absichern des Kategorienamens gegen SQL-Injection
        $sql_kategoriename = $db->escape($_POST["kategorie"]);

        // Überprüfen, ob die Kategorie bereits existiert
        $check_query = "SELECT COUNT(*) as anzahl FROM `kategorien` WHERE `kategorie` = '{$sql_kategoriename}'";
        $result = $db->query($check_query);
        $row = $result->fetch_assoc();

        // Wenn die Kategorie bereits existiert, Fehlermeldung setzen
        if ($row['anzahl'] > 0) {
            $fehlermeldung = "Diese Kategorie existiert bereits.";
        } else {
            // Einfügen der neuen Kategorie in die Datenbank
            $insert_query = "INSERT INTO `kategorien`(`id`, `kategorie`) VALUES (NULL, '{$sql_kategoriename}')";

            // Ausführen des Einfügevorgangs und Überprüfen auf Erfolg
            if ($db->query($insert_query)) {
                $erfolg = true;
            } else {
                // Fehlermeldung, falls das Einfügen fehlschlägt
                $fehlermeldung = "Fehler beim Einfügen in die Datenbank. Bitte überprüfe nochmal deine Eingaben!";
            }
        }
    } else {
        // Falls Validierungsfehler aufgetreten sind, Fehlermeldung setzen
        $fehlermeldung = $validieren->fehler_html();
    }
}

?>

<h1>Kategorie erstellen</h1>

<?php

// Ausgabe bei erfolgreicher Kategorieerstellung
if ($erfolg) {
    echo "<p><strong>Kategorie wurde erstellt</strong><br>
    <a href='kategorien_liste.php'>Zurück zur Liste</a></p>";
}

// Ausgabe von Fehlermeldungen, falls vorhanden
if (!empty($fehlermeldung)) {
    echo "<div class='alert alert-danger'>{$fehlermeldung}</div>";
}

?>

<form action="kategorie_erstellen.php" method="post">
    <div class="form-group">
        <label for="kategorie">Kategoriename</label>
        <input type="text" name="kategorie" id="kategorie" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Kategorie speichern</button>
    </div> 
</form>

<?php

// Einbindung des Fußbereichs
include "fuss.php";

?>

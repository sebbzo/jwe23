<?php
include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Mysql;

echo "<h1>Kategorie entfernen</h1>";

$db = Mysql::getInstanz();

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    // Kategorie aus der Datenbank abrufen
    $kategorie = $db->query("SELECT `kategorie` FROM `kategorien` WHERE `id`='$id'")->fetch_assoc();

    if ($kategorie) {
        $kategorie_name = $kategorie["kategorie"];

        if (!empty($_GET["doit"])) {
            // Bestätigungslink wurde geklickt -> Kategorie wirklich aus der DB löschen
            $delete_query = "DELETE FROM `kategorien` WHERE `id`='$id'";
            if ($db->query($delete_query)) {
                echo "<p>Kategorie \"$kategorie_name\" wurde gelöscht.</p><a href='kategorien_liste.php'>Zurück zur Liste</a></p>";
            } else {
                echo "<p>Fehler beim Löschen der Kategorie. Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.</p>";
            }
        } else {
            // Noch nicht bestätigt -> Bestätigung anzeigen
            echo "<p>Sind Sie sicher, dass Sie die Kategorie \"$kategorie_name\" entfernen möchten?</p>";
            echo "<p><a href='kategorien_liste.php'>Nein, abbrechen.</a> <a href='kategorie_entfernen.php?id=$id&amp;doit=1'>Ja, sicher.</a></p>";
        }
    } else {
        echo "<p>Die angeforderte Kategorie wurde nicht gefunden.</p>";
    }
} else {
    echo "<p>Es wurde keine Kategorie-ID angegeben.</p>";
}

include "fuss.php";
?>

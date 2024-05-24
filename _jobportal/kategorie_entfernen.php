<?php
include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Mysql;

echo "<h1 class='my-4'>Kategorie entfernen</h1>";

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
                echo "<div class='alert alert-success'>Kategorie \"$kategorie_name\" wurde gelöscht.</div>";
                echo "<a class='btn btn-primary' href='kategorien_liste.php'>Zurück zur Liste</a>";
            } else {
                echo "<div class='alert alert-danger'>Fehler beim Löschen der Kategorie. Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.</div>";
            }
        } else {
            // Noch nicht bestätigt -> Bestätigung anzeigen
            echo "<div class='alert alert-warning'>Sind Sie sicher, dass Sie die Kategorie \"$kategorie_name\" entfernen möchten?</div>";
            echo "<p><a class='btn btn-secondary' href='kategorien_liste.php'>Nein, abbrechen.</a> ";
            echo "<a class='btn btn-danger' href='kategorie_entfernen.php?id=$id&amp;doit=1'>Ja, sicher.</a></p>";
        }
    } else {
        echo "<div class='alert alert-danger'>Die angeforderte Kategorie wurde nicht gefunden.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Es wurde keine Kategorie-ID angegeben.</div>";
}

include "fuss.php";
?>

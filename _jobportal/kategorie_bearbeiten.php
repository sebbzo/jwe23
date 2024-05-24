<?php

include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Model\Kategorien;
use WIFI\Jobportal\Fdb\Mysql;

$erfolg = false;

if (!empty($_POST)) {
    $validieren = new Validieren();

    // Überprüfen, ob das Feld "Kategorie" ausgefüllt ist
    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategorie");

    if (!$validieren->fehler_aufgetreten()) {
        // Verbindung zur Datenbank herstellen
        $db = Mysql::getInstanz();
        $sql_kategorie = $db->escape($_POST["kategorie"]);

        // SQL-Abfrage zum Aktualisieren der Kategorie
        $update_query = "UPDATE `kategorien` SET `kategorie`='{$sql_kategorie}' WHERE `id`='{$_GET["id"]}'";

        // Ausführen der SQL-Abfrage
        if ($db->query($update_query)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Bearbeiten in der Datenbank. Bitte überprüfe nochmal deine Eingaben!";
        }
    }
}

?>

<h1>Kategorie bearbeiten</h1>

<?php

if ($erfolg) {
    echo "<p class='alert alert-success'><strong>Kategorie wurde bearbeitet</strong><br>
    <a href='kategorien_liste.php' class='btn btn-primary'>Zurück zur Liste</a></p>";
}

if (!empty($validieren)) {
    echo $validieren->fehler_html();
}

// Kategorie aus der Datenbank abrufen
$db = Mysql::getInstanz();
$id = $_GET["id"];
$kategorie = $db->query("SELECT `kategorie` FROM `kategorien` WHERE `id`='$id'")->fetch_assoc()["kategorie"];

?>

<form action="kategorie_bearbeiten.php?id=<?php echo $_GET["id"]; ?>" method="post">
    <div class="form-group">
        <label for="kategorie">Kategorie</label>
        <input type="text" name="kategorie" id="kategorie" class="form-control" value="<?php echo htmlspecialchars($kategorie); ?>">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Kategorie speichern</button>
    </div>
</form>

<?php

include "fuss.php";

?>

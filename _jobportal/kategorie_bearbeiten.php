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

    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategorie");

    if (!$validieren->fehler_aufgetreten()) {
        
        $db = Mysql::getInstanz();
        $sql_kategorie = $db->escape($_POST["kategorie"]);

        // Hier kommt der Code zum Aktualisieren der Kategorie in der Datenbank
        // Ähnlich wie beim Aktualisieren des Jobs in deinem vorherigen Code
        
        $update_query = "UPDATE `kategorien` SET `kategorie`='{$sql_kategorie}' WHERE `id`='{$_GET["id"]}'";

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
    echo "<p><strong>Kategorie wurde bearbeitet</strong><br>
    <a href='kategorien_liste.php'>Zurück zur Liste</a></p>";
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
    <div>
        <label for="kategorie">Kategorie</label>
        <input type="text" name="kategorie" id="kategorie" value="<?php echo htmlspecialchars($kategorie); ?>">
    </div>

    <div class="submit-button">
        <button type="submit">Kategorie speichern</button>
    </div>
</form>

<?php

include "fuss.php";

?>

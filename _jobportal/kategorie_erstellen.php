<?php

include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Validieren;
use WIFI\Jobportal\Fdb\Mysql;

$erfolg = false;
$fehlermeldung = "";

if (!empty($_POST)) {

    $validieren = new Validieren();

    $validieren->ist_ausgefuellt($_POST["kategorie"], "Kategoriename");

    if (!$validieren->fehler_aufgetreten()) {

        $db = Mysql::getInstanz();

        $sql_kategoriename = $db->escape($_POST["kategorie"]);

        // Überprüfen, ob die Kategorie bereits existiert
        $check_query = "SELECT COUNT(*) as anzahl FROM `kategorien` WHERE `kategorie` = '{$sql_kategoriename}'";
        $result = $db->query($check_query);
        $row = $result->fetch_assoc();

        if ($row['anzahl'] > 0) {
            $fehlermeldung = "Diese Kategorie existiert bereits.";
        } else {
            // Einfügen in die Datenbank
            $insert_query = "INSERT INTO `kategorien`(`id`, `kategorie`) VALUES (NULL, '{$sql_kategoriename}')";

            if ($db->query($insert_query)) {
                $erfolg = true;
            } else {
                $fehlermeldung = "Fehler beim Einfügen in die Datenbank. Bitte überprüfe nochmal deine Eingaben!";
            }
        }
    } else {
        $fehlermeldung = $validieren->fehler_html();
    }
}

?>

<h1>Kategorie erstellen</h1>

<?php

if ($erfolg) {
    echo "<p><strong>Kategorie wurde erstellt</strong><br>
    <a href='kategorien_liste.php'>Zurück zur Liste</a></p>";
}

if (!empty($fehlermeldung)) {
    echo "<div>{$fehlermeldung}</div>";
}

?>

<form action="kategorie_erstellen.php" method="post">
    <div>
        <label for="kategorie">Kategoriename</label>
        <input type="text" name="kategorie" id="kategorie">
    </div>

    <div class="submit-button">
        <button type="submit">Kategorie speichern</button>
    </div> 
</form>

<?php

include "fuss.php";

?>

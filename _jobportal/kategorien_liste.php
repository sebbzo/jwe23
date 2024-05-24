<?php

include "setup.php";

ist_eingeloggt();

include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Model\Kategorien;

?>

<h1>Kategorien Liste</h1>

<?php

echo "<table class='table table-striped'>"; // Bootstrap-Klasse für Tabellen-Styling hinzugefügt

echo "<thead class='thead-dark'>"; // Bootstrap-Klasse für dunklen Tabellenkopf hinzugefügt
echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Kategoriename</th>";
    // Wenn der Benutzer "root" ist, dann die Spalten für Bearbeiten und Entfernen anzeigen
    if ($_SESSION["benutzer_id"] === "root") {
        echo "<th>Bearbeiten</th>";
        echo "<th>Entfernen</th>";
    }
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Neues Kategorien Objekt
$kategorien = new Kategorien();

// Alle Kategorien als Objekte in einem Array abspeichern
$alle_kategorien = $kategorien->alle_kategorien();

// Die einzelnen Kategorien ausgeben
foreach ($alle_kategorien as $kategorie) {
    echo "<tr>";
        echo "<td>" . $kategorie->id . "</td>";
        echo "<td>" . $kategorie->kategorie . "</td>";
        // Wenn der Benutzer die id 1 hat, dann die Links zum Bearbeiten und Entfernen anzeigen
        if ($_SESSION["benutzer_id"] == 9) { // Vermutlich sollte hier die Benutzer-ID "root" überprüft werden, nicht 9
            echo "<td>"."<a href='kategorie_bearbeiten.php?id={$kategorie->id}' class='btn btn-primary'>Bearbeiten</a>"."</td>"; // Bootstrap-Klassen für Button-Styling hinzugefügt
            echo "<td>"."<a href='kategorie_entfernen.php?id={$kategorie->id}' class='btn btn-danger'>Entfernen</a>"."</td>"; // Bootstrap-Klassen für Button-Styling hinzugefügt
        }
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

?>

<?php

include "fuss.php";

?>

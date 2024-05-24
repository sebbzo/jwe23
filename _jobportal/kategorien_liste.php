<?php

include "setup.php";

ist_eingeloggt();

include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Model\Kategorien;

?>

<h1>Kategorien Liste</h1>

<?php

echo "<table border='1'>";

echo "<thead>";
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
        if ($_SESSION["benutzer_id"] == 9) {
            echo "<td>"."<a href='kategorie_bearbeiten.php?id={$kategorie->id}'>Bearbeiten</a>"."</td>";
            echo "<td>"."<a href='kategorie_entfernen.php?id={$kategorie->id}'>Entfernen</a>"."</td>";
        }
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

?>

<?php

include "fuss.php";

?>

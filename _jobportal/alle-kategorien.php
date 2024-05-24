<?php
include "kopf-frontend.php";
include "setup.php";

use WIFI\Jobportal\Fdb\Mysql;

$db = Mysql::getInstanz();

echo "<main>
<div class='container'> <!-- Container zur Begrenzung des Inhalts -->
    <div class='inner-wrapper'>
        <h1>Kategorien entdecken</h1>";

// SQL-Abfrage zur Suche nach allen sichtbaren Jobs für alle Kategorien und sortiere sie nach dem Datum aufsteigend
$ergebnis_kategorien = $db->query("SELECT id, kategorie FROM kategorien");

if ($ergebnis_kategorien->num_rows == 0) {
    echo "<p>Es wurden leider keine Kategorien gefunden!</p>";
} else {
    $first = true;
    while ($kategorie = $ergebnis_kategorien->fetch_assoc()) {
        $kategorie_id = $kategorie['id'];
        $kategorie_name = $kategorie['kategorie'];

        echo "<div class='accordion' id='accordion$kategorie_id'>";
        echo "<div class='accordion-item'>";
        echo "<h2 class='accordion-header' id='heading$kategorie_id'>";
        echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$kategorie_id' aria-expanded='" . ($first ? "true" : "false") . "' aria-controls='collapse$kategorie_id'>";
        echo $kategorie_name;
        echo "</button></h2>";
        echo "<div id='collapse$kategorie_id' class='accordion-collapse collapse " . ($first ? "show" : "") . "' aria-labelledby='heading$kategorie_id' data-bs-parent='#accordion$kategorie_id'>";
        echo "<div class='accordion-body'>";

        $ergebnis_jobs = $db->query("SELECT id, titel, dienstort, beschreibung FROM jobs WHERE kategorie_id = '$kategorie_id' AND sichtbar = 'ja' ORDER BY datum ASC");

        if ($ergebnis_jobs->num_rows == 0) {
            echo "<p>Es wurden leider keine passenden Jobs in dieser Kategorie gefunden!</p>";
        } else {
            // Iteriere über die Ergebnismenge der Jobs und gib sie aus
            while ($row = $ergebnis_jobs->fetch_assoc()) {
                $job_id = $row['id'];
                echo "<div class='card m-2'>";
                echo "<div class='card-body'>";
                echo "<h3 class='card-title'>" . htmlspecialchars($row["titel"]) . "</h3>";
                echo "<p class='card-subtitle'>" . htmlspecialchars($row["dienstort"]) . "</p>";
                echo "<p class='card-text'>" . htmlspecialchars($row["beschreibung"]) . "</p>";
                echo "<a href='job_detail.php?id={$job_id}' class='btn btn-primary'>Mehr erfahren</a>"; // Link zum Job-Detail
                echo "</div></div>";
            }
        }
        echo "</div></div></div></div>"; // Ende der accordion-item und accordion
        $first = false;
    }
}

echo "</div></div></main>";

include "fuss.php";
?>

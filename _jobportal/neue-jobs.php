<?php
include "kopf-frontend.php";
include "setup.php";

use WIFI\Jobportal\Fdb\Mysql;

// Holen der Datenbankinstanz
$db = Mysql::getInstanz();

// SQL-Abfrage zur Suche nach den neuesten 12 sichtbaren Jobs und sortiere sie nach dem Datum aufsteigend
$ergebnis_jobs = $db->query("SELECT id, titel, dienstort, beschreibung FROM jobs WHERE sichtbar = 'ja' ORDER BY datum ASC LIMIT 12");

echo "<main>
<div class='container'>
    <h1 class='mt-5 mb-4'>Die neuesten Jobs</h1>"; // Überschrift für die Seite

echo "<div class='row'>";

if ($ergebnis_jobs->num_rows == 0) { // Überprüfen, ob Ergebnisse vorhanden sind
    echo "<div class='col-md-12'>";
    echo "Es wurden leider keine passenden Jobs gefunden!";
    echo "</div>";
} else {
    // Iteriere über die Ergebnismenge der Jobs und gib sie aus
    while ($row = $ergebnis_jobs->fetch_assoc()) {
        $job_id = $row['id'];
        echo "<div class='col-md-4'>";
        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h3 class='card-title'>" . htmlspecialchars($row["titel"]) . "</h3>"; // Titel des Jobs
        echo "<i class='card-subtitle'>" . htmlspecialchars($row["dienstort"]) . "</i>"; // Dienstort des Jobs
        echo "<p class='card-text'>" . htmlspecialchars($row["beschreibung"]) . "</p>"; // Beschreibung des Jobs
        echo "<a href='job_detail.php?id={$job_id}' class='btn btn-primary'>Mehr erfahren</a>"; // Link zum Job-Detail
        echo "</div></div></div>";
    }
}

echo "</div></div></main>";

include "fuss.php";
?>

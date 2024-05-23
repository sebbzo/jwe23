<?php
include "kopf-frontend.php";
include "setup.php";

use WIFI\Jobportal\Fdb\Mysql;

$db = Mysql::getInstanz();

// SQL-Abfrage zur Suche nach den neuesten 12 sichtbaren Jobs und sortiere sie nach dem Datum aufsteigend
$ergebnis_jobs = $db->query("SELECT id, titel, dienstort, beschreibung FROM jobs WHERE sichtbar = 'ja' ORDER BY datum ASC LIMIT 12");

echo "<main>
    

<div class='inner-wrapper'>
    <h1>Die neuesten Jobs</h1>";

echo "<div class='row'>";

if ($ergebnis_jobs->num_rows == 0) {
    echo "<div class='col-md-12'>";
    echo "Es wurden leider keine passenden Jobs gefunden!";
    echo "</div>";
} else {
    // Iteriere über die Ergebnismenge der Jobs und gib sie aus
    while ($row = $ergebnis_jobs->fetch_assoc()) {
        $job_id = $row['id'];
        echo "<div class='col-md-4'>";
        echo "<div class='card m-2'>";
        echo "<div class='card-body'>";
        echo "<h3 class='card-title'>" . htmlspecialchars($row["titel"]) . "</h3>";
        echo "<p class='card-subtitle'>" . htmlspecialchars($row["dienstort"]) . "</p>";
        echo "<p class='card-text'>" . htmlspecialchars($row["beschreibung"]) . "</p>";
        echo "<a href='job_detail.php?id={$job_id}' class='btn btn-primary'>Mehr erfahren</a>"; // Link zum Job-Detail
        echo "</div></div></div>";
    }
}

echo "</div></div></main>";

include "fuss.php";
?>

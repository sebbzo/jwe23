<?php
include "setup.php";

use WIFI\Jobportal\Fdb\Mysql;

// Alle Jobs deaktivieren, die vor 3 Monaten oder länger bearbeitet wurden
function deaktiviere_alte_jobs() {
    
    $db1 = Mysql::getInstanz();

    $result = $db1->query("SELECT `id`, `aenderungsdatum` FROM `jobs`");

    while ($row = $result->fetch_assoc()) {
        $jobId = $row["id"];
        $jobDate = $row["aenderungsdatum"];
        $sql_id = $db1->escape($jobId);

        // Aktuelles Datum vor 3 Monaten berechnen
        $dateThreeMonthsAgo = date('Y-m-d H:i:s', strtotime('-3 months'));
        
        if ($jobDate < $dateThreeMonthsAgo) {
            // Deaktiviere den Job
            $db1->query("UPDATE jobs SET sichtbar='nein' WHERE id = '{$sql_id}'");
        }
    }
}

// Jobs löschen, die vor 1 Jahr oder länger bearbeitet wurden
function loesche_alte_jobs() {
    $db2 = Mysql::getInstanz();

    $result = $db2->query("SELECT `id`, `aenderungsdatum` FROM `jobs`");

    while ($row = $result->fetch_assoc()) {
        $jobId = $row["id"];
        $jobDate = $row["aenderungsdatum"];
        $sql_id = $db2->escape($jobId);

        // Aktuelles Datum vor 1 Jahr berechnen
        $dateOneYearAgo = date('Y-m-d H:i:s', strtotime('-1 year'));
        
        if ($jobDate < $dateOneYearAgo) {
            // Lösche den Job
            $db2->query("DELETE FROM jobs WHERE id = '{$sql_id}'");
        }
    }
}

// Funktion zum Ausführen der Aufgaben
function aktualisiere_und_loesche_jobs() {
    deaktiviere_alte_jobs();
    loesche_alte_jobs();
    echo "Jobs wurden erfolgreich aktualisiert und gelöscht.";
}

// Aktualisierung und Löschung der Jobs aufrufen
aktualisiere_und_loesche_jobs();
?>

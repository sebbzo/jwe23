<?php

namespace WIFI\Jobportal\Fdb\Model;

use WIFI\Jobportal\Fdb\Mysql;
use WIFI\Jobportal\Fdb\Model\Row\Job;

class Jobs {

    // Alle Jobs ausgeben
    public function alle_jobs($benutzer_id): array {

        // Leere Liste erstelle
        $alle_jobs = array();
        
        // SQL Abfrage
        $db = Mysql::getInstanz();

        if ($benutzer_id == 9) {
            // Wenn der Rootbenutzer sich einloggt, werden alle Jobs angezeigt und können auch bearbeitet werden, wobei sich der Benutzer nicht zum root ändert!
            $ergebnis = $db->query("SELECT * FROM jobs ORDER BY datum DESC");
        } else {
            $ergebnis = $db->query("SELECT * FROM jobs WHERE benutzer_id = {$benutzer_id} ORDER BY datum DESC");
        }

        // Liste befüllen
        while ($row = $ergebnis->fetch_assoc()) {
            // Einzelne Jobs in ein Objekt umwandeln und in ein Array geben
            $alle_jobs[] = new Job($row);
        }

        return $alle_jobs;
    }
}
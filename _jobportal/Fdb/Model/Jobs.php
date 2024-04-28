<?php

namespace WIFI\Jobportal\Fdb\Model;

use WIFI\Jobportal\Fdb\Mysql;
use WIFI\Jobportal\Fdb\Model\Row\Fahrzeug;




class Jobs {

    // Alle Fahrzeuge ausgeben
    public function alle_jobs(): array {
        $alle_jobs = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM jobs ORDER BY datum ASC");
        while ($row = $ergebnis->fetch_assoc()) {
            // Jobs in einem Array speichern
            $alle_jobs[] = new Job($row);
        }
        return $alle_jobs;
    }
}
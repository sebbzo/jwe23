<?php

namespace WIFI\Jobportal\Fdb\Model;

use WIFI\Jobportal\Fdb\Mysql;
use WIFI\Jobportal\Fdb\Model\Row\Kategorie;

class Kategorien {
    public function alle_kategorien(): array {
        
        $alle_kategorien = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM kategorien");
        while ($row = $ergebnis->fetch_assoc()) {
            $alle_kategorien[] = new Kategorie($row);
        }
        return $alle_kategorien;
    }
}
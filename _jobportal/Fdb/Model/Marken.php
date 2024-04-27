<?php

namespace WIFI\Jobportal\Fdb\Model;

use WIFI\Jobportal\Fdb\Mysql;
use WIFI\Jobportal\Fdb\Model\Row\Marke;

class Marken {
    public function alle_marken(): array {
        $alle_marken = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM marken ORDER BY marke ASC");
        while ($row = $ergebnis->fetch_assoc()) {
            $alle_marken[] = new Marke($row);
        }
        return $alle_marken;
    }
}
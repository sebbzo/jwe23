<?php

namespace WIFI\Jobportal\Fdb\Model\Row;

class Fahrzeug extends RowAbstract {
    protected string $tabelle = "fahrzeuge";

    public function get_marke(): Marke {
        return new Marke($this->marken_id);
    }
}
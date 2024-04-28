<?php

namespace WIFI\Jobportal\Fdb\Model\Row;

class Job extends RowAbstract {
    protected string $tabelle = "jobs";

    public function get_marke(): Marke {
        return new Marke($this->marken_id);
    }
}
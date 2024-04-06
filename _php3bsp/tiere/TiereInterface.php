<?php

namespace WIFI\JWE;

use WIFI\JWE\Tier\TierAbstract;

// Ein Interface gibt einen "Bauplan" für eine Klasse vor.
// Wenn eine Klasse dieses Interface implementiert, MUSS die
// Klasse alle hier enthaltenen Methoden einbauen.
interface TiereInterface {

    public function add(TierAbstract $tier): void;

}
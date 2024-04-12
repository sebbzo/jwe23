<?php
namespace WIFI\JWE\Tier\Hund;

use WIFI\JWE\Tier\Hund;

//Vererbungen können über mehrere Ebenen gehen
class Dogge extends Hund {

    // Gib_laut Methode vom Hund überschreiben
    public function gib_laut(): string {
        return "Grrrrrrr!";
    }

    // Jede Klasse kann beliebig Methoden (und Eigenschaften) ergänzen
    public function beissen(): string {
        return "Autsch!";
    }

}
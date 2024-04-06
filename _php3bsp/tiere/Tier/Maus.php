<?php

namespace WIFI\JWE\Tier;

// "extends TierAbstract" kopiert alle Eigenschaften und Methoden von der
// übergeordneten "TierAbstract" Klasse (die nicht private sind).
// Somit hat diese Klasse alle Möglichkeiten der Eltern-Klasse.
class Maus extends TierAbstract {

    // Wenn eine Methode definiert wird, die mit selben Namen in der
    // Elternklasse (TierAbstract) bereits existiert, so wird diese überschrieben
    public function get_name(): string {
        // parent::get_name() ruf von der Elternklasse (TierAbstract)
        // die Methode "get_name()" auf und wir können den Rückgabewert
        // in unserer überschriebenen Methode weiterverwenden.
        $name = parent::get_name();
        return $name . " (Maus)";
    }

    public function gib_laut(): string {
        return "Piiiiip!";
    }
}
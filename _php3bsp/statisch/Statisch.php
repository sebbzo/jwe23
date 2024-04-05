<?php

class Statisch {

    // Eine statische Eigenschaft gehört zur einmal existierenden Klasse,
    // nicht zum erstellten Objekt.
    // Dadurch bleibt die Eigenschaft über die gesamte Laufzeit bestehen.
    public static int $id = 0;

    // Diese statische Methode wird auch direkt der Klasse zugeordnet.
    // Wie die Eigenschaft wird sie über Statisch::setze_0() aufgerufen
    // und kann nicht auf $this zugreifen - sie ist nicht Teil des Objekts.
    public static function setze_0() {
        self::$id = 0;
    }

    public function __construct() {
        self::$id++;
    }

    public function mache_etwas() {
        
    }

}
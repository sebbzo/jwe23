<?php
/**
 * Diese Blöcke sind Beispiele für "phpDoc" / "DocBlock"
 * und können mit phpDocumentor (Programm, das alle Methoden und Funktionen visualisiert) 
 * verarbeitet werden.
 */

class Kreis {

    // Konstante, die fix einer Klasse zugeordnet ist
    const PI = 3.1415926535898;

    private float $radius;

    // float bestimmt, dass nur eine Fließkommazahl übergeben werden darf
    public function __construct(float $r) {
        $this->set_radius($r);
    }

    // Der Destruktor wird auf jeden Fall ausgeführt, wenn das Objekt gelöscht wird
    // Dies kann über unset($k) durch den Programmierer passieren,
    // oder automatisch durch PHP wenn das Programm zu Ende durchgelaufen ist.
    public function __destruct() {
        echo "Kreis mit Radius " . $this->radius . " wurde zerstört.<br>";
    }

    // float: Hinweis für andere Programmierer: Die Funktion gibt ein Float zurück
    public function flaeche(): float {
        // r2 * PI
        // self ist ein fixer Platzhalter für den eigenen Klassennamen
        return pow($this->radius, 2) * self::PI;
    }

    public function durchmesser(): float {
        // 2 * r
        return 2 * $this->radius;
    }

    /**
     * Berechnet anhand des gegebenen Radius den Umfang des Kreises.
     * @return float (Gibt eine Beschreibung des Return wertes zurück) Der berechnete Umfang des Kreises.
     */
    public function umfang(): float {
        // d * PI
        return $this->durchmesser() * self::PI;
    }

    /**
     * Setzt einen neuen Radius für den Kreis.
     * Auch wenn der Kreis bereits existiert und mit einem Radius im Konstruktor
     * befüllt wurde, kann man so einen neuen Radius setzen.
     * @param int|float (Beschreibung des Parameters) $r Der neue Radius der gesetzt werden soll.
     * @return void
     * @throws Exception
     */

    // void: Hinweis für Programmierer: Diese Funktion gibt nichts zurück
    public function set_radius(float $r): void {
        if ($r <= 0) {
            // Wirft eine Exception, die als Fehler am Bildschirm aufscheint
            // Gibt Kollegen einen Hinweis, was sie falsch gemacht haben.
            // Wirft einen Error und wird nicht mehr aufgefangen -> deshalb "Uncought Exception"
            // Die Funktion wird sofort abgebrochen wenn zutrifft
            throw new Exception("Radius muss größer 0 sein.");
        }
        $this->radius = $r;
    }
}
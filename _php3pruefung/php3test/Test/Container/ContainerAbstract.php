<?php

namespace WIFI\Php3\Test\Container;

abstract class ContainerAbstract {

    private float $gewicht_der_ladung;
    private array $errors = array();

    public function __construct(float $gewicht) {
        if ($gewicht > $this->nutzlast) {
            throw new \Exception("Das eingegebene Gewicht von " . $gewicht . 
            " Tonnen übersteigt die zulässige Nutzlast von " . $this->nutzlast . " Tonnen.");
        }
        $this->gewicht_der_ladung = $gewicht;
    }

    public function berechne_istgewicht(): float {
        $gesamtgewicht = $this->leergewicht + $this->gewicht_der_ladung;
        return $gesamtgewicht;
    }

    public function berechne_maximales_gesamtgewicht(): float {
        $maximales_gesamtgewicht = $this->leergewicht + $this->nutzlast;
        return $maximales_gesamtgewicht;
    }

    // Methode für die Anzahl der geladenen Container (bei Grossen Containern zählt ein Container als 2)
    public function get_name(): string {
        return $this->name_container;
    }

}

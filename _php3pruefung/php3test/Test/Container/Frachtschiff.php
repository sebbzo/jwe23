<?php

namespace WIFI\Php3\Test\Container;

class Frachtschiff implements \Iterator {

    private array $container_liste = array();
    private float $reisegeschwindigkeit_in_kmh;

    public function __construct(float $geschwindigkeit) {
        $this->reisegeschwindigkeit_in_kmh = $geschwindigkeit;
    }

    // Methode: Reisezeit berechnen

    public function reisezeit(float $strecke_in_kilometer): float {
        $reisezeit_in_stunden = $strecke_in_kilometer / $this->reisegeschwindigkeit_in_kmh;
        return $reisezeit_in_stunden;
    }

    // Methode: Speicherung von Containern in der Liste

    public function add(ContainerAbstract $container): void {
        $this->container_liste[] = $container;
    }

    // Methode: Anzahl geladenes Gesamtgewicht

    public function anzahl_geladenes_gesamtgewicht(): float {
        $ret = 0;
        foreach ($this->container_liste as $container) {
            $ret += $container->berechne_istgewicht();
        }
        return $ret;
    }

    // Methode: Anzahl der Container am Frachtschiff

    public function anzahl_geladener_container(): int {
        $ret = 0;
        foreach ($this->container_liste as $container) {
            if ($container->get_name() == "Grosser Container") {
                $ret += 2;
            } else {
                $ret += 1;
            }
        }
        return $ret;
    }

    // Iterator-Interface

    private int $index = 0;

    public function current(): mixed {
        return $this->container_liste[ $this->index ];
    }

    public function key(): mixed {
        return $this->index;
    }

    public function next(): void {
        ++$this->index;
    }

    public function valid(): bool {
        return isset($this->container_liste[$this->index]);
    }

    public function rewind(): void {
        $this->index = 0;
    }

}
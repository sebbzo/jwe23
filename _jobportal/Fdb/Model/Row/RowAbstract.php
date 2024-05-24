<?php

namespace WIFI\Jobportal\Fdb\Model\Row;
use WIFI\Jobportal\Fdb\Mysql;

abstract class RowAbstract {

    protected string $tabelle;
    private array $daten = [];

    public function __construct(array|int $id_oder_daten) {
        if (is_array($id_oder_daten)) {
            // Fertiges Array wurde übergeben, verwenden wie gegeben.
            $this->daten = $id_oder_daten;
        } else {
            //id wurde übergeben, Daten aus Datenbank auslesen und im Array speichern
            
            $db = Mysql::getInstanz();
            $sql_id = $db->escape($id_oder_daten);
            $ergebnis = $db->query("SELECT * FROM {$this->tabelle} WHERE id = '{$sql_id}'");
            $this->daten = $ergebnis->fetch_assoc();
            
        }
    }

    // Eingenschaft ausgeben, die übergeben wurde
    public function __get(string $eigenschaft): mixed {

        // Exception werfen wenn die Spalte nicht existiert
        if (!array_key_exists($eigenschaft, $this->daten)) {
            throw new \Exception("Die Spalte {$eigenschaft} existiert in der Tabelle {$this->tabelle} nicht.");
        }
        return $this->daten[$eigenschaft];
    }

    public function entfernen(): void {
        $db = Mysql::getInstanz();
        $sql_id = $db->escape($this->id);
        $db->query("DELETE FROM {$this->tabelle} WHERE id = '{$sql_id}'");
    }

}
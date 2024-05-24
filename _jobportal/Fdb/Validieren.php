<?php

// Namespace besteht aus Firma und dann dem Projektnamen
namespace WIFI\Jobportal\Fdb;
use WIFI\Jobportal\Fdb\Mysql;

class Validieren {

    private array $errors = array();

    public function ist_ausgefuellt(string $wert, string $feldname): bool {
        if (empty($wert)) {
            $this->errors[] = $feldname . " war leer.";
            return false;
        }
        return true;
    }
    
    public function fehler_aufgetreten(): bool {
        if (empty($this->errors)) {
            return false;
        }
        return true;
    }

    public function fehler_html(): string {

        // Ausnahme: Ohne Fehler leeren string zurückgeben
        if (!$this->fehler_aufgetreten()) {
            return "";
        }

        // Eigentliche Fehlermeldungen zusammenbauen
        $ret = "<ul>";
        foreach ($this->errors as $error) {
            $ret .= "<li>" . $error . "</li>";
        }
        $ret .= "</ul>";
        return $ret;
    }

    public function fehler_hinzu(string $fehler):void {
        $this->errors[] = $fehler;
    }

    public function benutzername_existiert(string $benutzername): bool {

        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM benutzer");

       

        while ($row = $ergebnis->fetch_assoc()) {

            if ($row["benutzername"] == $benutzername) {
                $this->errors[] = "Dieser Benutzername existiert bereits!"; 
                return true;
            }

        }
        return false;

    }
}
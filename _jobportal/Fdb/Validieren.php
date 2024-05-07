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

    /*public function ist_kennzeichen(string $wert, string $feldname): bool {
        // nach irgendeinem Zeichen im Kennwort suchen, das NICHT A-Z, 0-9, oder Bindestrich ist.
        if (preg_match("/[^A-Z0-9\-]/i", $wert)) {
            $this->errors[] = "Im " . $feldname . " sind nur Buchstaben, Zahlen und Minus erlaubt.";
            return false;
        }
        // auf korrekte Länge prüfen
        if (strlen($wert) > 8 || strlen($wert) < 3) {
            $this->errors[] = "Die Länge von " . $feldname . " ist falsch.";
            return false;
        }
        return true;
    }

    public function ist_baujahr(string $wert, string $feldname): bool {
        // Auf Zahlen prüfen
        if (!is_numeric($wert)) {
            $this->errors[] = "Im " . $feldname . " sind nur Zahlen erlaubt.";
            return false;
        }
        // Datum darf nicht in der Zukunft liegen
        if ($wert > date("Y") || $wert <= 1890) {
            $this->errors[] = $feldname . " muss größer als 1890 und darf nicht in der Zukunft liegen.";
            return false;
        }
        return true;
    }*/

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
<?php

namespace WIFI\Jobportal\Fdb;
use WIFI\Jobportal\Fdb\Mysql;

class Validieren {

    private array $errors = array(); // Array zur Speicherung von Validierungsfehlern

    // Methode zur Überprüfung, ob ein Wert ausgefüllt ist
    public function ist_ausgefuellt(string $wert, string $feldname): bool {
        if (empty($wert)) { // Wenn der Wert leer ist
            $this->errors[] = $feldname . " war leer."; // Fehlermeldung hinzufügen
            return false;
        }
        return true;
    }
    
    // Methode zur Überprüfung, ob Fehler aufgetreten sind
    public function fehler_aufgetreten(): bool {
        if (empty($this->errors)) { // Wenn keine Fehler vorhanden sind
            return false;
        }
        return true;
    }

    // Methode zur Rückgabe der Fehlermeldungen im HTML-Format
    public function fehler_html(): string {

        // Ausnahme: Wenn keine Fehler aufgetreten sind, leeren String zurückgeben
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

    // Methode zum Hinzufügen eines Fehlers zur Fehlerliste
    public function fehler_hinzu(string $fehler):void {
        $this->errors[] = $fehler;
    }

    // Methode zur Überprüfung, ob ein Benutzername bereits existiert
    public function benutzername_existiert(string $benutzername): bool {

        $db = Mysql::getInstanz(); // Instanz der Datenbankverbindung erhalten
        $ergebnis = $db->query("SELECT * FROM benutzer");

        // Durch alle Benutzernamen iterieren
        while ($row = $ergebnis->fetch_assoc()) {

            if ($row["benutzername"] == $benutzername) { // Wenn der Benutzername bereits existiert
                $this->errors[] = "Dieser Benutzername existiert bereits!"; // Fehlermeldung hinzufügen
                return true;
            }

        }
        return false; // Benutzername existiert nicht
    }
}

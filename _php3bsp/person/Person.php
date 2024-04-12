<?php

//Klasse defnieren, die später als Objekt verwendet werden kann
class Person {

    // Eigenschaft (engl. property) festlegen:
    // Platzhalter für spätere Werte (wie Variable)
    // private Eigenschaften (oder Methoden) können nur innerhalb der Klasse angesprochen werden
    private $vorname;

    // Konstruktur: wird automatisch aufgerufen, sobald das Objekt erzeugt wird
    // z.B.: new Person();
    public function __construct($name) {
        //$this steht für die Klasse Person und greift auf die Variable vorname zu
        $this->set_vorname($name);
    }
    
    // Öffentliche Methode (public), die von außen angesprochen werden kann
    public function vorstellen() {
        return "Hallo, ich bin " . $this->vorname;
    }

    // Methode zum holen des privaten Vornamens
    // Ein sogenannter "getter"
    public function get_vorname() {
        return $this->vorname;
    }

    // Methode zum Ändern des privaten Vornamens
    // Ein sogenannter "setter"
    public function set_vorname($neuer_name) {
        // Durch diese Methode haben wir die Möglichkeit
        // Überprüfungen vor dem Setzen des neuen Namens einzufügen
        if ($this->vorname == $neuer_name) {
            echo "<strong>So heiße ich bereits!</strong>";
        } else {
            $this->vorname = $neuer_name;
        }
    }
}
<?php
// Klassendefinition einbinden
include "Person.php";

// Objekt erzeugen aus der Klasse "Person"
// Instanzieren / Instanz erstellen
$ich = new Person("Sebastian");
//Methode vorstellen aufrufen von Person
echo $ich->vorstellen();
echo "<br>";

//$ich->vorname = "Peter";
//funktioniert nicht, weil auf private!

echo $ich->set_vorname("Sebastian");
echo "<br>";

//Deshalb eine eigene Funktion erstellen
echo $ich->get_vorname();
echo "<br>";

// Weiteres Objekt erstellen
$sie = new Person("Sabrina");
echo $sie->vorstellen();
echo "<br>";
<?php

include "Kreis.php";

$k = new Kreis(4);

echo "Fläche: " . $k->flaeche();
echo "<br>";

echo "Durchmesser: " . $k->durchmesser();
echo "<br>";

echo "Umfang: " . $k->umfang();
echo "<br>";

$k->set_radius(5);
echo "Durchmesser NEU: " . $k->durchmesser();
echo "<br>";

$benutzer_eingabe = -2;

// Wird in einem try-Block eine Exception geworfen
// hat man mit "catch" die Möglichkeit, darauf zu reagieren.
try {
    $k -> set_radius($benutzer_eingabe);
    echo "Durchmesser zum Schluss: " . $k->durchmesser();
    echo "<br>";
} catch (Exception $ex) {
    // Fängt alle Exception-Objekte ab, die im try-Block
    // geworfen wurden: throw new Exception("...");
    //Wir fangen die Exception und geben die Fehlermeldung aus 
    //(getMessage ist eine vordefinierte Funktion von php)
    echo "Da war was falsch: " . $ex->getMessage();
    echo "<br>";
} finally {
    // Dieser Code wird in jedem Fall ausgeführt.
    echo "Das wars wohl.<br>";
}

unset($k);

echo "Letzte Ausgabe<br>";
<?php
include "setup.php";
ist_eingeloggt();

use WIFI\Jobportal\Fdb\Model\Row\Fahrzeug;

echo "<h1>Fahrzeug entfernen</h1>";

$fahrzeug = new Fahrzeug($_GET["id"]);


if(!empty($_GET["doit"])) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    $fahrzeug->entfernen();
    echo "<p>Zutat wurde gelöscht.</br><a href='fahrzeuge_liste.php'><br>Zurück zur Liste</a></p>";

} else {

    echo "<p>Sind Sie sicher, dass Sie das Fahrzeug entfernen möchten?</p>";
    echo "<strong>Kennzeichen:</strong> " . $fahrzeug->kennzeichen . "<br>";
    echo "<strong>Marke:</strong> " . $fahrzeug->get_marke()->marke . "<br>";
    echo "<strong>Farbe:</strong> " . $fahrzeug->farbe . "<br>";
    echo "<strong>Baujahr:</strong> " . $fahrzeug->baujahr . "<br>";

    echo "<p>" . "<a href='fahrzeuge_liste.php'>Nein, abbrechen.</a>
    <a href='fahrzeuge_entfernen.php?id={$fahrzeug->id}&amp;doit=1'>Ja, sicher.</a>" . "</p>";
}


include "fuss.php";
?>
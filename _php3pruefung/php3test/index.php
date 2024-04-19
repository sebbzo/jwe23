<!DOCTYPE html>
<html>
    <head>
        <title>PHP 3 Praxisprüfung</title>
        <meta charset='utf-8' />
    </head>
    <body>
        <h2>Container testen</h2>

        <?php

        // Autoloader
        spl_autoload_register(
          function (string $klasse) {
              // Projekt-spezifisches namespace prefix
              $prefix = "WIFI\\Php3\\";

              // Basisverzeichnis für das Projekt
              $basis = __DIR__ . "/";

              // Wenn die Klasse das Prefix nicht verwendet, abbrechen
              $laenge = strlen($prefix);
              if (substr($klasse, 0, $laenge) !== $prefix) {
                  return;
              }

              // Klasse ohne Prefix
              $klasse_ohne_prefix = substr($klasse, $laenge);

              // Dateipfad erstellen
              $datei = $basis . $klasse_ohne_prefix . ".php";
              $datei = str_replace("\\", "/", $datei);

              // Wenn die Datei existiert, einbinden
              if (file_exists($datei)) {
                  include $datei;
              }
          }
        );

        // Ausgabe
        // Aufgabe 1
        echo "<h2>Aufgabe 1</h2>";

        use WIFI\Php3\Test\Container\GrosserContainer;
        use WIFI\Php3\Test\Container\KleinerContainer;
        use WIFI\Php3\Test\Container\Frachtschiff;

        try {
          $container_1 = new KleinerContainer(200);
          echo "Container wurde erstellt!";
        } catch (Exception $ex) {
            echo "Falsche Eingabe: " . $ex->getMessage();
            echo "<br><br>";
        }

        $container_1 = new KleinerContainer(20);
        $container_2 = new KleinerContainer(10);
        $container_3 = new GrosserContainer(10);

        echo "Ist-Gewicht von Container 1:<br>";
        echo $container_1->berechne_istgewicht() . " Tonnen";
        echo "<br><br>";
        echo "Maximales Gewicht von Container 1:<br>";
        echo $container_1->berechne_maximales_gesamtgewicht() . " Tonnen";
        echo "<br>";

        // Aufgabe 2
        echo "<h2>Aufgabe 2</h2>";

        $frachtschiff_1 = new Frachtschiff(80);
        echo "Die Reisezeit von Frachtschiff 1:<br>";
        echo $frachtschiff_1->reisezeit(500) . " Stunden";
        echo "<br><br>";

        $frachtschiff_1->add($container_1);
        $frachtschiff_1->add($container_2);
        $frachtschiff_1->add($container_3);
        
        // Iterator
        echo "Das Ist-Gewicht der einzelnen Container im Frachtschiff 1 (Iterator):<br>";
        foreach ($frachtschiff_1 as $container) {
            echo $container->berechne_istgewicht() . " Tonnen";
            echo "<br>";
        }

        echo "<br>";
        echo "Das geladene Gesamtgewicht von Frachtschiff 1: <br>";
        echo $frachtschiff_1->anzahl_geladenes_gesamtgewicht() . " Tonnen";

        echo "<br><br>";
        echo "Die Anzahl der Container am Frachtschiff 1: <br>";
        echo $frachtschiff_1->anzahl_geladener_container() . " Container";

        // Aufgabe 3
        echo "<h2>Aufgabe 3</h2>";

        $warengewicht = 12.55;
        // Irgendeinen Container mit $warengewicht erstellen
        // und Ist-Gewicht, sowie maximales Gesamtgewicht ausgeben
        $container_z = new KleinerContainer($warengewicht);

        echo "Das Ist-Gewicht von Container Z:<br>";
        echo $container_z->berechne_istgewicht();
        echo "<br><br>";

        echo "Das Maximale Gesamtgewicht von Container Z:<br>";
        echo $container_z->berechne_maximales_gesamtgewicht();

        ?>


        <h2>Frachtschiff testen</h2>
        <?php
        if (!empty($_POST)) {
            // - Frachtschiff erstellen
            $frachtschiff_z = new Frachtschiff($_POST["geschwindigkeit"]);
            // - Gegebene Anzahl an Container hinzufügen (for-Schleife)
            for ($i = 1; $i <= $_POST["anzahl_container"]; $i++) {
              // Container dem Schiff hinzufügen
              $frachtschiff_z->add(new KleinerContainer($_POST["gewicht_container"]));
            }
            // - Reisezeit, Anzahl Container, geladenes Gewicht ausgeben
            echo "Reisezeit von Frachtschiff Z:<br>";
            echo $frachtschiff_z->reisezeit($_POST["strecke"]) . " Stunden";
            echo "<br><br>";
            echo "Anzahl an geladenen Containern am Frachtschiff Z:<br>";
            echo $frachtschiff_z->anzahl_geladener_container() . " Container";
            echo "<br><br>";
            echo "Geladenes Gesamtgewicht am Frachtschiff Z:<br>";
            echo $frachtschiff_z->anzahl_geladenes_gesamtgewicht() . " Tonnen";
            echo "<br><br>";
        }

        ?>
        <form action='index.php' method='post'>
            <div>
                <label for='geschwindigkeit'>Geschwindigkeit in km/h:</label>
                <input type='number' name='geschwindigkeit' id='geschwindigkeit' min='0.0' max='100.0' step='0.1' value='<?php
                  if (!empty($_POST["geschwindigkeit"])) {
                    echo $_POST["geschwindigkeit"];
                  } else {
                    echo 23;
                  } ?>' />
            </div>
            <div>
                <label for='strecke'>Strecke in km:</label>
                <input type='number' name='strecke' id='strecke' min='0' max='40000' step='1' value='<?php
                  if (!empty($_POST["strecke"])) {
                    echo $_POST["strecke"];
                  } else {
                    echo 4669;
                  } ?>' />
            </div>
            <div>
                <label for='anzahl_container'>Anzahl Container:</label>
                <input type='number' name='anzahl_container' id='anzahl_container' min='0' max='10000' step='1' value='<?php
                  if (!empty($_POST["anzahl_container"])) {
                    echo $_POST["anzahl_container"];
                  } else {
                    echo 8400;
                  } ?>' />
            </div>
            <div>
                <label for='gewicht_container'>Warengewicht je Container:</label>
                <input type='number' name='gewicht_container' id='gewicht_container' min='0.0' max='100.0' step='0.01' value='<?php
                  if (!empty($_POST["gewicht_container"])) {
                    echo $_POST["gewicht_container"];
                  } else {
                    echo 8.64;
                  } ?>' />
            </div>
            <div>
                <button type='submit'>Berechnen</button>
            </div>
        </form>
    </body>
</html>

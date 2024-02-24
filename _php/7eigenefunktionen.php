<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eigene Funktionen</title>
</head>
<body>
    <h1>Eigene Funktionen</h1>

    <?php

        //Funktion zum Umrechnen von Grac Celsius in Grad Fahrenheit
        //Formel: F = C * 1.8 + 32

        $grad = 15;
        echo $grad * 1.8 + 32;

        function celsius_in_fahrenheit($celsius) {
            $fahrenheit = $celsius * 1.8 + 32;
            return $fahrenheit;
        }

        echo celsius_in_fahrenheit(15);
        echo "<br/>";

        //Datum neu formatieren

        //Variante mit date
        $datum_mysql = "2024-02-24";

        //Ziel: 24.02.2024
        function de_datum($date) {
            $date = date_create($date);
            $new_date = date_format($date, "d.m.Y");
            return $new_date;
        }

        echo de_datum($datum_mysql);
        echo "<br/>";

        //Variante mit Substring
        function de_datum_2($date) {
            $tag = substr($date, 8, 2);
            $monat = substr($date, 5, 2);
            $jahr = substr($date, 0, 4);
            return $tag . "." . $monat . "." . $jahr;
        }

        echo de_datum_2($datum_mysql);
        echo "<br/>";

        //Weitere Variante
        function de_datum_3($date) {
            $teile = explode('-', $date);
            return $teile[2] . "." . $teile[1] . "." . $teile[0];
        }

        echo de_datum_3($datum_mysql);
        echo "<br/>";

        //Text nach 10 Zeichen abschneiden und "..." anhängen

        $text = "Lorem ipsum dolor";
        echo "<br/>";

        function text_shorten($text, $laenge = 10) {
            //$laenge = 10;
            if (strlen($text)> $laenge) {
                return substr($text, 0, $laenge) . "...";
            } else {
                return $text;
            }
        }

        echo text_shorten($text);
    
    ?>
</body>
</html>
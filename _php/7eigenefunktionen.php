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

        //Datum neu formatieren
        $datum_mysql = "2024-02-24";
        $datum_mysql = date_create($datum_mysql);

        //Ziel: 24.02.2024
        function de_datum($date) {
            $new_date = date_format($date, "d.m.Y");
            return $new_date;
        }

        echo "<br/>";
        echo de_datum($datum_mysql);

    ?>
</body>
</html>
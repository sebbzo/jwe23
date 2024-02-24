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

    ?>
</body>
</html>
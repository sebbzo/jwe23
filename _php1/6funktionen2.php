<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funktionen für Arrays</title>
</head>
<body>
    <?php
        $namen = array("Peter", "Franziska", "Mario", "Katharina", "Evelyn", "Carina", "Peter", "Florian");

        //Elemente (Werte) in einem Array zählen
        echo count($namen);
        echo "<br/>";

        //Zufälligen Namen ausgeben
        $index = array_rand($namen);
        echo $index;
        echo "<br/>";
        echo $namen[$index];
        echo "<br/>";
        echo count($namen);
        echo "<br/>";

        //Doppelten Namen aus der Liste entfernen
        $eindeutig = array_unique(
            $namen
        );
        print_r($eindeutig);
        echo "<br/>";
        echo count($eindeutig);

        //Prüfen ob ein Wert im Array existiert
        $gesuchterName = "Peter";
        echo "<br/>";
        if (in_array($gesuchterName, $namen)) {
            echo "$gesuchterName ist enthalten";
        } else {
            echo "$gesuchterName ist nicht enthalten";
        }

        //Aufsteigend nach Namen sortieren
        asort($eindeutig);
        echo "<br/>";
        print_r($eindeutig);
        echo "<br/>";

        //Wert im Nachhinein hinzufügen
        $eindeutig[] = "Herbert";
        array_push($eindeutig, "Julia", "Fritz");
        echo "<pre>";
        print_r($eindeutig);
        echo "</pre>";

        //Sortieren und Indizies neu zuweisen
        sort($eindeutig);
        echo "<pre>";
        print_r($eindeutig);
        echo "</pre>";

    ?>
</body>
</html>
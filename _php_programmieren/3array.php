<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php 
    //PHP kann überall stehen!
    echo "Array in PHP"; $cssClass = "red";?></title>
</head>
<body class="<?php echo $cssClass; ?>">
    <h1>Array in PHP</h1>
    <?php echo "<h1>Array in PHP</h1>"; ?>
    <?php
        //Numerisches Array
        $namen = array("Katharina", "Jonathan", "Julia", "Peter");
        //Katharina und Julia
        echo $namen[0] . " und " . $namen[2];
        echo "<br/>";

        //Wert im Nachhinein an das Array anhängen
        $namen[] = "Mario";

        //Index als Variable
        $index = 3;
        echo $namen[$index];

        echo "<br/>";

        print_r($namen);

        //Assoziatives Array definieren (Index ist ein Text)
        $person = array(
            "name" => "Markus",
            "alter" => 63,
            "ort" => "Salzburg"
        );

        echo "<pre>";
        print_r($person);
        echo "</pre>";

        //Ausgabe: "Markus (63) aus Salzburg"

        echo $person["name"] . " (" . $person["alter"] . ")" . " aus " . $person["ort"];

        // Ausgabe mit geschwungenen Klammern

        echo "</pre>";
        echo "{$person["name"]} ({$person["alter"]}) aus {$person["ort"]}";

        //Im Nachhinein einen Wert dem Array anfügen
        $person["guthaben"] = 100;

        echo "<pre>";
        print_r($person);
        echo "</pre>";

        $personen = array(
            array(
                "name" => "Herbert",
                "alter" => 33,
                "ort" => "Linz",
                "guthaben" => 0
            ),
            array(
                "name" => "Sarah",
                "alter" => 27
            ),
            $person
        );

        echo "<pre>";
        print_r($person);
        echo "</pre>";

        echo $personen[0]["ort"];

        echo "<br/>";

        //Ich bin Herbert bin 27 und habe ein Guthaben von 100.

        echo "Ich bin {$personen[0]["name"]} bin {$personen[0]["alter"]} und habe ein Guthaben von {$personen[0]["guthaben"]}.";
    ?>

</body>
</html>
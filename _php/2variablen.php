<!DOCTYPE html>
<html lang="en">
<head>
   <title>Variablen mit PHP</title>
</head>
<body>
    <h1>Variablen mit PHP</h1>
    <?php 
    // Ganzzahl (Integer) definieren
    $alter = 23;
    echo "Ich bin $alter Jahre alt!";

    echo "<br/>";

    //Kommazahl (Float) definieren und ausgeben
    $kontostand = 9.81;
    echo "Ich habe $kontostand EUR auf meinem Konto.";

    echo "<br/>";

    //Text (string) einer Variable zuweisen und ausgeben
    $name = "Peter";

    //Ich heiße Peter
    echo "Ich heiße $name";
    echo "<br/>";
    echo 'Ich heiße  ' .$name ;

    // Ich habe Peters Stift
    echo "<br/>";
    echo "Ich habe $name" . "s" . " Stift.";
    echo "<br/>";

    //Datentyp: Boolean (kurz: bool)
    $wahr = true;
    echo ">" .$wahr . "<";
    echo "<br/>";

    $falsch = false;
    echo ">" .$falsch . "<";
    echo "<br/>";

    //null: "nichts" oder "undefiniert"
    $nichts = null;
    echo ">" .$nichts . "<";
    echo "<br/>";

    //Eine Konstante definieren und verwenden
    //Konstanten können zur Laufzeit des Skriptes nicht verändert werden
    //1) erhöht die Lesbarkeit des Codes, weil sofort klar ist, dass sich dieser Wert nicht mehr ändert
    //2) Schützt vor unbeabsichtigter Änderung von Werten
    //3) Kann zentral verwalten werden
    //4) Schützt vor magischen Zahlen oder Zeichenketten, die man schlecht versteht
    define("datenbank", "php23");
    echo datenbank;
    echo "<br/>";

    //Neuere Schreibweise
    const datenbank2 = "php24";
    echo datenbank2;
    echo "<br/>";
    ?>
</body>
</html>
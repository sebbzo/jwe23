<!DOCTYPE html>
<html lang="en">
<head>
    <title>Funktionen für Strings</title>
</head>
<body>
    <h1>Funktionen für Strings</h1>
    <?php
    //String in Kleinbuchstaben umwandeln
    $text = "   Herzlich Willkommen   ";

    echo "<pre>";
    echo mb_strtolower($text);
    echo "</pre>";

    echo "<br/>";

    //Leerzeichen vor/nach einem Text entfernen (Nur davor und nicht im Text)
    echo "<pre>";
    echo trim($text, "n e"); //Das Leerzeichen und das n wird entfernt
    echo "</pre>";

    ?>
</body>
</html>
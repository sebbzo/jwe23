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
    echo strtolower($text);
    echo "</pre>";

    echo "<br/>";

    //Leerzeichen vor/nach einem Text entfernen (Nur davor und nicht im Text)
    echo "<pre>";
    echo trim($text, "n e"); //Das Leerzeichen und das e und n wird entfernt
    echo "</pre>";

    //HTML-Tags aus einem String entfernen
    //Alle html Tags außer strong
    $text = "Das ist ein <strong>fett</strong> und <em>kursiv</em>.";
    echo $text. "</br>";
    echo strip_tags($text, "<strong>"); 

    //Länge eines Strings zählen
    echo strlen($text);
    echo "<br/>";
    echo mb_strlen($text, "utf8");
    echo "<br/>";

    //Teil auf einem Text extrahieren
    $text = "Ich bin 43 Jahre alt.";
    echo $text;
    echo "<br/>";
    echo substr($text, 8, 2);
    echo "<br/>";

    //Zeilenumbrüche in <br/> umwandeln
    $text = "Herzlich Willkommen
    im WIFI
    Salzburg";
    echo nl2br($text);

    

    ?>
</body>
</html>
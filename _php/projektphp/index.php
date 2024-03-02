<?php

// Mit ? in der URL: z.B.: http://localhost/php1/jwe23/_php/projektphp/?seite=kontakt
if (empty($_GET["seite"]) ){
    //Wenn Paramter "Seite" bei der URL nichts beinhaltet dann ist es index
    $seite = "home";
} else {
    //Wenn Parameter den Seitennamen beinhaltet, dann wird dieser gespeichert
    $seite = $_GET["seite"];
}

if($seite == "home") {
    // Wenn Seite "index ist, dann index php
    $include_datei ="home.php";
    $seitentitel = "Freiseur erzeugt kurze Haare";
    $meta_description = "Überblick der Friseur-Website";
} else if ($seite == "leistungen") {
    $include_datei = "leistungen.php";
    $seitentitel = "Profitiert von unseren Leistungen!";
    $meta_description = "Die Leistungen des Friseur";
} else if ($seite == "oeffnungszeiten") {
    $include_datei = "oeffnungszeiten.php";
    $seitentitel = "Unsere Öffnungszeiten";
    $meta_description = "Die Öffnungen des Friseurs";
} else if ($seite == "kontakt"){
    $include_datei = "kontakt.php";
    $seitentitel = "Kontaktiert uns!";
    $meta_description = "Das Kontaktformular des Friseur";
} else {
    //Seite gibt es bei uns nicht (mehr) -> error ausgeben
    $include_datei = "error404.php";
}

include "kopf.php";
/* die("ENDE"); */
include "inhalte/" . $include_datei;
include "fuss.php";

?>
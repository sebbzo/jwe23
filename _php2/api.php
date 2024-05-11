<?php

//Es wird unbedingt benötigt, bei include nur wenn es gebraucht wird
require "admin/funktionen.php";

//Schaltet auf eine andere Gestaltung
header("Content-Type: application/json");

function fehler($message) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array(
        "status" => 0, //status gibt man meist mit, das man nicht in HTTP Code analysieren muss, 
                        //dann erkennt man gleich am Status ob es funktioniert hat
        "error" => $message
    ));
    exit;
}

//GET-Parameter aus request uri
$request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];

$teile = explode("/api/", $request_uri_ohne_get, 2);
$parameter = explode("/", $teile[1]);

// array_shift nimmt das erste Element aus dem Array raus und gibt es in eine neue Variable
/*$api_version = ltrim(array_shift($parameter), "vV"); //kleines u. großes V auf der LINKEN Seite entfernen

if (empty($api_version)) {
    fehler("Bitte geben Sie eine API-Version an.");
}*/

//Leere Einträge aus Parameter-Array entfernen
foreach ($parameter as $k => $v) {
    if (empty($v)) {
        unset($parameter[$k]);
    } else {
        //alle Parameter in Kleinbuchstaben umwandeln, falls diese falsch daherkommen
        $parameter[$k] = mb_strtolower($v);
    }
}

//Indizies neu zuordnen, falls mit doppelten Schrägstrichen aufgerufen wird
$parameter = array_values($parameter);

if (empty($parameter)) {
    fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf!");
}

//--bis hier eigenltich Grundlagen für alle APIs
//---
//ab hier Spezifizierung je nach Anwendungsbedarf


if ($parameter[0] == "zutaten") {
    //Liste aller Zutaten
    $ausgabe = array(
        "status" => 1,
        "result" => array()
    );

    $result = query("SELECT * FROM zutaten ORDER BY id ASC");
    while($row = mysqli_fetch_assoc($result)) {
        $ausgabe["result"][] = $row;
    }

    echo json_encode($ausgabe);// Umwandlung eines Arrays in JSON
    exit;
} elseif ($parameter[0] == "rezepte") {

    if (!empty($parameter[1])) {
        //ID wurde übergeben
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        //Rezeptedaten ermitteln
        $sql_rezepte_id = escape($parameter[1]);
        $result = query("SELECT * FROM rezepte WHERE id = '{$sql_rezepte_id}'");
        $rezept = mysqli_fetch_assoc($result);
        if (!$rezept) {
            fehler("Mit dieser ID '{$parameter[1]}' wurde kein Rezept gefunden!");
        }
        $ausgabe["result"] = $rezept;

        //Benutzerdaten ermitteln und an die Ausgabe anhängen
        $result = query("SELECT id, benutzername, email FROM benutzer WHERE id = '{$rezept["benutzer_id"]}'");
        $ausgabe["benutzer"] = mysqli_fetch_assoc($result);

        //Zutaten ermitteln und an Ausgabe anhängen
        $result = query("SELECT zutaten.* FROM zutaten_zu_rezepte JOIN zutaten 
        ON zutaten_zu_rezepte.zutaten_id = zutaten.id
        WHERE zutaten_zu_rezepte.rezepte_id = '{$sql_rezepte_id}'
        ORDER BY zutaten_zu_rezepte.id");

        $ausgabe["zutaten"] = array();
        while($zutat = mysqli_fetch_assoc($result)) {
            $ausgabe["zutaten"][] = $zutat;
        }

        echo json_encode($ausgabe); //Umwandlung eines Arrays in JSON
        exit;

    } else {
        //Liste aller Rezepte
        $ausgabe = array(
            "status" => 1,
            "result" => array()
        );

        $result = query("SELECT * FROM rezepte ORDER BY id ASC");
        while($row = mysqli_fetch_assoc($result)) {
            $ausgabe["result"][] = $row;
        }

        echo json_encode($ausgabe);// Umwandlung eines Arrays in JSON
        exit;
    }
} else {
    fehler("Die Methode '{$parameter[0]}' exisitert nicht.");
}


echo "Das API funktioniert!";

// http://localhost/jwe23/_php2/api/v1/zutaten
?>
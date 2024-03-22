<!-- 
//////////////////
Verbindung zur Datenbank, Session für Eingeloggt,
Kurzformen für Funktionen
//////////////////
-->

<?php

// ist notwendig um auf die Session Infos zugreifen zu können
session_start();

//Verbindung zur Datenbank herstellen
$db = mysqli_connect("localhost", "root", "", "php2");
//MYSQLI mitteilen, dass unsere Befehle als utf8 kommen
mysqli_set_charset($db, "utf8");


//Funktion um SQL-Injektionen zu vermeiden
function escape($post_var) {
    global $db; //Funktion von außen reinholen
    return mysqli_real_escape_string($db, $post_var);
}

//Funktion für mysqli_query (Kurzform)
function query($sql_befehl) {
    global $db;
    $result = mysqli_query($db, $sql_befehl);

    return $result;
}

//Diese Funktion überprüft, ob der Benutzer eingeloggt ist.
//Falls nicht, dann wird er automatisch auf die Log-In Seite umgeleitet.
function ist_eingeloggt() {
    if (empty($_SESSION["eingeloggt"])) {
        header("Location: login.php");
        exit; //damit der Teil darunter nicht mehr zum Browser geschickt wird.
    }
}

?>
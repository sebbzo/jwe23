<?php

//Verbindung zur Datenbank herstellen
$db = mysqli_connect("localhost", "root", "", "php2");
//MYSQLI mitteilen, dass unsere Befehle als utf8 kommen
mysqli_set_charset($db, "utf8");



?>
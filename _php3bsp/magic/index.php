<?php
error_reporting(E_ALL);

include "Magic.php";

$m = new Magic();

// Magic method: __set()
$m->vorname = "Maria";
$m->nachname = "Hauser";

// Magic method: __get()
echo $m->nachname;
echo "<br>";

// Magic method: __call()
$m->speichern("benutzer", "insert", 5);

// Magic method: __toString()
echo $m;

echo "<br>";
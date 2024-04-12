<?php

include "Statisch.php";

$neu = new Statisch();
$neu2 = new Statisch();
$neu3 = new Statisch();

//Variable ID erhöht sich jedes Mal um 1

echo Statisch::$id;
echo "<br>";

Statisch::setze_0();
echo Statisch::$id;
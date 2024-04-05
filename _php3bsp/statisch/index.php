<?php

include "Statisch.php";

$neu = new Statisch();
$neu2 = new Statisch();
$neu3 = new Statisch();

echo Statisch::$id;
echo "<br>";

Statisch::setze_0();
echo Statisch::$id;
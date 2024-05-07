<?php

$passwort = "asdf";

//Ist ein Einweg-Hashing-Algorithmus und kann nicht mehr zurückverfolgt werden
$pw_hash = password_hash($passwort, PASSWORD_DEFAULT);
echo $pw_hash;
echo "<br>";

//Vergleichen ob das Passwort übereinstimmt (Kann dann noch gesaltet werden, aber reicht so für unsere Zwecke)
if (password_verify($passwort, $pw_hash)) {
    echo "Passwort stimmt überein";
}

?>
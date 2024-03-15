<?php

$db_passwort_md_5 = "92b06c19c2a1fa3d0b32d6a70a608000";
$passwort = "asdf";
$salt = "12";

if ($db_passwort_md_5 == md5($passwort)) {
    echo "Passwort ist richtig";
    echo "<br>";
}

echo $passwort;
echo "<br>";
//Veraltet und schnell Dekodierbar
echo md5($passwort); 
echo "<br>";
//Jetzt nicht mehr
echo md5($passwort . $salt);

//Ist ein Einweg-Hashing-Algorithmus und kann nicht mehr zurückverfolgt werden
echo "<br>";
$pw_hash = password_hash($passwort, PASSWORD_DEFAULT);
echo $pw_hash;
echo "<br>";

//Vergleichen ob das Passwort übereinstimmt (Kann dann noch gesaltet werden, aber reicht so für unsere Zwecke)
if (password_verify($passwort, $pw_hash)) {
    echo "Passwort stimmt überein";
}

?>
<?php
include "funktionen.php";
//Überprüft ob eingeloggt oder nicht (muss auf jeder Seite vorkommen)
ist_eingeloggt();

//Entfernt das Session-Cookie
//unset($_SESSION["eingeloggt"]);


include "kopf.php";
?>
<h1>
    Rezepte Administrationsbereich
</h1>
<p>Willkommen im geheimen Admin-Bereich</p>
<?php
include "fuss.php";

?>
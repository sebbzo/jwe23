<?php
//Überprüft ob eingeloggt oder nicht (muss auf jeder Seite vorkommen)
include "setup.php";
ist_eingeloggt();

//Entfernt das Session-Cookie
//unset($_SESSION["eingeloggt"]);

include "kopf-backend.php";
?>
<h1>Administration Job-DB</h1>
<p>Willkommen im geheimen Admin-Bereich</p>
<?php
include "fuss.php";

?>
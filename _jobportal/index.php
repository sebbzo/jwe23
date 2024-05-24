<?php
// Überprüft, ob der Benutzer eingeloggt ist oder nicht (muss auf jeder Seite vorkommen)
include "setup.php";
ist_eingeloggt();

// Kopfbereich der Backend-Seite einbinden
include "kopf-backend.php";
?>

<div class="container">
    <h1 class="mt-5">Administration Job-DB</h1>
    <p>Willkommen im geheimen Admin-Bereich</p>
</div>
<?php

include "fuss.php";
?>


<?php
    session_start();
    include "kopf-frontend.php";

    // Löscht die spezifische Session-Variable für den eingeloggten Benutzer
    unset($_SESSION["eingeloggt"]);

    // Löscht alle zuvor gesetzten Session-Variablen, behält aber die Session selbst bei
    session_unset();

    // Beendet die aktuelle Session und löscht alle Session-Daten samt Cookies
    session_destroy();
?>


    <div class="container">
        <h1 class="mt-5">Logout aus der Fahrzeug-DB</h1>
        <p>Sie wurden ausgeloggt.</p>
        <p><a href="login.php" class="btn btn-primary">Hier gehts zurück zum Login</a></p>
    </div>

<?php
include "fuss.php";
?>

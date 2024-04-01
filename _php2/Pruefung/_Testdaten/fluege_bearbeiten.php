<!-- 
//////////////////
Flüge bearbeiten
//////////////////
-->

<?php
include "funktionen.php";
include "kopf.php";
?>

<?php

$sql_id = escape($_GET["id"]);

if (!empty($_POST)) { 

    $sql_flugnr = escape($_POST["flugnr"]);
    $sql_abflug = escape($_POST["abflug"]);
    $sql_ankunft = escape($_POST["ankunft"]);
    $sql_start_flgh = escape($_POST["start_flgh"]);
    $sql_ziel_flgh = escape($_POST["ziel_flgh"]);

    $sql_abflug = date_create($sql_abflug);
    $sql_date_abflug = date_format($sql_abflug,"Y-m-d H:i:s");

    $sql_ankunft = date_create($sql_ankunft);
    $sql_date_ankunft = date_format($sql_ankunft,"Y-m-d H:i:s");

    query("UPDATE `fluege` SET 
    `flugnr`='[$sql_flugnr]',
    `abflug`='[$sql_date_abflug]',
    `ankunft`='[$sql_date_ankunft]',
    `start_flgh`='[$sql_start_flgh]',
    `ziel_flgh`='[$sql_ziel_flgh]' 
    WHERE `id`='[$sql_id]'
    ");

    echo "Du hast den Eintrag aktualisiert!";
    
}

?>


    <h1>Flug bearbeiten</h1>

    <!-- Formular -->
    <form action="passagiere_bearbeiten.php" method="post">
        <div>
            <label for="flugnr">Flugnummer:</label>
            <input type="text" name="flugnr" id="flugnr">
        </div>
        <div>
            <label for="abflug">Abflug:</label>
            <input type="text" name="abflug" id="abflug">
        </div>
        <div>
            <label for="ankunft">Ankunft:</label>
            <input type="text" name="ankunft" id="ankunft">
        </div>
        <div>
            <label for="start_flgh">Start-Flughafen</label>
            <input type="text" name="start_flgh" id="start_flgh">
        </div>
        <div>
            <label for="ziel_flgh">Ziel-Flughafen</label>
            <input type="text" name="ziel_flgh" id="ziel_flgh">
        </div>

        <div class="submit-button">
            <button type="submit">Flug aktualisieren</button>
        </div>
    </form>

    <?php
    include "fuss.php";

    ?>
    
</body>
</html>
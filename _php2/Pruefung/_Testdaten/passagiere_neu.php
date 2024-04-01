<!-- 
//////////////////
Neuen Passagier anlegen
//////////////////
-->

<?php
include "funktionen.php";
include "kopf.php";
?>

<?php

$errors = array();
$erfolg = false;
$date = "";

if (!empty($_POST)) {


    $sql_vorname = escape($_POST["vorname"]);
    $sql_nachname = escape($_POST["nachname"]);
    $sql_geburtsdatum = escape($_POST["geburtsdatum"]);
    $sql_flugangst = escape($_POST["flugangst"]);
    $sql_flug_id = escape($_POST["flug"]);

    $date = date_create($sql_geburtsdatum);
    $sql_date = date_format($date,"Y-m-d");

    query("INSERT INTO passagiere SET
        vorname = '{$sql_vorname}',
        nachname = '{$sql_nachname}',
        geburtsdatum = '{$sql_date}',
        flugangst = '{$sql_flugangst}',
        flug_id = '{$sql_flug_id}'
    ");

    echo "Die Zutat wurde in die Datenbank eingefügt!";
}

?>

    <h1>Neuen Passagier hinzufügen</h1>

    <!-- Formular -->
    <form action="passagiere_neu.php" method="post">
        <div>
            <label for="vorname">Vorname:</label>
            <input type="text" name="vorname" id="vorname">
        </div>
        <div>
            <label for="nachname">Nachname:</label>
            <input type="text" name="nachname" id="nachname">
        </div>
        <div>
            <label for="geburtsdatum">Geburtsdatum</label>
            <input type="date" name="geburtsdatum" id="geburtsdatum">
        </div>
        <div class="form-group">
            <label>Flugangst:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flugangst" value="Ja"> 
                <label class="form-check-label">Ja</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flugangst" value="Nein"> 
                <label class="form-check-label">Nein</label>
            </div>
        </div>
        <div class="selectbox">
            <label for="flug">Flug</label>
            <select class="form-select" name="flug" id="flug">
                <option>---Bitte wählen---</option>
                <?php
                $fluege_result = query("SELECT * FROM fluege ORDER BY abflug ASC");
                while ($flug = mysqli_fetch_assoc($fluege_result)) {
                    echo "<option value='{$flug["id"]}'";
                    echo ">Flugnr: {$flug["flugnr"]} | Abflug: {$flug["abflug"]}</option>";
                }
                ?>
            </select>
        </div>
        <div class="submit-button">
            <button type="submit">Passagier hinzufügen</button>
        </div>
    </form>

    <?php
    include "fuss.php";
    ?>
    
</body>
</html>
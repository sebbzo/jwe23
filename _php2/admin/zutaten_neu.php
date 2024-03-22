<!-- 
//////////////////
Neue Zutat anlegen
(Formular erstellen mit Validierungen & 
Daten in der Datenbank aktualisieren)
//////////////////
-->

<?php

include "funktionen.php";
ist_eingeloggt();

$errors = array();

$erfolg = false;

//Prüfen ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    //Felder validieren
    if ( empty($_POST["titel"])) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        //Überprüfen ob die Zutat schon existiert
        //Datenbank Zugriff und Abfrage
        $result = query("SELECT * FROM zutaten 
        WHERE titel = '{$sql_titel}'");
        
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $errors[] = "Diese Zutat existiert bereits!";
        }
    }

    if ( empty($_POST["menge"])) {
        $errors[] = "Bitte geben Sie die Menge an.";
    }

    if ( empty($_POST["einheit"])) {
        $errors[] = "Bitte geben Sie die Einheit an.";
    }

    //Fehler validieren
    if (empty($errors)) {
        

        //Wenn nichts eingegeben wird, dann soll NULL in die Datenbank gespeichert werden
        if ($sql_kcal_pro_100 == "") {
            $sql_kcal_pro_100 = "NULL";
        }
        
        $result = query("SELECT * FROM zutaten 
        WHERE titel = '{$sql_titel}'");
        
        $row = mysqli_fetch_assoc($result);

        query("INSERT INTO `zutaten`(`titel`, `menge`, `einheit`, `kcal_pro_100`) 
        VALUES ('{$sql_titel}','{$sql_menge}','{$sql_einheit}',{$sql_kcal_pro_100})");

        echo "Die Zutat wurde in die Datenbank eingefügt!";

        $erfolg = true;

    }
}

include "kopf.php";

?>

    <h1>Neue Zutat anlegen</h1>

<?php
    if(!empty($errors)) {
        echo "<h3>Folgende Fehler sind aufgetreten:</h3>";
        echo "<ul>";
        foreach ($errors as $key => $error) {
            echo "<li>";
            echo $error;
            echo "</li>";
        }
        echo "</ul>";
    }

        //Erfolgsmeldung
        if ($erfolg) {
            echo "<p>Zutat wurde erfolgreich angelegt.
            <a href='zutaten_liste.php'><br>Zurück zur Liste</a>
            </p>";
        }
?>

    <form action="zutaten_neu.php" method="post">
        <div>
            <label for="titel">Zutat:</label>
            <input type="text" name="titel" id="titel">
        </div>
        <div>
            <label for="kcal_pro_100">KCal/100:</label>
            <input type="number" name="kcal_pro_100" id="kcal_pro_100">
        </div>
        <div>
            <label for="menge">Menge:</label>
            <input type="number" name="menge" id="menge">
        </div>
        <div>
            <label for="einheit">Einheit:</label>
            <input type="text" name="einheit" id="einheit">
        </div>
        <div class="submit-button">
            <button type="submit">Zutat anlegen</button>
        </div>
    </form>

    <?php
    include "fuss.php";

    ?>
    
</body>
</html>
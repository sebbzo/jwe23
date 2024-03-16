<?php

include "funktionen.php";
include "kopf.php";
ist_eingeloggt();

$sql_id = escape($_GET["id"]);
$erfolg = false;

if (!empty($_POST)) { 

    //Prüfen ob das Formular abgeschickt wurde.
    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);


    //Validierung der Felder
    if ( empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        //Überprüfen ob die Zutat mit dem selben Titel bereits existiert
        //Wo der Titel gleich ist wie der eingegebene Titel un die ID anders ist als die eingegebene ID 
        //Also wenn der Titel gleich ist und die id eine andere ist, dann existiert die Zutat bereits bei einer anderen ID
        //Wenn der Titel gleich ist wie bei der aktuellen ID, dann ist das in Ordnung
        $result = query("SELECT * FROM zutaten 
        WHERE titel = '{$sql_titel}' AND id != '{$sql_id}'");
        
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

    if (empty($errors)) {

        if ($sql_kcal_pro_100 == "") {
            $sql_kcal_pro_100 = "NULL";
        }

        query("UPDATE `zutaten` SET `titel`='{$sql_titel}',`menge`='{$sql_menge}',`einheit`='{$sql_einheit}',`kcal_pro_100`={$sql_kcal_pro_100} WHERE `id` = '{$sql_id}'");

        $erfolg = true;
    }
    
}

?>


    <h1>Zutat bearbeiten</h1>

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
        echo "<p>Zutat wurde erfolgreich bearbeitet.
        <a href='zutaten_liste.php'><br>Zurück zur Liste</a>
        </p>";
    }

    $_result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($_result);

?>

    <form action="zutaten_bearbeiten.php?id=<?php echo $row["id"]?>" method="post">
        <div>
            <label for="titel">Zutat:</label>
            <input type="text" name="titel" id="titel" value="<?php
            if (!$erfolg && !empty($_POST["titel"])) {
                echo htmlspecialchars($_POST["titel"]);
            } else {
                echo htmlspecialchars($row["titel"]);
            }
            
            ?>">
        </div>
        <div>
            <label for="kcal_pro_100">KCal/100:</label>
            <input type="number" name="kcal_pro_100" id="kcal_pro_100" value="<?php 
            if (!$erfolg && !empty($_POST["kcal_pro_100"])) {
                echo htmlspecialchars($_POST["kcal_pro_100"]);
            } else {
                echo htmlspecialchars($row["kcal_pro_100"]);
            }
            
            ?>">
        </div>
        <div>
            <label for="menge">Menge:</label>
            <input type="number" name="menge" id="menge" value="<?php 
            //Für den Fehlerfall - alter/falscher Wert wieder in das Feld geschrieben
            if (!$erfolg && !empty($_POST["menge"])) {
                echo htmlspecialchars($_POST["menge"]);
            } else {
            //Datenbank Wert wird in das Feld eingetragen (Vorausfüllung)
                echo htmlspecialchars($row["menge"]);
            }
            ?>">
            
        </div>
        <div>
            <label for="einheit">Einheit:</label>
            <input type="text" name="einheit" id="einheit" value="<?php
            if (!$erfolg && !empty($_POST["einheit"])) {
                echo htmlspecialchars($_POST["einheit"]);
            } else {
                echo htmlspecialchars($row["einheit"]);
            }
            ?>">
        </div>
        <div class="submit-button">
            <button type="submit">Zutat speichern</button>
        </div>
    </form>

    <?php
    include "fuss.php";

    ?>
    
</body>
</html>
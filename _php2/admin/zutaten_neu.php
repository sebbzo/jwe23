<?php

include "funktionen.php";
ist_eingeloggt();

$errors = array();

//Prüfen ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    $sql_titel = escape($_POST["titel"]);

    //Felder validieren
    if ( empty($_POST["titel"])) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        $result = mysqli_query($db, "SELECT * FROM zutaten 
        WHERE titel = '{$sql_titel}'");
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $errors[] = "Diese Zutat existiert bereits!";
        }

    }

    if ( empty($_POST["kcal_pro_100"])) {
        $errors[] = "Bitte geben Sie die Kalorien an.";
    }

    if ( empty($_POST["menge"])) {
        $errors[] = "Bitte geben Sie die Menge an.";
    }

    if ( empty($_POST["einheit"])) {
        $errors[] = "Bitte geben Sie die Einheit an.";
    }

    if (empty($errors)) {
        //Überprüfen ob die Zutat schon existiert
        //Datenbank Zugriff und Abfrage
        
        $result = mysqli_query($db, "SELECT * FROM zutaten 
        WHERE titel = '{$sql_titel}'");
        $row = mysqli_fetch_assoc($result);

        mysqli_query($db, "INSERT INTO `zutaten`(`titel`, `menge`, `einheit`, `kcal_pro_100`) 
        VALUES ('{$_POST["titel"]}','{$_POST["menge"]}','{$_POST["einheit"]}','{$_POST["kcal_pro_100"]}')");

        echo "Die Zutat wurde in die Datenbank eingefügt!";

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
        <div>
            <button type="submit">Zutat anlegen</button>
        </div>
    </form>

    <?php
    include "fuss.php";

    ?>
    
</body>
</html>
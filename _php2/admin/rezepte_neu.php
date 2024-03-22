<!-- 
//////////////////
Neues Rezept anlegen
(Formular erstellen mit Validierungen & 
Daten in der Datenbank aktualisieren &
Benutzer-Option anzeigen mit Name der eingeloggt ist als erste Auswahl)
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
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_benutzer_id = escape($_POST["benutzer_id"]);

    //Felder validieren
    if ( empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Namen für dieses Rezept an.";
    } else {
        //Überprüfen ob die Zutat schon existiert
        //Datenbank Zugriff und Abfrage
        $result = query("SELECT * FROM rezepte 
        WHERE titel = '{$sql_titel}'");
        
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $errors[] = "Dieses Rezept existiert bereits!";
        }
    }

    if ( empty($_POST["benutzer_id"])) {
        $errors[] = "Bitte geben Sie den Benutzer an.";
    }

    if ( empty($_POST["beschreibung"])) {
        $errors[] = "Bitte geben Sie die Beschreibung an.";
    }

    //Fehler validieren
    if (empty($errors)) {

        query("INSERT INTO rezepte SET
        titel = '{$sql_titel}',
        beschreibung = '{$sql_beschreibung}',
        benutzer_id = '{$sql_benutzer_id}'
        ");

        // Welche ID wurde zuletzt gegeben: mysqli_insert_id
        $neue_rezepte_id = mysqli_insert_id($db); // ...gibt zurück welche ID zuletzt vergeben wurde


        foreach ($_POST["zutaten_id"] as $zutatNr) {

            //Wenn keine Zutat vorhanden ist, dann Abbruch
            if(empty($zutatNr)) continue;

            //Zuordnung zu Zutaten anlegen
            $sql_zutaten_id = escape($zutatNr);
    
            query("INSERT INTO zutaten_zu_rezepte SET
            zutaten_id='{$sql_zutaten_id}',
            rezepte_id='{$neue_rezepte_id}'");
        }

        //Zuordnung zu Zutaten anlegen
        $erfolg = true;

    }
}



include "kopf.php";

?>

    <h1>Neues Rezept anlegen</h1>

    
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

    <form action="rezepte_neu.php" method="post">
        <div>
            <label for="titel">Rezepttitel</label>
            <input class="form-control" type="text" name="titel" id="titel" value="<?php 
                //Text der eingegeben Wurde bleibt bestehen
                if (!empty($_POST["titel"]) && !$erfolg ) {
                    echo htmlspecialchars($_POST["titel"]);
                }
            ?>">
        </div>
        <div>
            <label for="beschreibung">Beschreibung</label>
            <textarea class="form-control" type="text" name="beschreibung" id="beschreibung"><?php 
                if (!empty($_POST["beschreibung"]) && !$erfolg ) {
                    echo htmlspecialchars($_POST["beschreibung"]);
                }?></textarea>
        </div>
        <div class="zutatenliste">
            <?php 
            $bloecke = 1;
            for ($i=0; $i < $bloecke; $i++) { 
                ?>
                <div class="zutatenblock">
                    <div>
                        <!-- Hier verwenden wir [] damit ein Array erstellt wird -->
                        <label for="zutaten_id[]">Zutat:</label>
                        <select class="form-select" name="zutaten_id[]" id="zutaten_id[]">
                            <option>---Bitte wählen---</option>
                            <?php
                            $zutaten_result = query("SELECT * FROM zutaten ORDER BY titel ASC");
                            while ($zutat = mysqli_fetch_assoc($zutaten_result)) {
                                echo "<option value='{$zutat["id"]}'";
                                echo ">{$zutat["titel"]}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php
            } //Ende der for-Schleife
            ?>
        </div>

        <!-- Im Script eine Zutat hinzufügen -->
        <a href="#" class="zutat-neu" onclick="neueZutat();">Zutat hinzufügen</a>

        <div>
            <label for="benutzer_id">Benutzer</label>
            <select class="form-select" name="benutzer_id" id="benutzer_id">
            <?php 
            //Benutzer ausgeben (id als Value und benutzer als Wert) & selected wählen beim Namen, der eingeloggt ist
                $benutzer_id_result = query("SELECT id, benutzername FROM benutzer ORDER BY benutzername ASC");
                while ($user = mysqli_fetch_assoc($benutzer_id_result)) { 
                    echo "<option value=";
                    
                    echo $user["id"];
                    echo " ";
                    //Wenn kein Erfolg soll der eingegeben Benutzer da bleiben
                    if (!empty($_POST["benutzer_id"]) && !$erfolg && $_POST["benutzer_id"] == $user["id"]) {
                        echo " selected";
                    }
                    //Normalerweise soll der, der eingeloggt ist angezeigt werden 
                    elseif (empty($_POST["benutzer_id"]) && $user["id"] == $_SESSION["benutzer_id"]) {
                        echo " selected";
                    }
                    echo ">";
                    echo $user["benutzername"];
                    echo "</option>";
                }
            ?>
            </select>
        </div>
        <div class="submit-button">
            <button type="submit">Rezept anlegen</button>
        </div>
    </form>

    <?php
    include "fuss.php";

    ?>
    
</body>
</html>
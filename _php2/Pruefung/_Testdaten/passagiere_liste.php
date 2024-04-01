<!-- 
//////////////////
Liste der Passagiere ausgeben
//////////////////
-->

<?php
include "funktionen.php";
include "kopf.php";
?>

<h1>Passagiere</h1>
<p><a href="passagiere_neu.php">Neuen Passagier anlegen</a></p>

<?php
    
    $passagiere_result = query("SELECT * FROM passagiere ORDER BY id");
    

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Vorname</th>";
        echo "<th>Nachname</th>";
        echo "<th>Geburtsdatum</th>";
        echo "<th>Flugangst</th>";
        echo "<th>Flugnummer</th>";
        echo "<th>Abflug</th>";
        echo "<th>Ankunft</th>";
        echo "<th>Startflughafen</th>";
        echo "<th>Zielflughafen</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

        while ($passagier = mysqli_fetch_assoc($passagiere_result)) {
            echo "<tr>";
            echo "<td>". $passagier["vorname"]."</td>";
            echo "<td>". $passagier["nachname"]."</td>";
            echo "<td>". $passagier["geburtsdatum"]."</td>";
            echo "<td>". $passagier["flugangst"]."</td>";

            $fluege_result = query("SELECT * FROM fluege ORDER BY id");
            while ($flug = mysqli_fetch_assoc($fluege_result)) { 

                if ($flug["id"] == $passagier["flug_id"]) {
                    echo "<td>". $flug["flugnr"]."</td>";
                    echo "<td>". $flug["abflug"]."</td>";
                    echo "<td>". $flug["ankunft"]."</td>";
                    echo "<td>". $flug["start_flgh"]."</td>";
                    echo "<td>". $flug["ziel_flgh"]."</td>";
                }
            }

            echo "<td>" . "<a href='passagiere_bearbeiten.php?id={$passagier["id"]}'>Passagier Bearbeiten</a>";
            echo "<td>" . "<a href='fluege_bearbeiten.php?id={$passagier["flug_id"]}'>Fluege Bearbeiten</a>";
            echo "<td>" . "<a href='passagiere_entfernen.php?id={$passagier["id"]}'>Passagier entfernen</a>";
            echo "</tr>";
        }

    echo "</tbody>";

    echo "</table>";
?>

<?php

include "fuss.php";

?>
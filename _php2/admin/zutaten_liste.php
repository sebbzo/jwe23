<!-- 
//////////////////
Gibt eine Liste aus mit den Zutaten
(Zugriff auf die Datenbank & 
Ausgabe der Daten in einer While-Schleife &
ID Weiterleitung auf Zutaten bearbeiten & Entfernen)
//////////////////
-->

<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";
?>

<h1>Zutaten</h1>
<p><a href="zutaten_neu.php">Neue Zutat anlegen</a></p>

<?php
    
    //$result = mysqli_query($db, "SELECT * FROM zutaten");
    //Ausbau-Schritt mit ORDER BY
    $result = mysqli_query($db, "SELECT * FROM zutaten ORDER BY titel ASC");
    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Titel</th>";
        echo "<th>kCal</th>";
        echo "<th>Menge</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row["titel"]."</td>";
            echo "<td>". $row["kcal_pro_100"]."</td>";
            echo "<td>". $row["menge"] . " " . $row["einheit"]."</td>";
            echo "<td>" . "<a href='zutaten_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>";
            echo "<td>" . "<a href='zutaten_entfernen.php?id={$row["id"]}'>Entfernen</a>";
            echo "</tr>";
        }

    echo "</tbody>";

    echo "</table>";
?>

<?php

include "fuss.php";

?>
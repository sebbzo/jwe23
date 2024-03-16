<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";
?>

<h1>Rezepte</h1>

<?php
    
    //$result = mysqli_query($db, "SELECT * FROM zutaten");
    //Ausbau-Schritt mit ORDER BY
    $result = mysqli_query($db, "SELECT * FROM rezepte ORDER BY titel ASC");
    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Titel</th>";
        echo "<th>Beschreibung</th>";
        echo "<th>Benutzer ID</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row["titel"]."</td>";
            echo "<td>". $row["beschreibung"]."</td>";
            echo "<td>". $row["benutzer_id"] . "</td>";
            echo "<td>" . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>";
            echo "<td>" . "<a href='rezepte_entfernen.php?id={$row["id"]}'>Entfernen</a>";
            echo "</tr>";
        }

    echo "</tbody>";

    echo "</table>";
?>

<?php

include "fuss.php";

?>
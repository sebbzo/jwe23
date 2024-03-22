<!-- 
//////////////////
Rezepteliste ausgeben
//////////////////
-->

<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";
?>

<h1>Rezepte</h1>
<p><a href="rezepte_neu.php">Neues Rezept anlegen</a></p>

<?php
    
    //$result = mysqli_query($db, "SELECT * FROM zutaten");
    //Ausbau-Schritt mit ORDER BY
    //Von der Rezepte Tabelle alles und von der Benutzer Tabelle nur Benutzername
    //Aufpassen was man Joint, weil zweimal id überschreiben sich
    //LEFT JOIN benutzer-Tabelle mit der Rezepte Tabelle vermischen
    //ON ist das Mapping, die ID muss gleich sein auf beiden Tabellen
    //Sortiert nach dem Titel des Rezeptes

    //SQL JOINS (da gibt es verschiedene, Siehe Google Bilder)
    $result = mysqli_query($db, "SELECT rezepte.*, benutzer.benutzername 
    FROM rezepte LEFT JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
    ORDER BY rezepte.titel ASC");

    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Titel</th>";
        echo "<th>Beschreibung</th>";
        echo "<th>Benutzer</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            //print_r($row);
            echo "<tr>";
            echo "<td>". $row["titel"]."</td>";
            echo "<td>". $row["beschreibung"]."</td>";
            echo "<td>". $row["benutzername"] . "</td>";
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
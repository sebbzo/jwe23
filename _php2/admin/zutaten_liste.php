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
            echo "<td>". $row["menge"]."</td>";
            echo "</tr>";
        }

    echo "</tbody>";

    echo "</table>";
?>

<?php

include "fuss.php";

?>
<!-- 
//////////////////
Stellenanzeigen ausgeben
//////////////////
-->

<?php

include "setup.php";
ist_eingeloggt();

use WIFI\Jobportal\Fdb\Model\Jobs;

?>

<h1>Stellenanzeigen Liste</h1>

<?php

    echo "<p><a href='jobs_bearbeiten.php'>Stellenanzeigen Bearbeiten</a></p>";
    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Titel</th>";
        echo "<th>Beschreibung</th>";
        echo "<th>Erstellt am:</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

    $jobs = new Jobs();
    $alle_jobs = $jobs->alle_jobs(); // gibt "Job" Objekte als Array zurück

    foreach ($alle_jobs as $job) {
        echo "<tr>";
            echo "<td>" . $job->kennzeichen . "</td>";
            echo "<td>" . $job->get_marke()->marke . "</td>";
            echo "<td>" . $job->farbe . "</td>";
            echo "<td>" . $job->baujahr . "</td>";
            echo "<td>"."<a href='fahrzeuge_bearbeiten.php?id={$job->id}'>Bearbeiten</a>"."</td>";
            echo "<td>"."<a href='fahrzeuge_entfernen.php?id={$job->id}'>Entfernen</a>"."</td>";
        echo "</tr>";


        /*echo "<tr>";
        echo "<td>". $row["titel"]."</td>";
        echo "<td>". $row["beschreibung"]."</td>";
        echo "<td>". $row["benutzername"] . "</td>";
        echo "<td>". $row["benutzername"] . "</td>";*/
    }
/*
    while ($row = mysqli_fetch_assoc($result)) {
        //print_r($row);
        echo "<tr>";
        echo "<td>". $row["titel"]."</td>";
        echo "<td>". $row["beschreibung"]."</td>";
        echo "<td>". $row["benutzername"] . "</td>";
        echo "<td>". $row["benutzername"] . "</td>";
        echo "<td>" . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>";
        echo "<td>" . "<a href='rezepte_entfernen.php?id={$row["id"]}'>Entfernen</a>";
        echo "</tr>";
    }*/

    echo "</tbody>";
    echo "</table>";


    /*
    $db = Mysql::getInstanz();
    $ergebnis = $db->query("SELECT * FROM fahrzeuge");
    $fahrzeuge = $ergebnis->fetch_assoc();
    //echo "<pre>"; print_r($benutzer);

    if (empty($fahrzeuge)) {
        // Fehler: Eingegebener Benutzer existiert nicht
        $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
    } else {

        echo "<h1>Fahrzeuge</h1>";
        echo "<p><a href='fahrzeuge_bearbeiten.php'>Fahrzeuge bearbeiten</a></p>";

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

    }


    //SQL JOINS (da gibt es verschiedene, Siehe Google Bilder)
    /*$result = mysqli_query($db, "SELECT rezepte.*, benutzer.benutzername 
    FROM rezepte LEFT JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
    ORDER BY rezepte.titel ASC"); */

    //print_r($result);

    
?>

<?php

include "fuss.php";

?>
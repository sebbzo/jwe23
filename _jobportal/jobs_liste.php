<!-- 
//////////////////
Stellenanzeigen ausgeben
//////////////////
-->

<?php

include "setup.php";

ist_eingeloggt();

include "kopf.php";

use WIFI\Jobportal\Fdb\Model\Jobs;

?>

<h1>Stellenanzeigen Liste</h1>

<?php

    echo "<p><a href='job_erstellen.php'>Neue Stellenanzeige hinzufügen</a></p>";
    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Titel</th>";
        echo "<th>Beschreibung</th>";
        echo "<th>Qualifikation</th>";
        echo "<th>Dienstort</th>";
        echo "<th>Stundenausmaß</th>";
        echo "<th>Gehalt</th>";
        echo "<th>Kategorie</th>";
        echo "<th>Datum & Uhrzeit</th>";
        echo "<th>Benutzer</th>";
        echo "<th>Sichtbar?</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

    // Neues Jobs Objekt
    $jobs = new Jobs();

    $benutzer_id = $_SESSION["benutzer_id"];

    // Alle Jobs von dem Benutzer als Objekte in einem Array abspeichern
    $alle_jobs = $jobs->alle_jobs($benutzer_id);

    // Die einzelnen Jobs ausgeben
    foreach ($alle_jobs as $job) {
        echo "<tr>";

            // Magic Method für jedes Job Objekt und die einzelne Eigenschaft ausgeben
            echo "<td>" . $job->titel . "</td>";
            echo "<td>" . $job->beschreibung . "</td>";
            echo "<td>" . $job->qualifikation . "</td>";
            echo "<td>" . $job->dienstort . "</td>";
            echo "<td>" . $job->stundenausmass . "</td>";
            echo "<td>" . $job->gehalt . "</td>";
            echo "<td>" . $job->get_kategorie()->kategorie . "</td>"; 
            
            //Magic Method mit dem passenden Kategorie Objekt, bei dem die Kategorie Eigenschaft ausgelesen wird
            echo "<td>" . $job->datum . "</td>";
            echo "<td>" . $job->get_benutzer()->benutzername . "</td>";

            // Schauen ob der Job sichtbar ist oder nicht
            $link_sichtbarkeit = "";
            if ($job->sichtbar == "ja") {
                $link_sichtbarkeit = "<a href='job_sichtbarkeit.php?id={$job->id}&sichtbar={$job->sichtbar}'>Ausblenden</a>";
            } else {
                $link_sichtbarkeit = "<a href='job_sichtbarkeit.php?id={$job->id}&sichtbar={$job->sichtbar}'>Einblenden</a>";
            }

            echo "<td>" . $job->sichtbar . "( " . $link_sichtbarkeit . " )</td>";
            echo "<td>"."<a href='job_bearbeiten.php?id={$job->id}'>Bearbeiten</a>"."</td>";
            echo "<td>"."<a href='job_entfernen.php?id={$job->id}'>Entfernen</a>"."</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

?>

<?php

include "fuss.php";

?>
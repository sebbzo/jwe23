<!-- 
//////////////////
// Stellenanzeigen ausgeben
//////////////////
-->

<?php

include "setup.php";

// Überprüft, ob der Benutzer eingeloggt ist
ist_eingeloggt();

include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Model\Jobs;

?>

<div class="container mt-5">
    <h1>Stellenanzeigen Liste</h1>

    <!-- Button zum Hinzufügen einer neuen Stellenanzeige -->
    <p><a href='job_erstellen.php' class='btn btn-primary mb-3'>Neue Stellenanzeige hinzufügen</a></p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th>Qualifikation</th>
                    <th>Dienstort</th>
                    <th>Stundenausmaß</th>
                    <th>Gehalt</th>
                    <th>Kategorie</th>
                    <th>Datum & Uhrzeit</th>
                    <th>Benutzer</th>
                    <th>Sichtbar?</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Erstellt ein neues Jobs-Objekt
                $jobs = new Jobs();

                // Holt die Benutzer-ID aus der Session
                $benutzer_id = $_SESSION["benutzer_id"];

                // Holt alle Jobs des Benutzers als Array von Objekten
                $alle_jobs = $jobs->alle_jobs($benutzer_id);

                // Gibt die einzelnen Jobs in der Tabelle aus
                foreach ($alle_jobs as $job) {
                    echo "<tr>";

                    // Gibt die einzelnen Eigenschaften des Job-Objekts aus
                    echo "<td>" . htmlspecialchars($job->titel) . "</td>";
                    echo "<td>" . htmlspecialchars($job->beschreibung) . "</td>";
                    echo "<td>" . htmlspecialchars($job->qualifikation) . "</td>";
                    echo "<td>" . htmlspecialchars($job->dienstort) . "</td>";
                    echo "<td>" . htmlspecialchars($job->stundenausmass) . "</td>";
                    echo "<td>" . htmlspecialchars($job->gehalt) . "</td>";
                    echo "<td>" . htmlspecialchars($job->get_kategorie()->kategorie) . "</td>";
                    echo "<td>" . htmlspecialchars($job->datum) . "</td>";
                    echo "<td>" . htmlspecialchars($job->get_benutzer()->benutzername) . "</td>";

                    // Überprüft, ob der Job sichtbar ist, und erstellt den passenden Link
                    $link_sichtbarkeit = "";
                    if ($job->sichtbar == "ja") {
                        $link_sichtbarkeit = "<a href='job_sichtbarkeit.php?id={$job->id}&sichtbar={$job->sichtbar}' class='btn btn-sm btn-warning'>Ausblenden</a>";
                    } else {
                        $link_sichtbarkeit = "<a href='job_sichtbarkeit.php?id={$job->id}&sichtbar={$job->sichtbar}' class='btn btn-sm btn-success'>Einblenden</a>";
                    }

                    echo "<td>" . htmlspecialchars($job->sichtbar) . " ( " . $link_sichtbarkeit . " )</td>";
                    echo "<td>";
                    echo "<a href='job_bearbeiten.php?id={$job->id}' class='btn btn-sm btn-info'>Bearbeiten</a> ";
                    echo "<a href='job_entfernen.php?id={$job->id}' class='btn btn-sm btn-danger'>Entfernen</a>";
                    echo "</td>";

                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

include "fuss.php";

?>

<?php
include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Model\Row\Job;

echo "<h1>Job entfernen</h1>";

$job = new Job($_GET["id"]);


if(!empty($_GET["doit"])) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    $job->entfernen();
    echo "<p>Job wurde gelöscht.</br><a href='jobs_liste.php'><br>Zurück zur Liste</a></p>";

} else {

    echo "<p>Sind Sie sicher, dass Sie den Job entfernen möchten?</p>";

    echo "<strong>Titel:</strong>" . $job->titel . "<br>";
    echo "<strong>Beschreibung:</strong>" . $job->beschreibung . "<br>";
    echo "<strong>Qualifikation:</strong>" . $job->qualifikation . "<br>";
    echo "<strong>Dienstort:</strong>" . $job->dienstort . "<br>";
    echo "<strong>Stundenausmaß:</strong>" . $job->stundenausmass . "<br>";
    echo "<strong>Gehalt:</strong>" . $job->gehalt . "<br>";
    echo "<strong>Kategorie:</strong>" . $job->get_kategorie()->kategorie . "<br>";

    echo "<p>" . "<a href='jobs_liste.php'>Nein, abbrechen.</a>
    <a href='job_entfernen.php?id={$job->id}&amp;doit=1'>Ja, sicher.</a>" . "</p>";
}


include "fuss.php";
?>
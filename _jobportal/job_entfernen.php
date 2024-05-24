<?php
include "setup.php";
ist_eingeloggt();
include "kopf-backend.php";

use WIFI\Jobportal\Fdb\Model\Row\Job;

echo '<div class="container">';
echo '<h1 class="my-4">Job entfernen</h1>';

$job = new Job($_GET["id"]);

if (!empty($_GET["doit"])) {
    // Bestätigungslink wurde geklickt -> wirklich in DB löschen
    $job->entfernen();
    echo '<div class="alert alert-success" role="alert">Job wurde gelöscht.</div>';
    echo '<a href="jobs_liste.php" class="btn btn-primary">Zurück zur Liste</a>';
} else {
    echo '<p class="my-4">Sind Sie sicher, dass Sie den Job entfernen möchten?</p>';
    echo '<div class="mb-3"><strong>Titel:</strong> ' . htmlspecialchars($job->titel) . '</div>';
    echo '<div class="mb-3"><strong>Beschreibung:</strong> ' . nl2br(htmlspecialchars($job->beschreibung)) . '</div>';
    echo '<div class="mb-3"><strong>Qualifikation:</strong> ' . htmlspecialchars($job->qualifikation) . '</div>';
    echo '<div class="mb-3"><strong>Dienstort:</strong> ' . htmlspecialchars($job->dienstort) . '</div>';
    echo '<div class="mb-3"><strong>Stundenausmaß:</strong> ' . htmlspecialchars($job->stundenausmass) . '</div>';
    echo '<div class="mb-3"><strong>Gehalt:</strong> ' . htmlspecialchars($job->gehalt) . '</div>';
    echo '<div class="mb-3"><strong>Kategorie:</strong> ' . htmlspecialchars($job->get_kategorie()->kategorie) . '</div>';
    echo '<div class="mt-4">';
    echo '<a href="jobs_liste.php" class="btn btn-secondary me-2">Nein, abbrechen</a>';
    echo '<a href="job_entfernen.php?id=' . htmlspecialchars($job->id) . '&amp;doit=1" class="btn btn-danger">Ja, sicher</a>';
    echo '</div>';
}

echo '</div>';

include "fuss.php";
?>

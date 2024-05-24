<?php
include "kopf-frontend.php";
include "setup.php";

// Platzhalter für Jobbereich und Ort setzen, falls keine Session-Variablen vorhanden sind
$searchJobPlaceholder = isset($_SESSION['search-job']) ? htmlspecialchars($_SESSION['search-job']) : "Suche nach einem Jobbereich";
$searchLocationPlaceholder = isset($_SESSION['search-location']) ? htmlspecialchars($_SESSION['search-location']) : "Suche nach einem Ort";
?>

<main>
    <div id="hero-small">
        <div class="inner-wrapper">
            <h1>Jobportal</h1>

            <!-- SUCHFUNKTION -->
            <?php
            
            use WIFI\Jobportal\Fdb\Validieren;

            if (!empty($_POST)) {
                //Formularfelder validieren
                $validieren = new Validieren();
                $validieren->ist_ausgefuellt($_POST["search-job"], "Jobbereich");
                $validieren->ist_ausgefuellt($_POST["search-location"], "Ort");

                if (!$validieren->fehler_aufgetreten()) {
                    // Alles ok -> Login Session merken
                    $_SESSION["search-job"] = $_POST["search-job"];
                    $_SESSION["search-location"] = $_POST["search-location"];

                    // Umleitung zum Admin-System
                    header("Location: ergebnisse.php");
                    exit;
                }
            }

            // Fehler ausgeben
            if(!empty($validieren)) {
                echo "<strong>Folgende Fehler sind aufgetreten:</strong>";
                echo $validieren->fehler_html();
            }
            ?>

            <!-- SUCHFORMULAR -->
            <form action="ergebnisse.php" method="post">
                <div class="input-group">
                    <div class="search-field-1">
                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo $searchJobPlaceholder; ?>"
                            aria-label="Job suchen"
                            aria-describedby="search-product"
                            id="search-job"
                            name="search-job"
                        />
                        <div id="job-list" class="overflow-auto">
                            <!-- Here comes dynamic HTML -->
                        </div>
                    </div>
                    <div class="search-field-2">
                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo $searchLocationPlaceholder; ?>"
                            aria-label="Ort suchen"
                            aria-describedby="search-location"
                            id="search-location"
                            name="search-location"
                        />
                        <div id="location-list" class="overflow-auto">
                            <!-- Here comes dynamic HTML -->
                        </div>
                    </div>
                    <div class="search-field-button">
                        <button
                            class="btn btn-outline-secondary search-button"
                            type="submit"
                            id="send"
                        >
                            Suchen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<div class='inner-wrapper'>
<h1>Ergebnisse</h1>
<?php

use WIFI\Jobportal\Fdb\Mysql;

$db = Mysql::getInstanz();

// Escape der Benutzereingaben, um SQL-Injection zu vermeiden
$sql_kategorie = $db->escape($_SESSION["search-job"]);
$sql_dienstort = $db->escape($_SESSION["search-location"]);

// SQL-Abfrage zur Suche nach Kategorien, die der Benutzereingabe entsprechen
$ergebnis_kategorie = $db->query("SELECT id FROM kategorien WHERE kategorie LIKE '%{$sql_kategorie}%'");

$ergebnis_jobs_daten = []; // Initialisiere das Array, um die Job-Daten zu speichern

// Schleife durch die Ergebnismenge der Kategorien
while ($row = $ergebnis_kategorie->fetch_assoc()) {
    // SQL-Abfrage zur Suche nach Jobs, die zur aktuellen Kategorie-ID passen und sichtbar sind
    $ergebnis_jobs = $db->query("SELECT id, titel, dienstort, beschreibung FROM jobs WHERE kategorie_id = '" . $row['id'] . "' AND sichtbar = 'ja'");
    
    // Schleife durch die Ergebnismenge der Jobs
    while ($job = $ergebnis_jobs->fetch_assoc()) {
        // Füge jeden gefundenen Job zum Array hinzu
        $ergebnis_jobs_daten[] = $job;
    }
}

echo "<div class='row'>";

if (empty($ergebnis_jobs_daten)) {
    echo "<div class='col-md-12'>";
    echo "Es wurden leider keine passenden Jobs gefunden! Probiere eine andere Suchanfrage.";
    echo "</div>";
} else {
    // Iteriere über das Array von Job-Daten und gib sie aus
    foreach ($ergebnis_jobs_daten as $row) {
        $job_id = $row['id'];
        echo "<div class='col-md-4'>";
        echo "<div class='card m-2'>";
        echo "<div class='card-body'>";
        echo "<h3 class='card-title'>" . htmlspecialchars($row["titel"]) . "</h3>";
        echo "<p class='card-subtitle'>" . htmlspecialchars($row["dienstort"]) . "</p>";
        echo "<p class='card-text'>" . htmlspecialchars($row["beschreibung"]) . "</p>";
        echo "<a href='job_detail.php?id={$job_id}' class='btn btn-primary'>Mehr erfahren</a>"; // Link zum Job-Detail
        echo "</div></div></div>";
    }
}

echo "</div></div>";
?>

<?php
include "fuss.php";
?>
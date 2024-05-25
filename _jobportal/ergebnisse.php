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
        <form action="home.php" method="post" class="my-5">
                <div class="input-group">
                    <div class="search-field-1 col-md-5">
                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo $searchJobPlaceholder; ?>"
                            placeholder="Suche nach einem Jobbereich"
                            aria-label="Job suchen"
                            aria-describedby="search-product"
                            id="search-job"
                            name="search-job"
                        />
                        <div id="job-list" class="overflow-auto">
                            <!-- Hier kommt dynamisches HTML -->
                        </div>
                    </div>
                    <div class="search-field-2 col-md-5">
                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo $searchLocationPlaceholder; ?>"
                            placeholder="Suche nach einem Ort"
                            aria-label="Ort suchen"
                            aria-describedby="search-location"
                            id="search-location"
                            name="search-location"
                            
                        />
                        <div id="location-list" class="overflow-auto">
                            <!-- Hier kommt dynamisches HTML -->
                        </div>
                    </div>
                    <div class="search-field-button col-md-2">
                        <button
                            class="btn btn-primary search-button"
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

// SQL-Abfrage zur Suche nach Jobs, die der Benutzereingabe entsprechen und sichtbar sind
$sql_query = "SELECT jobs.id, jobs.titel, jobs.dienstort, jobs.beschreibung, kategorien.kategorie 
              FROM jobs 
              INNER JOIN kategorien ON jobs.kategorie_id = kategorien.id 
              WHERE kategorien.kategorie LIKE '%{$sql_kategorie}%' 
              AND jobs.sichtbar = 'ja' AND jobs.dienstort LIKE '%{$sql_dienstort}%'";
$ergebnis_jobs = $db->query($sql_query);

echo "<div class='row'>";

if ($ergebnis_jobs->num_rows == 0) {
    echo "<div class='col-md-12'>";
    echo "Es wurden leider keine passenden Jobs gefunden! Probiere eine andere Suchanfrage.";
    echo "</div>";
} else {
    // Iteriere über das Ergebnis der SQL-Abfrage und gib die Jobs aus
    while ($row = $ergebnis_jobs->fetch_assoc()) {
        $job_id = $row['id'];
        echo "<div class='col-md-4'>";
        echo "<div class='card m-2'>";
        echo "<div class='card-body'>";
        echo "<h3 class='card-title'>" . htmlspecialchars($row["titel"]) . "</h3>";
        echo "<i class='card-text'>" . htmlspecialchars($row["dienstort"]) . "</i>";
        echo "<p class='card-text'>" . htmlspecialchars($row["beschreibung"]) . "</p>";
        echo "<p class='card-text'><strong>Kategorie:</strong> " . htmlspecialchars($row["kategorie"]) . "</p>"; // Ausgabe der Kategorie
        echo "<a href='job_detail.php?id={$job_id}' class='btn btn-primary'>Mehr erfahren</a>"; // Link zum Job-Detail
        echo "</div></div></div>";
    }
}

echo "</div></div>";
?>

<?php
include "fuss.php";
?>

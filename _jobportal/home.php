<?php
include "kopf-frontend.php";
?>
<main>
    <div id="hero" class="container">
        <div class="inner-wrapper">
            <h1>Jobportal</h1>

            <!-- SUCHFUNKTION -->
            <?php
            include "setup.php";
            use WIFI\Jobportal\Fdb\Validieren;

            if (!empty($_POST)) {
                // Validierung der Formularfelder
                $validieren = new Validieren();
                $validieren->ist_ausgefuellt($_POST["search-job"], "Jobbereich");
                $validieren->ist_ausgefuellt($_POST["search-location"], "Ort");

                if (!$validieren->fehler_aufgetreten()) {
                    // Alles in Ordnung -> Suchkriterien in Session speichern
                    $_SESSION["search-job"] = $_POST["search-job"];
                    $_SESSION["search-location"] = $_POST["search-location"];

                    // Umleitung zur Ergebnisseite
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
            <!-- SUCHFORMULAR -->
        <form action="home.php" method="post" class="mt-5">
                <div class="input-group">
                    <div class="search-field-1">
                        <input
                            type="text"
                            class="form-control"
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
                    <div class="search-field-2">
                        <input
                            type="text"
                            class="form-control"
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
                    <div class="search-field-button">
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

    <section class="inspiration-element py-5">
        <div class="inner-wrapper my-5">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Du brauchst Inspiration?</h2>
                    <p>
                        Stöbere durch unsere Jobs und finde einen, der zu dir passt!
                    </p>
                    <a href="neue-jobs.php" class="btn btn-primary">Unsere neuesten Jobs</a>
                </div>
                <div class="col-sm-6">
                    <img src="img/worker.jpg" alt="" />
                </div>
            </div>
        </div>
    </section>
    <section class="inserat-element py-5">
        <div class="inner-wrapper my-5">
            <div class="row">
                <div class="col-sm-6">
                    <img src="img/happy-workers.jpg" alt="" />
                </div>
                <div class="col-sm-6">
                    <h2>Sie suchen Mitarbeiter:innen?</h2>
                    <p>
                        Registrieren Sie sich auf unserer Plattform und veröffentlichen Sie in wenigen Minuten Ihr Inserat.
                    </p>
                    <a href="login.php" class="btn btn-primary">Jetzt Job inserieren</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include "fuss.php";
?>

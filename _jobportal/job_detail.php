<?php
include "kopf-frontend.php";
include "setup.php";

use WIFI\Jobportal\Fdb\Mysql;
use WIFI\Jobportal\Fdb\Validieren;

$erfolg = false;

// Prüfen, ob eine Job-ID übergeben wurde
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Keine Job-ID übergeben.";
    exit;
}

// Job-ID aus der URL abrufen und gegen SQL-Injection absichern
$job_id = $_GET['id'];

// Datenbankverbindung herstellen
$db = Mysql::getInstanz();

// SQL-Abfrage zur Suche nach dem Job basierend auf der Job-ID
$job_result = $db->query("
    SELECT jobs.titel, jobs.beschreibung, jobs.qualifikation, jobs.dienstort, jobs.stundenausmass, jobs.gehalt, jobs.datum, kategorien.kategorie 
    FROM jobs 
    JOIN kategorien ON jobs.kategorie_id = kategorien.id 
    WHERE jobs.id = '{$job_id}' AND jobs.sichtbar = 'ja'
");

// Prüfen, ob ein Job gefunden wurde
// $job_result->num_rows ist eine Methode in PHP, die die Anzahl der Zeilen im Ergebnis einer Datenbankabfrage zurückgibt.
if ($job_result->num_rows == 0) {
    echo "Kein Job mit dieser ID gefunden.";
    exit;
}

// Job-Daten abrufen
$job = $job_result->fetch_assoc();

// Bewerbungsformular validieren und verarbeiten
if (!empty($_POST)) {
    $validieren = new Validieren();
    $validieren->ist_ausgefuellt($_POST["name"], "Name");
    $validieren->ist_ausgefuellt($_POST["email"], "Email");
    $validieren->ist_ausgefuellt($_POST["message"], "Nachricht");

    if (!$validieren->fehler_aufgetreten()) {
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        // E-Mail senden
        $to = 'bewerbung@jobtiger.com';
        $subject = "Bewerbung für den Job: " . htmlspecialchars($job['titel']);
        $headers = "From: " . $email . "\r\n";
        $email_message = "Name: $name\nEmail: $email\n\nNachricht:\n$message";

        if (mail($to, $subject, $email_message, $headers)) {
            $erfolg = true;
        } else {
            echo "Fehler beim Senden der E-Mail. Bitte versuche es später erneut.";
        }
    }
}
?>

<main>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($job['titel']); ?></h1>
        <p><strong>Ort:</strong> <?php echo htmlspecialchars($job['dienstort']); ?></p>
        <p><strong>Stundenausmaß:</strong> <?php echo htmlspecialchars($job['stundenausmass']); ?></p>
        <p><strong>Gehalt:</strong> <?php echo htmlspecialchars($job['gehalt']); ?></p>
        <p><strong>Kategorie:</strong> <?php echo htmlspecialchars($job['kategorie']); ?></p>
        <p><strong>Erstellt am:</strong> <?php echo htmlspecialchars(date('d.m.Y', strtotime($job['datum']))); ?></p>
        <h2>Beschreibung</h2>
        <p><?php echo nl2br(htmlspecialchars($job['beschreibung'])); ?></p>
        <h2>Qualifikation</h2>
        <p><?php echo nl2br(htmlspecialchars($job['qualifikation'])); ?></p>

        <?php
        if ($erfolg) {
            echo "<div class='alert alert-success'><strong>Bewerbung erfolgreich gesendet.</strong></div>";
        } else {
            if (!empty($validieren)) {
                echo "<div class='alert alert-danger'><strong>Folgende Fehler sind aufgetreten:</strong>";
                echo $validieren->fehler_html();
                echo "</div>";
            }
        ?>

        <h2>Bewerben</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Nachricht:</label>
                <textarea class="form-control" id="message" name="message" rows="5"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Bewerbung senden</button>
        </form>

        <?php } ?>
    </div>
</main>

<?php
include "fuss.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Jobportal</title>
    
    <link rel="stylesheet" href="css/style.css" />
    <link
        rel="stylesheet"
        href="vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css"
    />
        
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Start</a></li>
        <li><a href="jobs_liste.php">Deine Stellenanzeigen</a></li>
        <li><a href="job_erstellen.php">Neuen Job erstellen</a></li>
        <li><a href="kategorien_liste.php">Alle Kategorien</a></li>
        <li><a href="kategorie_erstellen.php">Neue Kategorie erstellen</a></li>
        <li>Eingeloggt als: <?php echo $_SESSION["benutzername"];?><br><a href="logout.php">Ausloggen</a> </li>
    </ul>
</nav>


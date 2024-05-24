<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Jobportal</title>
    
    <!-- Einbindung von Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css" />
    
    <!-- Eigenes CSS -->
    <link rel="stylesheet" href="css/style.css" />
        
</head>
<body>

<!-- Bootstrap Navbar mit weißem Hintergrund -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white px-5 border-bottom mb-5">
    <div class="container-fluid">
        <div id="logo" class="navbar-brand">
            <a href="home.php">
                <img src="img/jobtiger-logo.png" alt="Logo" />
            </a>
        </div>
        <!-- Toggle Button für die mobile Ansicht -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarText"
            aria-controls="navbarText"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Navigationslinks -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Start</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="jobs_liste.php">Deine Stellenanzeigen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="job_erstellen.php">Neuen Job erstellen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategorien_liste.php">Alle Kategorien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategorie_erstellen.php">Neue Kategorie erstellen</a>
                </li>
            </ul>
            <!-- Benutzerinformationen und Logout-Link -->
            <span class="navbar-text">
               <a href="logout.php">Ausloggen</a>
            </span>
        </div>
    </div>
</nav>

<!-- Restlicher Inhalt -->
<div class="wrapper">
    

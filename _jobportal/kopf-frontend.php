<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobtiger</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <!-- Eigene CSS-Datei -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- Navigationsleiste mit weißem Hintergrund -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-5 sticky-top border-bottom mb-5">
        <div class="container-fluid">
            <div id="logo" class="navbar-brand">
                <a href="home.php">
                    <img src="img/jobtiger-logo.png" alt="Logo">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Neue Jobs -->
                    <li class="nav-item">
                        <a class="nav-link" href="neue-jobs.php">Neue Jobs</a>
                    </li>
                    <!-- Kategorien -->
                    <li class="nav-item">
                        <a class="nav-link" href="alle-kategorien.php">Kategorien</a>
                    </li>
                    <!-- Karriere-Tipps -->
                    <li class="nav-item">
                        <a class="nav-link" href="karriere-tipps.php">Karriere-Tipps</a>
                    </li>
                    <!-- Über Uns -->
                    <li class="nav-item">
                        <a class="nav-link" href="ueber-uns.php">Über Uns</a>
                    </li>
                </ul>
                <!-- Inserat schalten -->
                <span class="navbar-text">
                    <a href="login.php">Inserat schalten</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        

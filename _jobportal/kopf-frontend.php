<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Homepage Jobtiger</title>
        
        <link
            rel="stylesheet"
            href="vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css"
        />
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <div class="wrapper">
            <header id="main-header">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <div id="logo" class="navbar-brand">
                            <a href="home.php">
                                <img src="img/jobtiger-logo.png" alt="Logo" />
                            </a>
                        </div>
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
                                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/neue-jobs.php') echo 'active'; ?>">
                                    <a
                                        class="nav-link"
                                        aria-current="page"
                                        href="neue-jobs.php"
                                        >Jobs</a
                                    >
                                </li>
                                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/alle-kategorien.php') echo 'active'; ?>">
                                    <a
                                        class="nav-link"
                                        href="alle-kategorien.php"
                                        >Kategorien</a
                                    >
                                </li>
                                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/karriere-tipps.php') echo 'active'; ?>">
                                    <a
                                        class="nav-link"
                                        href="karriere-tipps.php"
                                        >Karriere-Tipps</a
                                    >
                                </li>
                                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/ueber-uns.php') echo 'active'; ?>">
                                    <a class="nav-link" href="ueber-uns.php"
                                        >Über Uns</a
                                    >
                                </li>
                            </ul>
                            <span class="navbar-text">
                                <a href="login.php">Inserat schalten</a>
                            </span>
                        </div>
                    </div>
                </nav>
            </header>

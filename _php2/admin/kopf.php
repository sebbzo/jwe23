<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezepte-Verw.-Administrationsbereich</title>
    
    <link
            rel="stylesheet"
            href="../../vendor/bootstrap-5.3.2-dist/css/bootstrap.min.css"
        />
        <link rel="stylesheet" href="../css/base.css">
        
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Start</a></li>
        <li><a href="zutaten_liste.php">Zutaten</a></li>
        <li><a href="rezepte_liste.php">Rezepte</a></li>
        <li>Eingeloggt als: <?php echo $_SESSION["benutzername"]; ?> <br><a href="logout.php">Ausloggen</a> </li>
    </ul>
</nav>

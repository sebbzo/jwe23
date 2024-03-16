<?php

include "funktionen.php";
include "kopf_fuer_login.php";

//wurde das Formular abgeschickt?
if (! empty($_POST)) {
    //Validierung
    if(empty($_POST["benutzername"]) || empty($_POST["passwort"])) {
        $error = "Benutzername oder Passwort ist leer";
    } else {
        //Benutzername und Passwort werden übergeben
        // -> in der DB nachsehen ob der Benutzer existiert

        //diese funktion bewahrt uns vor jeglicher sqlinjection
        //alle Daten aus $_POST u. $_GET (alle Benutzer bzw. Formulardaten)
        $sql_benutzername = escape($_POST["benutzername"]);

        //Datenbank Zugriff und Abfrage
        $result = query("SELECT * FROM benutzer 
        WHERE benutzername = '{$sql_benutzername}'");
        
        //Datensatz aus mysqli in ein php Array umwandeln
        $row = mysqli_fetch_assoc($result);

        //print_r($row);
        if ($row) {
            //Benutzer existiert -> Passwort prüfen mit dem eingegeben
            if (password_verify($_POST['passwort'], $row['passwort'])) {
                //Alles gut
                echo "Ist eingeloggt";

                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];

                //Anzahl Logins in DB speichern
                //& Last Login (Uhrzeit) in der Datenbank speichern
                //Als Typ in der Datenbank "datetime" verwenden

                query("UPDATE benutzer SET
                anzahl_logins = anzahl_logins + 1,
                last_login = NOW()
                WHERE id = {$row["id"]}");

                //Umleitung in Admin-System
                header("Location: index.php");
                exit;
            } else {
                //Passwort war falsch
                $error = "Benutzername oder Passwort sind falsch";
            }

        } else {
            //Benutzername wurde nicht in der DB gefunden
            $error = "Benutzername oder Passwort sind falsch";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Loginbereich zur Repezteverwaltung</h1>

<?php

if(!empty($error)) {
    echo $error."<br><br>";
}

?>

<form action="login.php" method="post">
    <div>
        <label for="benutzername">Benutzername</label>
        <input type="text" name="benutzername" id="benutzername">
    </div>
    <div>
        <label for="passwort">Passwort</label>
        <input type="password" name="passwort" id="passwort">
    </div>
    <div class="submit-button">
        <button type="submit">Einloggen</button>

    </div>
</form>
    
</body>
</html>
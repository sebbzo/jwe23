<!-- 
//////////////////
Passagiere entfernen
//////////////////
-->

<?php
include "funktionen.php";
include "kopf.php";
?>

<?php
echo "<h1>Passagier entfernen</h1>";
$sql_id = escape($_GET["id"]);


if(!empty($_GET["doit"])) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    query("DELETE FROM passagiere WHERE id = '{$sql_id}'");

    echo "<p>Passagier wurde entfernt.</br><a href='passagiere_liste.php'><br>Zurück zur Liste</a></p>";

} else {
    //Benutzer fragen, ob die Zutat wirklich entfernt werden soll
    $result = query("SELECT * FROM passagiere 
    WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);


    if (empty($row)) {
        //Zutat existiert nicht
        echo "<p>Zutat existiert nicht (mehr).</br><a href='zutaten_liste.php'><br>Zurück zur Liste</a></p>";
    } else {
        echo "<p>Sind Sie sicher, dass Sie die Zutat <strong>".htmlspecialchars($row["vorname"])." ".htmlspecialchars($row["nachname"])."</strong> entfernen möchten?</p>";
    
        echo "<p style ='text-align:center;'>"."<a href='passagiere_liste.php'>Nein, abbrechen.</a><br><a href='passagiere_entfernen.php?id={$row['id']}&doit=1'>Ja, sicher.</a>"."</p>";
    }
}


include "fuss.php";
?>
<!-- 
//////////////////
Rezepte entfernen
//////////////////
-->

<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";

echo "<h1>Rezept entfernen</h1>";
$sql_id = escape($_GET["id"]);


if(!empty($_GET["doit"])) {
    //Bestätigungslink wurde geklickt -> wirklich in DB löschen
    query("DELETE FROM rezepte WHERE id = '{$sql_id}'");

    echo "<p>Rezept wurde gelöscht.</br><a href='zutaten_liste.php'><br>Zurück zur Liste</a></p>";

} else {
    //Benutzer fragen, ob die Zutat wirklich entfernt werden soll
    $result = query("SELECT * FROM rezepte 
    WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

    if (empty($row)) {
        //Rezept existiert nicht
        echo "<p>Das Rezept existiert nicht (mehr).</br><a href='rezepte_liste.php'><br>Zurück zur Liste</a></p>";
    } else {
        echo "<p>Sind Sie sicher, dass Sie das Rezept <strong>".htmlspecialchars($row["titel"])."</strong> entfernen möchten?</p>";
    
        echo "<p style ='text-align:center;'>"."<a href='rezepte_liste.php'>Nein, abbrechen.</a><br><a href='rezepte_entfernen.php?id={$row['id']}&doit=1'>Ja, sicher.</a>"."</p>";
    }
}


include "fuss.php";
?>
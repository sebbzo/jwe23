<!-- 
//////////////////
Eine Liste mit Flüge ausgeben (Datum aufsteigend)
//////////////////
-->

<?php
include "funktionen.php";
include "kopf.php";
?>
    <h1>Alle Flüge</h1>

<?php

$result_fluege = query("SELECT * FROM fluege ORDER BY abflug ASC");
$date_now = date("Y-m-d H:i:s");

echo "<div class='row font-weight-bold border-bottom text-center'>
<div class='col-2'>Flugnummer</div>
<div class='col-3'>Abflug</div>
<div class='col-3'>Ankunft</div>
<div class='col-2'>Startflughafen</div>
<div class='col-2'>Zielflughafen</div>
</div>";

while ($flug = mysqli_fetch_assoc($result_fluege)) {

  //Künftige Flüge oder gerade in der Luft
  if ($date_now < $flug["ankunft"]) {
    echo "<div class='row text-center'>";
    echo "<div class='col-2'>".$flug["flugnr"]."</div>";
    echo "<div class='col-3'>".$flug["abflug"]."</div>";
    echo "<div class='col-3'>".$flug["ankunft"]."</div>";
    echo "<div class='col-2'>".$flug["start_flgh"]."</div>";
    echo "<div class='col-2'>".$flug["ziel_flgh"]."</div>";
    echo "</div>";
  }

}

?>

<?php
include "fuss.php";
?>
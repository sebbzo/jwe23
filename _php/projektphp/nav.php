<!--
    <nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="leistungen.html">Leistungen</a></li>
        <li class="active"><a href="oeffnungszeiten.html">Öffnungszeiten</a></li>
        <li><a href="kontakt.html">Kontakt</a></li>
    </ul>
</nav>
-->

<?php

$nav_punkte = array(
    "home" => "Startseite",
    "leistungen" => "Leistungen",
    "oeffnungszeiten" => "Öffnungszeiten",
    "kontakt" => "Kontakt"
);

//Auf welcher Seite sind wir
//Wenn der punkt mit der Seite übereinstimmt dann true

echo "<nav><ul>";

foreach($nav_punkte as $href => $nav_punkt) {
    echo '<li ';
    if ($seite == $href) echo 'class="active"';

    echo '><a href="?seite=' . $href . '">' . $nav_punkt . '</a></li>';
};

echo "</ul></nav>";

?>
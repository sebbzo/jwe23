<?php 

//Zufallspasswort generieren mit optionalem Parameter für die Länge des Passworts
function zufallspasswort($pwdlength = 8) {

    $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!$%&/()=?{[]}\+#-';
    $pwd = array();
    $poollength = strlen($pool) - 1;

    //Erstelle das Passwort
    for ($index=0; $index < $pwdlength; $index++) { 
        //Zufällige Stelle generieren
        $rdmplace = rand(0, $poollength);
        //In der Passwort-Liste das zufällige Zeichen dranhängen
        $pwd[] = $pool[$rdmplace];
    }

    //Aus der Liste einen String erstellen
    $pwd = implode($pwd);

    //Prüfen ob Klein- und Großbuchstaben, Zahlen und Sonderzeichen enthalten sind
    //Wenn nicht: Funktion neu starten
    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{0,}$/",$pwd)) {
        return zufallspasswort($pwdlength);
    } else {
        return $pwd;
    }
} 

//Ausgabe von 10 Passwörtern
for ($i=0; $i < 10; $i++) { 
    echo zufallspasswort(20);
    echo "<br><br>";
}

?>
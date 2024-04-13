<div class='wrapper'>
	<div class='row'>
		<div class='col-xs-12'>
			<h1>Registrierung</h1>
		</div>
	</div>
</div>

<?php

$erfolg = false;
$fehlermeldungen = array();

	//Formular abgeschickt
    if (! empty($_POST))
    {
        //Validierung Benutzername
        if (empty($_POST["benutzername"])) {
            $fehlermeldungen[] = "Bitte geben Sie den Benutzernamen an.";
        } else if (!preg_match("/^[A-Za-z0-9]+$/", $_POST["benutzername"]))  {
			$fehlermeldungen[] = "Der Benutzername darf nur Buchstaben und Zahlen enthalten.";
		} else if (strlen($_POST["benutzername"]) < 4) {
            $fehlermeldungen[] = "Dein Name muss mehr als 3 Zeichen beinhalten.";
        };
        
		//Validierung Passwort
		//RegEx verwendet Vorwärtsüberprüfungen, \d = mind. eine Zahl, \W_ = mind. ein Sonderzeichen
        if (empty($_POST["passwort"])) {
            $fehlermeldungen[] = "Bitte geben Sie das Passwort an.";
        } else if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{0,}$/",$_POST["passwort"])) {
			$fehlermeldungen[] = "Das Passwort muss mindestens einen Buchstaben, eine Zahl und ein Sonderzeichen enthalten.";
		} else if (strlen($_POST["passwort"]) < 6) {
            $fehlermeldungen[] = "Dein Passwort muss mehr als 5 Zeichen beinhalten.";
        };
		
		//Validierung Email
		if (empty($_POST["email"])) {
            $fehlermeldungen[] = "Bitte geben Sie Ihre Email an.";
        } else if (! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST["email"])) {
            $fehlermeldungen[] = "Bitte prüfen Sie Ihre E-Mail.";
        };

		//Validierung AGB
		if (! array_key_exists("agb",$_POST)) {
			$fehlermeldungen[] = "Bitte akzeptieren Sie unsere AGBs.";
		};

        //Wenn keine Fehler aufgetreten sind
        if (empty($fehlermeldungen)) {
            $erfolg = true;
            $inhalt = "Registrierung:
            Benutzername: {$_POST["benutzername"]}
            Passwort: {$_POST["passwort"]}
            E-Mail: {$_POST["email"]}
            ";

            //Registrierung in Ordner "registrierungen" speichern
            $date_now = date("Y-m-d_H-i-s");
            file_put_contents("registrierungen/registration_{$date_now}.txt", $inhalt);
        };
    };
?>

<?php 
		//Ausgabe Fehlermeldungen
		if (!empty($fehlermeldungen)) {
			echo "<strong>Folgender Fehler ist aufgetreten:</strong><br>";
			echo "<ul>";
			foreach ($fehlermeldungen as $index => $fehlermeldung) {
				echo "<li>";
				echo $fehlermeldung;
				echo "</li>";
			}
			echo "</ul>";
		};

		//Erfolgsmeldung ausgeben, wenn es keine Fehlermeldungen gibt & Formular entfernen
			if ($erfolg) {
				echo "<h3>Vielen Dank für Ihre Anfrage!</h3>";
			} else {
		?>

<!-- Formular -->
<form id='register-form' method="post" action="index.php?seite=registrieren">
	<div class="wrapper">
		<div class='row'>
			<div class='col-xs-12 col-sm-12'>
				<label for='username'>Benutzername</label>
				<input type='text' id='username' name='benutzername' value='<?php 
                                //Abgeschickter Input geht nicht verloren
                                if (!empty($_POST["benutzername"]) ) {
                                    echo htmlspecialchars($_POST["benutzername"]);
                                }
                            ?>' />
			</div>
			<div class='col-xs-12 col-sm-12'>
				<label for='password'>Passwort</label>
				<input type='password' id='password' name='passwort' value='<?php 
                                //Abgeschickter Input geht nicht verloren
                                if (!empty($_POST["passwort"]) ) {
                                    echo htmlspecialchars($_POST["passwort"]);
                                }
                            ?>'/>
			</div>
			<div class='col-xs-12 col-sm-12'>
				<label for='email'>E-Mail</label>
				<input type='text' id='email' name='email'  value='<?php 
                                //Abgeschickter Input geht nicht verloren
                                if (!empty($_POST["email"]) ) {
                                    echo htmlspecialchars($_POST["email"]);
                                }
                            ?>'/>
			</div>
			<div class='col-xs-12 col-sm-12'>
				<input type='checkbox' id='toc' name='agb' <?php 
                                //Abgeschickter Input geht nicht verloren
                                if (array_key_exists("agb",$_POST) ) {
                                    echo "checked";
                                }
                            ?>/>
				<label for='toc'>Ich akzeptiere die AGB.</label>
			</div>
			<div class='col-xs-12'>
				<input type='submit' value='Registrieren' />
			</div>
		</div>
	</div>
</form>

<?php
}
?>
<?php

//echo "<pre>"; print_r($_POST); echo "</pre>";

$erfolg = false;
$fehlermeldungen = array();


//wurde das Formular abgeschickt?
    if (! empty($_POST))
    {
        //Validierung - wurde das Formular richtig ausgefüllt?
        if (empty($_POST["name"])) {
            $fehlermeldungen[] = "Bitte geben Sie Ihren Namen an.";
        } else if (strlen($_POST["name"]) <= 2) {
            $fehlermeldungen[] = "Dein Name muss mehr als zwei Zeichen beinhalten.";
        };
        
        if (empty($_POST["email"])) {
            $fehlermeldungen[] = "Bitte geben Sie Ihre Email an.";
        } else if (! preg_match("/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,15}$/", $_POST["email"])) {
            $fehlermeldungen[] = "Bitte prüfen Sie Ihre E-Mail.";
        };

        if (!empty($_POST["prueffeld"])) {
            $fehlermeldungen[] = "Bitte das Prüffeld leer lassen. Sie sind bestimmt ein Roboter.";
        }

        if (empty($_POST["message"])) {
            $fehlermeldungen[] = "Bitte geben Sie Ihre Nachricht an.";
        };

        //wenn keine Fehler aufgetreten sind
        if (empty($fehlermeldungen)) {
            $erfolg = true;
            $mail_inhalt = "Anfrage über Kontaktformular:
                
Name: {$_POST["name"]}
Email: {$_POST["email"]}
Nachricht: {$_POST["message"]}


            ";
        
            //testweise: Inhalt im Browser ausgeben
            //echo "<pre>"; print_r($mail_inhalt); echo "</pre>";

            //Anfrage in Datei am Server speichern (als backup)
            $date_now = date("Y-m-d_H-i-s");
            file_put_contents("mailbackup/mail{$date_now}.txt", $mail_inhalt);

            //email versenden
            mail("sebastian.oberreiter@hotmail.com", "Webseiten-Kontaktformular-Anfrage von {$_POST["name"]}", $mail_inhalt);

        };
    };
?>

<h1><?php echo $seitentitel; ?></h1>
                <div class="left">
                    <h2>Wifi Salzburg</h2>
                    <p>
                        Musterhausstraße 13<br />
                        5020 Salzburg<br />
                        Österreich<br />
                        <br />
                        0043-662-12345<br />
                        <a href="mailto:rainer.christian@gmx.at">rainer.christian@gmx.at</a><br />
                        <a href="http://www.wifisalzburg.at" target="_blank">www.wifisalzburg.at</a><br />
                        <br />
                        <br />
                        Oder einfach Formular ausfüllen, abschicken, fertig!<br />
                        Wir werden uns umgehend um Ihr Anliegen bemühen.
                    </p>
                </div>
                <div class="contact right">

                <?php 
                //Aufgetretene Fehler der Reihe nach ausgeben
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

                //Erfolgsmeldung ausgeben, wenn alles in Ordnung ist
                    if ($erfolg) {
                        echo "<h3>Vielen Dank für Ihre Anfrage!</h3>";
                    } else {
                ?>
                    <form action="" method="post">
                        <div>
                            <input type="text" id="name" name="name" value="<?php 
                                if (!empty($_POST["name"]) ) {
                                    //Wenn man Gänsefüschen, Backslash und so eintippt, das das auch richtig angezeigt wird
                                    echo htmlspecialchars($_POST["name"]);
                                }
                            ?>" placeholder="Name"/>
                        </div>
                        <div>
                            <input type="text" id="email" name="email" value="<?php 
                                if (!empty($_POST["email"]) ) {
                                    //Wenn man Gänsefüschen, Backslash und so eintippt, das das auch richtig angezeigt wird
                                    echo htmlspecialchars($_POST["email"]);
                                }
                            ?>"placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" id="prueffeld" name="prueffeld" value="" placeholder="Dieses Feld leer lassen">
                        </div>


                        <div>
                            <textarea id="message" name="message" value="" placeholder="Ihre Nachricht"><?php 
                                if (!empty($_POST["message"]) ) {
                                    //Wenn man Gänsefüschen, Backslash und so eintippt, das das auch richtig angezeigt wird
                                    echo htmlspecialchars($_POST["message"]);
                                }
                            ?></textarea>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit" id="submit" name="submit">Absenden</button>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
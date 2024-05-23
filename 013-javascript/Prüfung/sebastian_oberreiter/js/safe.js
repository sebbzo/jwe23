// Hier wird der eingegebene Code validiert und das Feedback ausgegeben
let validateCode = function (index) {
    // Hole die Eingabedaten des Nutzers
    let so_userinput = $("input.code-input-field").val();

    // Überprüfe die Richtigkeit des Codes
    if (so_userinput == 9536) {
        // Gib Feedback
        $("input.feedback-output").val("Tresor geöffnet!");

        // Ändere das Styling
        changeBackgroundGreen();
    }

    // Wenn keine positive ganze Zahl eingegeben wurde
    else if (isNumeric(so_userinput) == false) {
        // Gib Feedback
        $("input.feedback-output").val("Gib eine positive Ganze Zahl ein!");

        // Ändere das Styling
        changeBackgroundRed();

        // Entferne die Nummer vom Input Feld und gebe dem Inputfeld den Fokus
        $("input.code-input-field").val("").focus();
    }

    // Wenn die Länge des Codes zu kurz ist
    else if (so_userinput.length < 4) {
        // Berechne den Abstand zur richtigen Zahlenlänge
        let so_missing_numbers = 4 - so_userinput.length;
        let so_output_string;

        // Generiere den Output String
        if (so_missing_numbers < 2) {
            so_output_string = `Dein Code ist zu kurz! Dir fehlt noch ${so_missing_numbers} Nummer.`;
        } else {
            so_output_string = `Dein Code ist zu kurz! Dir fehlen noch ${so_missing_numbers} Nummern.`;
        }

        // Gib Feedback
        $("input.feedback-output").val(so_output_string);

        // Ändere das Styling
        changeBackgroundRed();

        // Entferne die Nummer vom Input Feld und gebe dem Inputfeld den Fokus
        $("input.code-input-field").val("").focus();
    }

    // Wenn die Länge des Codes zu lang ist
    else if (so_userinput.length > 4) {
        // Berechne den Abstand zur richtigen Zahlenlänge
        let so_missing_numbers = so_userinput.length - 4;
        let so_output_string;

        // Generiere den Output String
        if (so_missing_numbers < 2) {
            so_output_string = `Dein Code ist um ${so_missing_numbers} Nummer zu lang.`;
        } else {
            so_output_string = `Dein Code ist um ${so_missing_numbers} Nummern zu lang.`;
        }

        // Gib Feedback
        $("input.feedback-output").val(so_output_string);

        // Ändere das Styling
        changeBackgroundRed();

        // Entferne die Nummer vom Input Feld und gebe dem Inputfeld den Fokus
        $("input.code-input-field").val("").focus();
    }

    // Wenn die Zahl falsch ist
    else {
        // Gib Feedback
        $("input.feedback-output").val("Falscher Code. Probiere erneut!");

        // Ändere das Styling
        changeBackgroundRed();

        // Entferne die Nummer vom Input Feld und gebe dem Inputfeld den Fokus
        $("input.code-input-field").val("").focus();
    }
};

// REGEX Testen ob Eingabe eine positive Ganze Zahl ist (von Stackoverflow)
function isNumeric(value) {
    return /^\d+$/.test(value);
}

// Ändere die Hintergrundfarbe in Rot und die Textfarbe in Weiß
function changeBackgroundRed() {
    $("input.feedback-output").css("background-color", "#EB5E55");
    $("input.feedback-output").css("color", "white");
}

// Ändere die Hintergrundfarbe in Grün und die Textfarbe in Weiß
function changeBackgroundGreen() {
    $("input.feedback-output").css("background-color", "#09814A");
    $("input.feedback-output").css("color", "white");
}

// Event Handler bei Klick auf den Button
$("button").click(function () {
    // Funktion validateCode ausführen
    validateCode();
});

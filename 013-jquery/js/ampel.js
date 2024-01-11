const settings = {
    states: [
        "0", //rot
        "01", //rot+gelb
        "2", //grün
        "1", //gelb
    ],
    state: "2",
    duration: {
        red: 5,
        green: 2,
    },
};

// Start-Wert (state) in das DIV eintragen
$("#ampel").text(settings.state);

const fromGreenToRed = function () {
    window.setTimeout(function () {
        settings.state = settings.states[3]; // setzen auf gelb
        window.setTimeout(function () {
            settings.state = settings.states[0]; // setzen auf rot
            window.setTimeout(fromRedToGreen, settings.duration.red * 1000);
        }, 1000);
    }, 1000);
};

const fromRedToGreen = function () {
    window.setTimeout(function () {
        settings.state = settings.states[1]; // setzen auf rot+gelb
        window.setTimeout(function () {
            settings.state = settings.states[2]; // setzen auf grün
            window.setTimeout(fromRedToGreen, settings.duration.red * 1000);
        }, 1000);
    }, 1000);
};

window.setInterval(function () {
    $("#ampel").text(settings.state);
}, 1000);

fromGreenToRed();

$("ampel").css("background-color", "red");

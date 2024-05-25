// Jobs ausgeben

const jobUrl = "http://localhost/jwe23/_jobportal/api/categories/list";
let jobList = [];

// Daten in eine Liste hinzufügen
let getJobsFromAPI = function () {
    $.getJSON(jobUrl, function (data) {
        // An der Stelle Result im JSON-Objekt
        data.result.forEach((element) => {
            jobList.push(element.kategorie);
        });
    }).fail(function () {
        console.log("Fehler beim Laden der Daten");
    });
};

getJobsFromAPI();

// Wenn ein job-item angeklickt wird, dann soll der Text in das Eingabefeld eingefügt werden
$(document).ready(function () {
    // Delegierter Event-Handler (auch für dynamisch generierte list-item Klassen)
    $("#job-list").on("click", ".list-item", function () {
        var text = $(this).find("p").text();
        $("#search-job").val(text);

        // Die gefilterte Liste leeren
        $("#job-list").empty();
    });
});

// Die Kategorien ausgeben
const prependJob = function (index, job) {
    $("#job-list").prepend(
        `<div class="list-item" data-product-id="${index}"><p>${job}</p></div>`
    );
};

// Hier werden die Kategorien ausgespielt
const createJobList = function () {
    $(jobList).each(prependJob);
};
createJobList();

// Funktion zur Anzeige der gefilterten Liste
const showFilteredList = function (list) {
    $("#job-list").empty();
    $(list).each(prependJob);
};

// Die Filterfunktion
const filterList = function () {
    // Holt den aktuellen Wert des Eingabefelds (this bezieht sich auf das Eingabefeld, das das Ereignis ausgelöst hat)
    let value = $(this).val().toLowerCase();

    // Wenn das Eingabefeld leer ist, die gefilterte Liste leeren
    if (!value) {
        $("#job-list").empty();
        return;
    }

    // Filtert die Liste der Jobs (jobList) anhand des Werts im Eingabefeld
    // Überprüft, ob jeder Job (article) den eingegebenen Wert (value) enthält
    // Die Artikel werden in Kleinbuchstaben umgewandelt, um die Suche nicht case-sensitiv zu machen
    let filteredList = jobList.filter(function (job) {
        return job.toLowerCase().includes(value);
    });

    showFilteredList(filteredList);
};

// Jedes Mal, wenn eine Taste losgelassen wird, wird die Funktion filterList aufgerufen
$("#search-job").on("keyup", filterList);

// Orte ausgeben

const locationUrl = "http://localhost/jwe23/_jobportal/api/location/list";
let locationList = [];

let getLocationFromAPI = function () {
    $.getJSON(locationUrl, function (data) {
        data.result.forEach((element) => {
            locationList.push(element.dienstort);
        });
    }).fail(function () {
        console.log("Fehler beim Laden der Daten");
    });
};

getLocationFromAPI();
$("#load").on("click", function () {
    console.log(locationList);
});

// Wenn ein location-item angeklickt wird, dann soll der Text in das Eingabefeld eingefügt werden
$(document).ready(function () {
    // Delegierter Event-Handler (auch für dynamisch generierte list-item Klassen)
    $("#location-list").on("click", ".list-item", function () {
        var text = $(this).find("p").text();
        $("#search-location").val(text);

        // Die gefilterte Liste leeren
        $("#location-list").empty();
    });
});

// Den Ort ausgeben
const prependNewLocation = function (index, location) {
    $("#location-list").prepend(
        `<div class="list-item" data-product-id="${index}"><p>${location}</p></div>`
    );
};

// Hier werden die Orte ausgespielt
const createLocationList = function () {
    $(locationList).each(prependNewLocation);
};
createLocationList();

// Funktion zur Anzeige der gefilterten Liste
const showFilteredLocationList = function (list) {
    $("#location-list").empty();
    $(list).each(prependNewLocation);
};

// Die Filterfunktion
const filterLocationList = function () {
    // Holt den aktuellen Wert des Eingabefelds (this bezieht sich auf das Eingabefeld, das das Ereignis ausgelöst hat)
    let value = $(this).val().toLowerCase();

    // Wenn das Eingabefeld leer ist, die gefilterte Liste leeren
    if (!value) {
        $("#location-list").empty();
        return;
    }

    // Filtert die Liste der Orte (locationList) anhand des Werts im Eingabefeld
    // Überprüft, ob jeder Ort (article) den eingegebenen Wert (value) enthält
    // Die Artikel werden in Kleinbuchstaben umgewandelt, um die Suche nicht case-sensitiv zu machen
    let filteredList = locationList.filter(function (location) {
        return location.toLowerCase().includes(value);
    });

    showFilteredLocationList(filteredList);
};

// Jedes Mal, wenn eine Taste losgelassen wird, wird die Funktion filterLocationList aufgerufen
$("#search-location").on("keyup", filterLocationList);

let temperature = 24; //int

temperature = 23;

temperature = temperature - 1;

temperature++;

temperature += 2;

let display = document.querySelector("#display");

// Temperatur gleich in HTML ausgeben (beim Laden)
display.innerHTML = temperature;

console.log(temperature);

let changeTemperature = function (direction) {
    if (direction == "up") {
        temperature++;
    }

    if (direction == "down") {
        temperature--;
    }

    console.log(temperature);
    // Aktuelle Temperatur in HTML ausgeben
    display.innerHTML = temperature;
};

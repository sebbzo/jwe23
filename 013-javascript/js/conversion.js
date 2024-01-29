let myNumber = 123;
let myString = "2023-05-23";
let myArray = [
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday",
];
let myObject = {
    type: "car",
    brand: "audi",
    kw: "334",
    color: "red",
    price: "120.000,00",
};

let myObject2 = {
    type: "car",
    brand: "opel",
    kw: "90",
    color: "brown",
    price: "20.000,50", //20000.50
};

console.log("Die Abbuchung erfolgt von dem Konto mit der Nummer: " + myNumber);

console.log("The bill  has been paid on " + myArray[3]);

console.log(
    "My car has " + myObject.kw + " and is from the brand " + myObject.brand
);

console.log(myObject.kw - myObject2.kw);

console.log(myObject.price);

myObject2.price = Number(
    myObject2.price.replace(".", "").replace(",", ".")
).toFixed(2);
myObject.price = Number(
    myObject.price.replace(".", "").replace(",", ".")
).toFixed(2);

console.log(myObject.price, myObject2.price);

console.log(myObject.price - myObject2.price);

console.log(new Date(myString));

let price = "€ 1.433,08";

console.log(price.substring(2, price.length));

//remove string from price
let price2 = "7.247,00 Euro";
console.log(price2.search("Euro"));
console.log(price2.replace("Euro", ""));

//convert csv-structured string into array
let stringOfinfo =
    "Max;Mustermann;Salzburgerstrasse 55;5620;30.01.2000;4,36604335885;AT";
console.log(stringOfinfo.split(";"));

//convert/parse string into array
let serverResponse = '["Monday","Tuesday", "Wednesday"]';
console.log(JSON.parse(serverResponse));

//convert/parse string into object
let serverResponse2 = '{"text": 1, "email": "mo@obinet.at", "zip": 5600}';
console.log(JSON.parse(serverResponse2));

// Für Lokal (Achtung Anfrage verzögert)

$.getJSON("js/example.json", function (data) {
    test2 += "Latitude:" + data.lat;
});

console.log(test2);
console.log("STOPP");

// Für Online (Achtung Anfrage verzögert)

fetch("https://dummyjson.com/products/1")
    .then((res) => res.json())
    .then((data) => {
        meineVariable = data;
        test1 = meineVariable.brand;
        console.log(meineVariable);
        console.log(test1);
        // Hier kannst du auf die Variable zugreifen oder weitere Aktionen durchführen
    })
    .catch((error) => {
        console.error("Fehler bei der Fetch-Anfrage:", error);
    });

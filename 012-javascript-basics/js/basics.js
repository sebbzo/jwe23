console.log("hier wird debugged!");

let myName = "Sebastian123"; // String      Zeichenkette
let myAge = 23; // Zahl (Ganzzahl)          int oder integer
let myWeight = 70.9; // Zahl (Dezimalzahl)  float
let organicFood = false; // Boolsche Werte (falsch/wahr)     bool

let myList = ["Brot", "Milch", "Ketchup"]; // Liste/Array       array

let dynamischesHTML = '<p style="color:red;">Roter Text</p>';

let dynamischesHTML2 = '<p style="color: green;">Grüner Text</p>';

document.body.innerHTML = dynamischesHTML;

let showMyListInConsole = function () {
    console.log(myList);
};

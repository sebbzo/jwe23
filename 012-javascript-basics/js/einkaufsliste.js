let myList = [];

// myList.push('Banane');

let newElement = document.querySelector("#newElement");

let addNewElement = function () {
    let newElementValue = newElement.value;
    console.log(newElementValue);
    myList.push(newElementValue);
    getAllElementsFromList();
};

let test = '';
console.log(typeof test);

let getAllElementsFromList = function () {
    let htmlOutput = "";
    // myList Elemente alle durchgehen und Zeile für Zeile in htmlOutput verketten.
    myList.forEach((element) => {
        htmlOutput += element + "<br>";
    });
    document.querySelector("#myListOutput").innerHTML = htmlOutput;
};

let my2List = [];

let new2Element = document.querySelector("#newElement").innerText;

let myList = [];

// myList.push('Banane');

let newElement = document.querySelector("#newElement");

let addNewElement = function () {
    let newElementValue = newElement.value;
    console.log(newElementValue);
    myList.push(newElementValue);
    getAllElementsFromList();
};

let getAllElementsFromList = function () {
    let htmlOutput = "";
    // myList Elemente alle durchgehen und Zeile für Zeile in htmlOutput verketten.
    myList.forEach((element) => {
        htmlOutput += element + "<br>";
    });
    document.querySelector("#myListOutput").innerHTML = htmlOutput;
};

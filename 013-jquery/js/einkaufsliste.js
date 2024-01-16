//Einkaufsliste nur in jQuery

let myList = ["brot", "senf", "ketchup"];

// Wenn das Cookie für die "product-list" existiert, dann befülle das Array mit den Produkten aus dem Cookie
if (typeof Cookies.get("product_list") !== "undefined") {
    /* die Liste kommt als Komma-separierter String angeliefert,
    daher mus diese wieder in ein Array kovertiert werden */

    myList = Cookies.get("product_list").split(",");
}

// Vorlage für ein Listenelement
/*

<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Default checkbox
  </label>
</div>

*/

// same as myList.forEach {...}
// Reine Information
$(myList).each(function (i, product) {
    // i ist die Zahl (key), product ist der Name(value)
    console.log(product);
});

const addNewProduct = function () {
    myList.push($("#new-product").val());
    Cookies.set("product_list", myList, { expires: 365 });
    prependNewProduct(myList.length - 1, myList[myList.length - 1]);
    $("#new-product").val("").focus();
};

$("#add-product").on("click", addNewProduct);

$("#new-product").on("keyup", function (e) {
    console.log(e.keyCode);

    // Enter wurde gedrückt
    if (e.keyCode == 13) {
        addNewProduct();
    }
});

const prependNewProduct = function (index, product) {
    $("#product-list")
        .prepend(`<div class="form-check" data-product-id="${index}">
        <input
            class="form-check-input"
            type="checkbox"
            value="${product}"
            id="product-${index}"
        />
        <label class="form-check-label" for="product-${index}">
        ${product}
        </label>
    </div>`);
};

// Hier werden die schon bestehenden Zutaten ausgespielt
const createProductList = function () {
    $(myList).each(prependNewProduct);
};
createProductList();

// myList.push('Banane');
/* 
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
 */

///
// PRODUKTE HINZUFÜGEN & LISTE ERSTELLEN + IN COOKIES SPEICHERN
///

let myList = ["Zebra", "Tiger", "Affe"];

// Die Cookies reinholen (Sodass es sich an die Cookies anpasst)
if (typeof Cookies.get("product_list") !== "undefined") {
    console.log(Cookies.get("product_list")); // Cookie kommt mit , Seperated
    myList = Cookies.get("product_list").split(",");
}

console.log(myList);

// Test
$(myList).each(function (i, product) {
    console.log(i); // Ist die Stelle (Zahl) im Array
    console.log(product); // Ist der Inhalt der Stelle
});

// Neues Produkt hinzufügen
const addNewProduct = function () {
    let value = $("#new-product").val(); // den Wert von der Eingabe mit id new-product
    console.log(value);

    // Filterfunktion bei Duplikaten
    let filteredList = myList.filter(function (article) {
        return article.toLowerCase().includes(value.toLowerCase());
    }); // Wenn in der Liste im lowerCase & die value beinhaltet dann wird das in eine Liste ausgegeben

    // In der Liste hinzugefügt und als Cookie gespeichert
    if (!filteredList.length) {
        myList.push(value);
        Cookies.set("product_list", myList);
    } else {
        $("#new-product").val(""); // Zurücksetzen im Input Feld auf nichts
    }

    console.log(myList);
    $("#new-product").val("").focus(); // Da wird nochmal neu Fokussiert in der Input Zeile
};

$("#add-product").on("click", addNewProduct);

// Enter Drücken um Produkt hinzuzufügen
$("#new-product").on("keyup", function (e) {
    console.log(e.keyCode); // KeyCode gibt die Zahl aus für die Taste, die du drückst

    // Enter wurde gedrückt
    if (e.keyCode == 13) {
        addNewProduct();
    }
});

// Im Tag: "Product List" den HTMl Code generieren
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
    $(myList).each(prependNewProduct); // Die Parameter werden automatisch von der each Funktion gesetzt
    console.log("Here Created");
    console.log(myList);
};
createProductList();

///
// FILTER FUNKTION
///

// Die gefilterten Werte bzw. Liste ausgeben
const showFilteredList = function (list) {
    $("#product-list").empty();

    $(list).each(prependNewProduct);
};

// Prüfen ob der Wert schon vorhanden
const filterList = function () {
    let value = $(this).val().toLowerCase(); // "This" bezieht sich hierbei auf den Inhalt von #new-product und #add-product und wandelt den Inhalt um

    let filteredList = myList.filter(function (article) {
        return article.toLowerCase().includes(value); // Schauen ob der eingegebene Wert vorkommt im Inhalt, wenn ja Liste ausgeben
    });

    showFilteredList(filteredList);
};

$("#new-product").on("keyup", filterList);
$("#add-product").on("click", filterList);

///
// CHECKED FUNKTION
///

// Eigenes Cookie für Checked erstellen und schauen, ob checked oder nicht
const setCheckedListItems = function () {
    const cookie = Cookies.get("checked_items");

    if (typeof cookie != "undefined" && cookie != "") {
        let checkedItems = cookie.split(",");
        $(checkedItems).each(function (index, value) {
            $("#product-" + value).prop("checked", true); //
        }); // Testen ob die Value gechecked ist oder nicht
    }
};

setCheckedListItems();

// NEU
let checkedInputs;

$("#product-list input").change(function () {
    let listOfCheckedInputs = [];

    let checkedInputs = $("input:checked"); // Ist der Value von allen Checked Elementen
    checkedInputs.each(function () {
        let productId = $(this).closest("[data-product-id]").data("product-id");
        console.log(productId);
        listOfCheckedInputs.push(productId);
        console.log(listOfCheckedInputs);
    });

    Cookies.set("checked_items", listOfCheckedInputs.join(","), {
        expires: 365,
    });
});

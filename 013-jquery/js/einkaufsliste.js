//Einkaufsliste nur in jQuery

let myList = ["brot", "senf", "ketchup"];

// Wenn das Cookie für die "product-list" existiert, dann befülle das Array mit den Produkten aus dem Cookie
if (typeof Cookies.get("product_list") !== "undefined") {
    /* die Liste kommt als Komma-separierter String angeliefert,
    daher mus diese wieder in ein Array kovertiert werden */

    myList = Cookies.get("product_list").split(",");
}

/* RegEx Exkursion*/
let myEmail = "random@email.local";

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

if (validateEmail(myEmail) == true) {
    console.log(`${myEmail} is a valid email address`);
} else {
    console.log(`${myEmail} is not a valid email address`);
}

// same as myList.forEach {...}
// Reine Information
$(myList).each(function (i, product) {
    // i ist die Zahl (key), product ist der Name(value)
    console.log(product);
});

const addNewProduct = function () {
    let value = $("#new-product").val();

    let filteredList = myList.filter(function (article) {
        return article.toLowerCase().includes(value.toLowerCase());
    });

    if (!filteredList.length) {
        myList.push(value);
        Cookies.set("product_list", myList, { expires: 365 });

        //Alternative Speichermöglichkeit für Daten in der Local Storage des Browsers
        prependNewProduct(myList.length - 1, myList[myList.length - 1]);
    } else {
        $("#new-product").val("");
    }

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

const setCheckedListItems = function () {
    const cookie = Cookies.get("checked_items");
    if (typeof cookie != "undefined" && cookie != "") {
        let checkedItems = cookie.split(",");
        $(checkedItems).each(function (index, value) {
            $("#product-" + value).prop("checked", true); //
        });
    }
};

setCheckedListItems();

// FILTER FUNKTION

const showFilteredList = function (list) {
    $("#product-list").empty();

    $(list).each(prependNewProduct);
};

const filterList = function () {
    let value = $(this).val().toLowerCase();

    let filteredList = myList.filter(function (article) {
        return article.toLowerCase().includes(value);
    });

    showFilteredList(filteredList);
};

$("#new-product").on("keyup", filterList);
$("#add-product").on("click", filterList);

// lesen der aktuell gechecked inputs
// bauen des Arrays mit der Liste aller product-IDs der Elemente die gecheckt sind
// Speichern in Cookies

let checkedInputs;

$("#product-list input").change(function () {
    let listOfCheckedInputs = [];

    let checkedInputs = $("input:checked");
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

// Cookie auslesen
// Array mit Schleife durchgehen
// Listenelemente .prop() aktualisieren

// HÜ: Wenn die Liste aktualisiert wird, müssen die Cookies (Liste) auch immer aktualisiert werden (damit man weiß was angehakt ist und was nicht) (siehe unten)
/* Geht mit Cookies.set('products_bought',[false, false, false, false]);*/

// selektieren aller Elemente die Checkboxen haben

/*
$("[data-product-id]").each(function (index, produt) {
    let element = $(this);

    if (element.attr("data-product-id") == 6) {
        element.find("input.form-check-input").prop("checked", true);
    }
});

$("input.form-check-input").each(function (index, input) {
    if ($(input).attr("id") == "product-" + 2) {
        $(input).prop("checked", true);
    }
});
*/

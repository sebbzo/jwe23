const PRODUCT_DATA = {
    id: 234,
    artNo: 348975,
    title: "Ed Hardy Mustang Feaver Nature",
    variants: {
        sizes: ["XS", "SM", "M", "L", "XL", "XXL"],
        colors: ["black", "navy", "olive", "brown"],
    },
    price: 79.9,
    productImage: "img/ed-hardy.jpg",
    description:
        "Hier wird der Artikel in kurzen Worten beschrieben und die Einzigartigkeit aufgezeigt.",
};

document.querySelector("#art-no").innerHTML = PRODUCT_DATA.artNo;
document.querySelector("#art-text").innerHTML = PRODUCT_DATA.description;

document.querySelector("#art-title").innerHTML = PRODUCT_DATA.title;

document
    .querySelector("#art-img")
    .setAttribute("src", PRODUCT_DATA.productImage);

document.querySelector("#art-price").innerHTML =
    "€ " + PRODUCT_DATA.price.toFixed(2).toString().replace(".", ",");
/* Das oben ist ein Statement oder Ausdruck*/

let htmlOutput = "";
PRODUCT_DATA.variants.sizes.forEach((size) => {
    htmlOutput += `<option value="${size}">${size}</option>`;
});

document.querySelector("#prod-size").innerHTML = htmlOutput;

htmlOutput = "";
PRODUCT_DATA.variants.colors.forEach((color) => {
    htmlOutput += `<option value="${color}">${color}</option>`;
});

document.querySelector("#prod-color").innerHTML = htmlOutput;

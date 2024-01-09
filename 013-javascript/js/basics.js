let myVariable;

myVariable = "Dienstag";

const MY_CONST = 5;

console.log(myVariable);
console.log(MY_CONST);

let myArray = ["Milch", "Zucker"];
console.log(myArray[0]);

myArray[0] = "Bier";
console.log(myArray[0]);

const MY_ARRAY2 = ["Butter", "Honig", "Brot"];
MY_ARRAY2[0] = "Senf";
MY_ARRAY2[3] = "Majo";
console.log(MY_ARRAY2);

let myObject = {
    name: "Sebastian",
    alter: 36,
    languages: ["Deutsch", "Französisch"],
    greet: function () {
        window.alert("Hi!");
    },
};
console.log(myObject.name);

let myCart = [
    {
        anr: "0123123",
        title: "Tasse",
        price: 1.5,
        amount: 25,
        deleteProduct: function () {},
        variants: {
            sizes: ["S", "M", "L"],
            colors: ["green", "yellow"],
        },
    },

    {
        anr: "0123123",
        title: "Heferl",
        price: 2.5,
        amount: 13,
    },
];

console.log(myCart[0].variants.sizes[2]);

const PRODUCT_DATA = {
    id: 234,
    artNo: 348975,
    title: "Ed Hardy Mustang Feaver Nature",
    variants: {
        sizes: ["XS", "SM", "M", "L", "XL", "XXL"],
        colors: ["black", "navy", "olive", "brown"],
    },
    price: 79.9,
    productImage: "ProductImage123.jpg",
};

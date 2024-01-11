let htmlOutput = "";

for (let i = 1; i < 9; i++) {
    htmlOutput +=
        '<a href="img/full/' +
        i +
        '.jpg" data-fancybox="gallery"> <img src="img/thumbs/' +
        i +
        '.jpg" /></a>';
}

document.querySelector("#gallery").innerHTML = htmlOutput;

Fancybox.bind("[data-fancybox]", {
    // Your custom options
});

let myInterval = window.setInterval(function () {
    console.log("check");
    const ticketSaleStart = new Date("2024-01-11T20:34:20");
    const now = new Date();

    console.log(now >= ticketSaleStart);
    console.log(new Date().getSeconds());

    if (now >= ticketSaleStart) {
        /* document.querySelector("#tickets").style.display = "block"; */
        $("#tickets").slideDown();
        clearInterval(myInterval);
    } else {
        $("#tickets").hide();
    }
}, 300);

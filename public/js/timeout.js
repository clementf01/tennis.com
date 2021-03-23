/*fonction permettant les messages "flash" de confirmation */
(function() {

    setTimeout(() => {
        let k = document.querySelector(".alerte-message");
        // console.log(k);
        if (k !== null)
            k.style.display = "none"

    }, 3000);
})();
(function() {

    setTimeout(() => {
        let k = document.querySelector(".alerte-confirmation");
        // console.log(k);
        if (k !== null)
            k.style.display = "none"

    }, 3000);
})();
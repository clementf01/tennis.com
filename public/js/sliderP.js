'use strict'; // Mode strict du JavaScript

/* déclaration des images composant le slider */



function presentation() {


    let slides = document.getElementsByClassName("slideP");

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = " none";
    }

    indice = indice + 1;
    if (indice > slides.length) {
        indice = 1;

    }

    if (slides[indice - 1] != undefined)
        slides[indice - 1].style.display = "block";

    setTimeout(presentation, 3000); /* délai de 3 secondes par image */
}
presentation();
'use strict'; // Mode strict du JavaScript

/* déclaration des images composant le slider */
var index = 0;
show();

function show() {
    var i;
    var slides = document.getElementsByClassName("slideP");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = " none";
    }

    index = index + 1;
    if (index > slides.length) {
        index = 1;

    }


    slides[index - 1].style.display = "block";

    setTimeout(show, 3000); /* délai de 3 secondes par image */
}
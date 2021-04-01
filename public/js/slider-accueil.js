'use strict'; // Mode strict du JavaScript

/* déclaration des images composant le slider */

show();

function show() {

    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByTagName("span");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = " none";
    }

    index = index + 1;
    if (index > slides.length) {
        index = 1;

    }

    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace("active", "");
    }
    if (slides[index - 1] != undefined) {
        slides[index - 1].style.display = "block";
        dots[index - 1].className += "active";
    }


    setTimeout(show, 5000); /* délai de 5 secondes par image*/
}
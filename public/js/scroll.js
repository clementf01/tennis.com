/* fonction js du bouton de retour vers le haut de page */

var btn = document.querySelector('.btn'); /* création de la constante bouton */
/* on déclenche l'action au click sur le bouton */
btn.addEventListener('click', () => {
    window.scrollTo({ /* utilisation d'une fonction de windows afin de faire revenir au haut à gauche de la page */
        top: 0,
        left: 0,
        behavior: "smooth",
        /* on veut que le retour se fasse de façon douce, et pas un retour "sec" vers le haut donc on utilise la fonction "smooth" */
    })
})
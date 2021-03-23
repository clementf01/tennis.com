/* déclaration des variables */

var content = document.querySelector('#hamburger-content');
var sidebarBody = document.querySelector('#hamburger-sidebar-body');
var button = document.querySelector('#hamburger-button');
var overlay = document.querySelector('#hamburger-overlay');
var activatedClass = 'hamburger-activated';

sidebarBody.innerHTML = content.innerHTML;


/* gestion de l'événement pour faire apparaître la sidebar */
button.addEventListener('click', function(e) {
    e.preventDefault();

    this.parentNode.classList.add(activatedClass);
});

/* gestion de l'événement pour faire disparaître la sidebar */
overlay.addEventListener('click', function(e) {
    e.preventDefault();

    this.parentNode.classList.remove(activatedClass);
});


/* gestion de l'événement pour faire disparaître la sidebar à partir du clavier */
button.addEventListener('keydown', function(e) {
    if (this.parentNode.classList.contains(activatedClass)) {
        if (e.repeat === false && e.which === 27) //code 27->code de la touche "echappe"
            this.parentNode.classList.remove(activatedClass);
    }
});
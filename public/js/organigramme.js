 function viewImage(id) {
     let contenuImage = !afficher ? "<img src='public/images/organigramme02.jpg' alt='organigramme TC thonon'>" : ""; //en fonction de afficher on met l'image ou non
     afficher = !afficher;
     let contenuBouton = afficher ? "Cacher l'organigramme" : "Afficher l'organigramme"; //On met un texte correspondant à l'action souhaité sur le bouton

     document.getElementById(id).innerHTML = contenuImage;
     document.getElementById("bouton").innerHTML = contenuBouton;
 }
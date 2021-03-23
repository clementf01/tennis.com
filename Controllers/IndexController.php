<?php

namespace Controllers;


class IndexController extends AbstractController
{
    /*@method home
    *rend la page accueil
    *@return string
    */
    public function home()
    {
        $this->render("layout.phtml", "index");
    }
    /*@method actualite
    *rend la page actualite
    *@return string
    */
    public function actualite()
    {
        $this->render("layout.phtml", "actualite");
    }
    /*@method presentation
    *rend la page presentation
    *@return string
    */
    public function presentation()
    {
        $this->render("layout.phtml", "presentation");
    }
    /*@method ecole
    *rend la page ecole
    *@return string
    */
    public function ecole()
    {
        $this->render("layout.phtml", "ecole");
    }
    /*@method adhesion
    *rend la page adhesion
    *@return string
    */
    public function adhesion()
    {
        $this->render("layout.phtml", "adhesion");
    }
    /*@method contact
    *rend la page contact
    *@return string
    */
    public function contact()
    {
        $this->render("layout.phtml", "contact");
    }
    /*@method blog
    *rend la page connexion
    *@return string
    */
    public function erreur404()
    {
        $this->render("erreur_layout.phtml", "");
    }
}

<?php

namespace Models\Entity;

use DateTime;

class Articles extends Entity
{
    protected $titre = null;
    protected $contenu = null;
    protected $date_creation = null;
    protected $id_membre = null;
    //recuperation des infos utilisateur grâce aux getter et setter et hydratation du tableau grâce à la fonction hydrate
    public function __construct(array $tab = null)
    {
        $this->date_creation = new \DateTime();
        if ($tab !== null || count($tab) > 0) {
            $this->hydrate($tab);
        }
    }
    public function hydrate(array $tab)
    {
        foreach ($tab as $el => $c) {
            $methode = "set" . ucfirst($el);

            if (method_exists($this, $methode)) {

                $this->$methode($c);
            }
        }
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($v)
    {
        $this->titre = $v;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function setContenu($v)
    {
        $this->contenu = $v;
    }
    public function getDate_creation()
    {
        return $this->date_creation->format("Y-m-d h:m:s");
    }
    public function setDate_creation($v)
    {
        $this->date_creation = $v;
    }
    public function getId_membre()
    {
        return $this->id_membre;
    }
    public function setId_membre($v)
    {
        $this->id_membre = $v;
    }
}

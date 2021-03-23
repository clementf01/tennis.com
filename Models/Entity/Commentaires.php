<?php

namespace Models\Entity;

class Commentaires extends Entity
{
    protected $pseudo = null;
    protected $contenu = null;
    protected $id_article = null;
    protected $id_membre = null;
    //recuperation des infos utilisateur grâce aux getter et setter et hydratation du tableau grâce à la fonction hydrate
    public function __construct(array $tab = null)
    {
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

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($v)
    {
        $this->pseudo = $v;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function setContenu($v)
    {
        $this->contenu = $v;
    }
    public function getId_article()
    {
        return $this->id_article;
    }
    public function setId_article($v)
    {
        $this->id_article = $v;
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

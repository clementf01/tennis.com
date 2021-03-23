<?php

namespace Models\Entity;

class Membres extends Entity
{
    protected $pseudo = "";
    protected $mail = "";
    protected $motdepasse = "";
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
    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($v)
    {
        $this->mail = $v;
    }
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }
    public function setMotdepasse($v)
    {
        $this->motdepasse = $v;
    }
}

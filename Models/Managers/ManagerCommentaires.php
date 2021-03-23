<?php

namespace Models\Managers;

use Models\ManagersInterface\ManagerInterface;
use Models\Entity\Entity;
use Models\Entity\Commentaires;

class ManagerCommentaires implements ManagerInterface
{
    protected $db = null;
    public function __construct(\PDO $el)
    {
        $this->db = $el;
    }
    public function fetchByOne(array $criteria)
    //recuperation d'un commentaire
    {
        if ($criteria === null) return null;
        $q = "SELECT * FROM commentaires WHERE " . key($criteria) . "=?";
        $r = $this->db->prepare($q);
        $r->execute([$criteria[key($criteria)]]);
        $result = $r->fetch();
        // $r->closeCursor();
        return $result;
    }
    public function create(Entity $p)
    //création d'un commentaire en bdd par requête préparée et en fonction de l'ID de l'article auquel il se rapporte, en fonction des infos reçues du formulaire des commentaires
    {
        $q = "INSERT INTO commentaires(pseudo, contenu, id_article, id_membre) VALUES(:p, :c, :i, :j)";
        $r = $this->db->prepare($q);
        $r->execute([
            "p" => $p->getPseudo(), "c" => $p->getContenu(), "i" => $p->getId_article(), "j" => $p->getId_membre()
        ]);
    }
    public function fetchAll()
    //récupération des commentaires dans la table commentaires de la bdd 
    {
        $tab = [];
        $q = "SELECT * FROM commentaires";
        $r = $this->db->query($q);
        while ($d = $r->fetch(\PDO::FETCH_ASSOC)) {
            $a = new Commentaires($d);
            $tab[] = $a;
        }
        return $tab;
    }
    public function update(Entity  $p)
    //mise à jour du commentaire dans la bdd, en fonction des infos reçues du formulaire des commentaires
    {
        $q = "UPDATE commentaires SET pseudo=:p, contenu=:c, id_article=:i WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["p" => $p->getPseudo(), "c" => $p->getContenu(), "i" => $p->getId_article(), "id" => $p->getId()]);
    }
    public function delete(Entity $p)
    //suppression des commentaires en bdd
    {
        $q = "DELETE FROM commentaires WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["id" => $p->getId()]);
    }
}

<?php

namespace Models\Managers;

use Models\ManagersInterface\ManagerInterface;
use Models\DAO\Dao;
use Models\Entity\Entity;
use Models\Entity\Membres;

class ManagerMembres implements ManagerInterface
{
    protected $db = null;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
    public function fetchByOne(array $criteria)
    {
        if ($criteria === null) return null;
        $q = "SELECT * FROM membres WHERE " . key($criteria) . "=?";
        $r = $this->db->prepare($q);
        $r->execute([$criteria[key($criteria)]]);
        $result = $r->fetch();
        return $result;
    }
    public function create(Entity $p)
    //insertion des informations du nouveau membre dans la base de données (requête préparée), en fonction des infos reçues du formulaire d'inscription
    {
        $q = "INSERT INTO membres(pseudo, mail, motdepasse) VALUES(:p, :m, :mdp)";
        $r = $this->db->prepare($q);
        $r->execute([
            "p" => $p->getPseudo(), "m" => $p->getMail(), "mdp" => $p->getMotdepasse()
        ]);
    }
    public function fetchAll()
    //récupération des données relatives à 1 membre dans la base de données
    {
        $tab = [];
        $q = "SELECT * FROM membres";
        $r = $this->db->query($q);
        while ($d = $r->fetch(\PDO::FETCH_ASSOC)) {
            $a = new Membres($d);
            $tab[] = $a;
        }
        return $tab;
    }

    public function update(Entity  $p)
    //mise à jour des données d'1 membre dans la bdd en fonction de son ID
    {
        $q = "UPDATE membres SET pseudo=:p, mail=:m, motdepasse=:mdp WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["p" => $p->getPseudo(), "m" => $p->getMail(), "mdp" => $p->getMotdepasse(), "id" => $p->getId()]);
    }

    public function delete(Entity $p)
    //suppression d'1 membre dans la bdd en fonction de son ID
    {
        $q = "DELETE FROM membres WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["id" => $p->getId()]);
    }
}

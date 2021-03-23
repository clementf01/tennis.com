<?php

namespace Models\Managers;

use Models\ManagersInterface\ManagerInterface;
use Models\Entity\Entity;
use Models\Entity\Articles;

class ManagerArticles implements ManagerInterface
{
    protected $db = null;
    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
    public function fetchByOne(array $criteria)
    {
        if ($criteria === null) return null;
        $q = "SELECT * FROM articles WHERE " . key($criteria) . "=?";
        $r = $this->db->prepare($q);
        $r->execute([$criteria[key($criteria)]]);
        $result = $r->fetch();
        return $result;
    }
    public function create(Entity $p)
    // création d'un article dans bdd avec requête préparée, en fonction des infos reçues du formulaire article
    {
        $q = "INSERT INTO articles(titre, contenu, date_creation, id_membre) VALUES(:t, :c, :d, :r)";
        $r = $this->db->prepare($q);
        $r->execute([
            "t" => $p->getTitre(), "c" => $p->getContenu(), "d" => $p->getDate_creation(), "r" => $p->getId_membre()
        ]);
    }
    public function fetchAll()
    //récupération de tous les articles dans la table articles de la bdd
    {
        $tab = [];
        $q = "SELECT * FROM articles";
        $r = $this->db->query($q);
        while ($d = $r->fetch(\PDO::FETCH_ASSOC)) {
            $a = new Articles($d);
            $tab[] = $a;
        }
        return $tab;
    }
    public function update(Entity  $p)
    //mise à jour d'un article dans la bdd avec requête préparée, en fonction des infos reçues du formulaire article
    {
        $q = "UPDATE articles SET titre=:t, contenu=:c, date_creation=:d WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["t" => $p->getTitre(), "c" => $p->getContenu(), "d" => $p->getDate_creation(), "id" => $p->getId()]);
    }
    public function delete(Entity $p)
    //suppression en bdd de l'article sélectionné par son ID 
    {
        $q = "DELETE FROM articles WHERE id=:id";
        $r = $this->db->prepare($q);
        $r->execute(["id" => $p->getId()]);
    }
}

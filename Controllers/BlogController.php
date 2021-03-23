<?php

namespace Controllers;

use Exception;
use Models\Entity\Articles;
use Models\DAO\Dao;
use Models\Entity\Commentaires;
use Models\Entity\Membres;
use Models\Managers\ManagerArticles;
use Models\Managers\ManagerCommentaires;
use Models\Managers\ManagerMembres;

class BlogController extends AbstractController
{
    //verifie si les clés passées dans le tableau existent
    public function isset(array $tab, array $target): bool
    {
        $retour = true;
        for ($i = 0; $i < count($target); $i++) {
            if (!key_exists($target[$i], $tab)) {
                $retour = false;
                break;
            }
        }
        return $retour;
    }
    /*@method booleen isEmpty()
    *globalise la fonction !empty en php afin de vérifier si le tableau est vide ou non
    *@return bool
    */
    public function isEmpty(array $tab, array $cles): bool
    {
        $retour = false;
        for ($i = 0; $i < count($cles); $i++) {
            if (empty($tab[$cles[$i]])) {
                $retour = true;
                break;
            }
        }
        return $retour;
    }
    public function blog()
    {
        $pdo = Dao::getConnection();
        $m = new ManagerArticles($pdo);
        $articles = [];
        if (!isset($_SESSION['id']) or $_SESSION['id'] == false) {
            $this->redirection("index.php?page=connexion");
        }
        /* récupération des 10 derniers articles */
        $tab = [];
        $articles = $m->fetchAll();
        if (count($articles) > 1) {
            if (count($articles) > 10)
                for ($i = count($articles) - 1; $i > count($articles) - 11; $i--) {
                    $tab[] = $articles[$i];
                }
            else $tab = $articles;
            $this->render("bloglayout.phtml", "blogindex", ["articles" => $tab]);
        } else $this->redirection("index.php?page=add_billet");
    }
    public function connexion()
    {
        if (isset($_SESSION["user"]))
            $this->redirection("index.php?page=profil");
        $this->render("bloglayout.phtml", "connexion");
    }
    public function deconnexion()
    /*fonction de deconnexion avec session_destroy*/
    {
        session_destroy();
        $this->redirection("index.php?page=connexion");
    }
    /*@method signup
    *rend la page signup
    *@return string
    */
    public function signup()
    {
        if (isset($_SESSION["user"]))
            $this->redirection("index.php?page=profil");
        $this->render("bloglayout.phtml", "signup");
    }
    /*@method home
    *vérifie que les infos envoyées correpondent aus infos de la bdd
    *rend la page connexion
    *@return string
    */
    public function checkCredentials(array $post)
    {
        if (isset($_SESSION["user"]))
            $this->redirection("index.php?page=profil");
        $pdo = Dao::getConnection();
        $m = new ManagerMembres($pdo);
        if (isset($post['formconnexion'])) {
            $mailconnect = htmlspecialchars($post['mailconnect']);
            $mdpconnect = ($post['mdpconnect']);
            $hash = password_hash($mdpconnect, PASSWORD_DEFAULT, ['cost' => 12]);
            /* on vérifie si les mails et mot de passe existent dans la table membres de la bdd */
            if (!empty($mailconnect) && !empty($mdpconnect)) {
                $r = $m->fetchByOne(["mail" => $mailconnect]);
                $pwd = $r['motdepasse'];
                if (password_verify($mdpconnect, $pwd)) {
                    $_SESSION['id'] = $r['id'];
                    $_SESSION['pseudo'] = $r['pseudo'];
                    $_SESSION['mail'] = $r['mail'];
                    $_SESSION['is_admin'] = $r['is_admin'];
                    $_SESSION['user'] = serialize($r);
                    $this->redirection("index.php?page=profil");
                } else $erreur = "Mail ou mot de passe incorrect !";
            } else {
                $erreur = "Tous les champs doivent être complétés !";
            }
        }
        $this->render("bloglayout.phtml", "connexion");
    }
    /*@method profil
    *rend la page profil
    *@return string
    */
    public function profil()
    {
        $this->render("bloglayout.phtml", "profil");
    }
    /*@method addBillet
    *rend la page addBillet
    *@return string
    */
    public function addBillet()
    {
        $this->render("bloglayout.phtml", "add_billet");
    }
    /*@method createArticle
    *rend la page createArticle
    *@return string
    */
    public function createArticle(array $post)
    {
        $pdo = Dao::getConnection();
        $m = new ManagerArticles($pdo);
        $user = unserialize($_SESSION["user"]);
        // var_dump($post);
        if (!empty($post['article_titre']) && !empty($post['article_contenu'])) {
            /* on securise les données */
            $post['titre'] = htmlspecialchars($post['article_titre']);
            $post['contenu'] = htmlspecialchars($post['article_contenu']);
            /* on insert les données postées par l'utilisateur dans la bdd */
            $a = new Articles($post);
            $a->setId_membre($user["id"]);
            // var_dump($a);
            $m->create($a);
            $message = 'Votre article a bien été posté';
            $this->redirection("index.php?page=blogindex");
        } else {
            // var_dump($user);
            $message = 'Veuillez remplir tous les champs';
            $this->render("bloglayout.phtml", "add_billet");
        }
    }
    /*@method showArticle
    *rend la page showArticle
    *@return string
    */
    public function showArticle(int $id)
    //récupération de l'article séléctionné par l'utilisateur avec fetchByOne, ainsi que les commentaires qui lui sont associés avec fetchAll
    {
        $dao = Dao::getConnection();
        $m = new ManagerArticles($dao);
        $mc = new ManagerCommentaires($dao);
        $a = $m->fetchByOne(["id" => $id]);
        $tab = $mc->fetchAll();
        $comments = [];
        foreach ($tab as $el) {
            if ($el->getId_article() == $id)
                $comments[] = $el;
        }

        $this->render("bloglayout.phtml", "show_article", ["article" => $a, "comments" => $comments]);
    }
    /*@method formCommentaire
    *rend la page add_commentaire
    *@return string
    */
    public function formCommentaire($id)
    {
        $pdo = Dao::getConnection();
        $m = new ManagerArticles($pdo);
        $a = $m->fetchByOne(["id" => $id]);
        $this->render("bloglayout.phtml", "add_commentaire", ["article" => $a]);
    }
    /*@method createComment
    *on vérifie que le formulaire ne soit pas vide
    *création d'un commentaire en fonction de l'ID de l'article auquel il se rapporte
    *rend la page show_article
    *@return string
    */
    public function createComment(array $post)
    {
        $user = unserialize($_SESSION["user"]);
        if (isset($post["contenu"]) && isset($post["id_article"]) && isset($post["pseudo"])) {
            // var_dump($post);
            if (!empty($post["contenu"]) && !empty($post["pseudo"])) {
                // var_dump($post);
                $post["contenu"] = htmlspecialchars($post["contenu"]);
                $post["pseudo"] = htmlspecialchars($post["pseudo"]);
                $commentaire = new Commentaires($post);
                $commentaire->setId_membre($user["id"]);
                $pdo = Dao::getConnection();
                $m = new ManagerCommentaires($pdo);
                $m->create($commentaire);
                $this->redirection("index.php?page=show_article&id=" . $post["id_article"]);
            } else
                $this->redirection("index.php?page=add_commentaire&id=" . $post["id_article"]);
        }
    }
    /*@method removeArticle
    suppression d'un article sélectionné (fetchByOne)-uniquement par ADMIN-
    *on supprime aussi TOUS (fetchAll) les commentaires qui lui sont associés
    *utilisation de "rollBack" pour effectuer l'intégralité de la suppression et non juste une partie (article effacé mais pas les commentaires en cas de coupure de courant par exemple)
    */
    public function removeArticle($id)

    {
        $pdo = Dao::getConnection();
        try {
            $pdo->beginTransaction();
            $m = new ManagerArticles($pdo);
            $a = $m->fetchByOne(["id" => $id]);
            $a = new Articles($a);
            $m->delete($a);
            $mc = new ManagerCommentaires($pdo);
            $tabc = $mc->fetchAll();
            foreach ($tabc as $el) {
                if ($el->getId_article() == (int)$id) {
                    $mc->delete($el);
                }
            }

            $pdo->commit();
            $this->redirection("index.php?page=blogindex");
        } catch (Exception $e) {
            $pdo->rollBack();
            $this->redirection("index.php?page=blogindex");

            $e->getMessage();
        }
    }
    /*@method createMember
    *récupération des infos du formulaire, sécurisation du mot de passe en password_hash
    *message flash de bonne création du compte, sinon réorientation vers page signup
    *@return string
    */
    public function createMember(array $post)
    {
        $pdo = Dao::getConnection();
        $mm = new ManagerMembres($pdo);
        if ($this->isset($post, ["pseudo", "mail", "mail2", "motdepasse", "motdepasse2"])) {
            if ($this->isEmpty($post, ["pseudo", "mail", "mail2", "motdepasse", "motdepasse2"]) == false) {
                if ($post["motdepasse"] === $post["motdepasse2"] && $post["mail"] === $post["mail2"]) {
                    $m = new Membres($post);
                    $m->setMotdepasse(password_hash($m->getMotdepasse(), PASSWORD_DEFAULT, ['cost' => 12]));
                    $mm->create($m);
                    $_SESSION["confirmation"] = "Votre compte a été crée avec succes";
                    $this->redirection("index.php?page=blogindex");
                }
            }
        } else {
            $this->redirection("index.php?page=signup");
        }
    }
    /*@method editProfil
    *rend la page editProfil
    *@return string
    */
    public function editProfil()
    {
        $user = unserialize($_SESSION["user"]);
        $this->render("bloglayout.phtml", "editionprofil", ["user" => $user]);
    }
    /*@method createModif
    *modification dans la bdd des infos du membre connecté
    *récupération des données enregistrées en bdd, puis récupération des nouvelles données en provenance du form
    *sécurisation des données avec password_hash  
    *rend la page profil
    *@return string
    */
    public function createModif(array $post)
    {
        $pdo = Dao::getConnection();
        $mm = new ManagerMembres($pdo);
        if ($this->isset($post, ["pseudo", "mail", "motdepasse", "motdepasse2"])) {
            if ($this->isEmpty($post, ["pseudo", "mail", "motdepasse", "motdepasse2"]) == false) {
                if ($post["motdepasse"] === $post["motdepasse2"]) {
                    $m = $mm->fetchByOne(["id" => $post["id"]]);
                    $me = new Membres($m);
                    $me->setMail($post["mail"]);
                    $me->setMotdepasse(password_hash($post["motdepasse"], PASSWORD_DEFAULT, ['cost' => 12]));
                    $me->setPseudo($post["pseudo"]);
                    $mm->update($me);
                    $me = $mm->fetchByOne(["id" => $post["id"]]);
                    $_SESSION["user"] = serialize($me);
                    $_SESSION["confirmation"] = "Modifications effectuées avec succès";
                    $this->redirection("index.php?page=profil");
                }
            }

            // $this->redirection("index.php?page=editionprofil");
        } else {
            $_SESSION["message_error"] = "Veuillez remplir tous les champs!";
            $this->redirection("index.php?page=editionprofil");
        }
    }
}

<?php

include_once "config/auto_loader.php";
session_start();

use Controllers\IndexController;
use Controllers\BlogController;

$c = new IndexController();
$b = new BlogController();
if (preg_match("#\/tennis.com\/$#", $_SERVER["REQUEST_URI"]) || (isset($_GET["page"]) && ($_GET["page"] == "home"))) {
    $c->home();
} elseif (isset($_GET["page"]) && $_GET["page"] == "actualite") {
    $c->actualite();
} elseif (isset($_GET["page"]) && $_GET["page"] == "presentation") {
    $c->presentation();
} elseif (isset($_GET["page"]) && $_GET["page"] == "ecole") {
    $c->ecole();
} elseif (isset($_GET["page"]) && $_GET["page"] == "adhesion") {
    $c->adhesion();
} elseif (isset($_GET["page"]) && $_GET["page"] == "contact") {
    $c->contact();
} elseif (isset($_GET["page"]) && $_GET["page"] == "blogindex") {
    $b->blog();
} elseif (isset($_GET["page"]) && $_GET["page"] == "connexion") {
    $b->connexion();
} elseif (isset($_GET["page"]) && $_GET["page"] == "deconnexion") {
    $b->deconnexion();
} elseif (isset($_GET["page"]) && $_GET["page"] == "signup") {
    $b->signup();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $b->checkCredentials($_POST);
} elseif (isset($_GET["page"]) && $_GET["page"] == "profil") {
    $b->profil();
} elseif (isset($_GET["page"]) && $_GET["page"] == "add_billet") {
    $b->addBillet();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addArticle"])) {
    $b->createArticle($_POST);
} elseif (isset($_GET["page"]) && $_GET["page"] == "show_article") {
    $b->showArticle($_GET["id"]);
} elseif (isset($_GET["page"]) && $_GET["page"] == "add_commentaire") {

    $b->formCommentaire($_GET["id"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_commentaire"])) {
    $b->createComment($_POST);
} elseif (isset($_GET["page"]) && $_GET["page"] == "supprimer") {

    $b->removeArticle($_GET["id"]);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registering"])) {
    $b->createMember($_POST);
} elseif (isset($_GET["page"]) && $_GET["page"] == "editionprofil") {
    $b->editProfil();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modif"])) {
    $b->createModif($_POST);
} else $c->erreur404();

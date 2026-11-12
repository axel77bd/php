<?php
session_start();

// __DIR__ = le dossier public : les chemins fonctionnent quel que soit l'endroit d'où le site est lancé
require_once __DIR__ . '/../db/mariadb.php';
require_once __DIR__ . '/../classes/class_article.php';
require_once __DIR__ . '/../classes/class_user.php';
require_once __DIR__ . '/../classes/class_categorie.php';
require_once __DIR__ . '/../classes/class_commentaire.php';
require_once __DIR__ . '/../classes/class_contact.php';
require_once __DIR__ . '/../fonctions/fonctions.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);
// la variable "session" est disponible dans tous les templates (menu connexion / déconnexion)
$twig->addGlobal('session', $_SESSION);

// dossier dans lequel on enregistre les images envoyées
$dossierImages = __DIR__ . '/images/';

// $messages contient les messages à afficher à l'utilisateur (erreurs, confirmations).
// Les pages n'écrivent plus de HTML avec echo : elles ajoutent un message ici
// et c'est le template base.html.twig qui les affiche.
$messages = [];
// on récupère les messages enregistrés avant une redirection (voir la fonction rediriger)
if (isset($_SESSION['flash'])) {
    $messages = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

// Si la connexion à la base de données fonctionne alors
if ($dbh != null) {
    //verifie si il existe la cle 'page' dans le tableau $_GET
    if (isset($_GET['page'])) {
        //recupere la valeur qui correspond a la cle dans $_GET
        $page = $_GET['page'];
    } else {
        // si la cle 'page' n'existe pas nous irons  sur la page'home'
        $page = 'home';
    }
    // le nom de la page ne doit contenir que des lettres, chiffres ou _
    // (empêche d'appeler un fichier en dehors du dossier pages avec ../)
    // et le fichier php de la page doit exister
    if (preg_match('/^[a-zA-Z0-9_]+$/', $page) && file_exists(__DIR__ . '/../pages/' . $page . '.php')) {
        // on l'appelle
        require_once __DIR__ . '/../pages/' . $page . '.php';
    } else {
        // sinon appelle la page 'error404.php'
        require_once __DIR__ . '/../pages/error404.php';
    }
} else {
    // Si la base de données n’est pas connectée alors
    require_once __DIR__ . '/../pages/maintenance.php';
}

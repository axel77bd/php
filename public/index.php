<?php 
session_start();
    // une fonction qui permet d'afficher le contenu d'une variable y compris les tableaux 
    //var_dump($_GET);
    //require_once '../pages/header.php';
    require_once '../db/mariadb.php';
    require_once '../classes/class_article.php';
    require_once '../classes/class_user.php';
    require_once '../classes/class_categorie.php';
    require_once '../classes/class_commentaire.php';
    require_once '../classes/class_contact.php';
    require_once '../vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader('../templates');
    $twig = new Environment($loader);
    
?>
<?php
// Si la connexion à la base de données fonctionne alors
if($dbh!=null){


//verifie si il existe la cle 'page' dans le tableau $_GET
    if(isset($_GET['page'])){
        //recupere la valeur qui correspond a la cle dans $_GET
        $page=$_GET['page'];
    }
    else{
        // si la cle 'page' n'existe pas nous irons  sur la page'home'
        $page='home';
    }
    //  si le fichier php de la page existe 
    if(file_exists('../pages/'.$page.'.php')){
        // on l'appelle 
        require_once '../pages/'.$page.'.php';
    }
    else{
        // sinon appelle la page 'error404.php'
        require_once '../pages/error404.php';
    }
}else{
    // Si la base de données n’est pas connectée alors
    require_once '../pages/maintenance.php';
} 
     
?>

<?php   
   // require_once '../pages/footer.php';
?>
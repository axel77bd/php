<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mon super site en php</title>
    <link href="https://bootswatch.com/5/brite/bootstrap.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="index.php?page=contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=article">Article</a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=commentaire">commentaire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=ajout_categorie">ajout_categorie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=""></a>
        </li>
        <?php
//si on est connectés,si la clé login existe dans le tableau $_SESSION
if (isset($_SESSION['login'])) {
    //$email reçoit la valeur stockée dans le tableau
    $email = $_SESSION['login'];
    
// on affiche du html pour inclure l'adresse email dans la navbar

    echo '<li class="nav-item">
    <a class="nav-link" href="index.php?page=profil"><i class="bi bi-person-circle me-1"></i>
          ' . $email . '
          </a>
        </li>';
    echo '<li class="nav-item">
          <a class="nav-link " href="index.php?page=deco">se déconnecter</a>
        </li>';
} else {
    echo '<li class="nav-item">
        <a class="nav-link" href="index.php?page=connexion">Connexion</a>
      </li>';
    echo '<li class="nav-item">
          <a class="nav-link" href="index.php?page=signup">S\'inscrire</a>
        </li>';
}
?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php?page=listearticle">liste article</a>
            <a class="dropdown-item" href="index.php?page=listeutilisateurs">liste utilisateurs</a>
            <a class="dropdown-item" href="index.php?page=listedescategorie">listedescategorie</a>
            <a class="dropdown-item" href="index.php?page=listecontact">liste contact</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      </ul>

    </div>
  </div>
</nav>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mon super site en php</title>
    <link href="https://bootswatch.com/5/brite/bootstrap.min.css" rel="stylesheet" >
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
          <a class="nav-link" href="index.php?page=signup">S'inscrire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=connexion">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=article">Article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=listearticle">ListeArticles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=listecontact">ListeContat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=listeutilisateurs">Liste Utlisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=commentaire">commentaire</a>
        </li>
        <?php
        if(isset($_SESSION['login'])){
          $email=$_SESSION['login'];
        
        echo '<li class="nav-item">
          <a class="nav-link" href="">'.$email.'</a>
        </li>';}
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
<div class="container text-center">
  <div class="row align-items-start">
   
   
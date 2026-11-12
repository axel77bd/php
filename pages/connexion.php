<?php
if (isset($_POST['valider'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $messages[] = "veuillez saisir un email";
    }
    if (empty($password)) {
        $messages[] = "veuillez saisir un mot de passe";
    }
    // si l'email et le mot passe sont saisis
    if (!empty($email) && !empty($password)) {
        $co = new User($dbh);
        $row = $co->connexion($email);
        // si la ligne est vide c'est que l'utlisateur n'existe pas
        if ($row && password_verify($password, $row['password'])) {
            // la connexion a reussie et nous stockons l'email de la personne dans  $_SESSION  en créant  la clé  login
            $_SESSION['login'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['id'];
            rediriger('index.php');
        } else {
            $messages[] = "il y a un problème d'identifiant";
        }
    }
}

echo $twig->render('connexion.html.twig', ['messages' => $messages]);

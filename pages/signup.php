<?php
// les valeurs saisies sont renvoyées au template pour re-remplir le formulaire en cas d'erreur
$email = '';
$name = '';
$prenom = '';

if (isset($_POST['valider'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $valide = true;

    if (empty($email)) {
        $messages[] = "veuillez saisir un email";
        $valide = false;
    } else {
        // on vérifie que l'email n'est pas déjà utilisé
        $selectE = new User($dbh);
        if ($selectE->selectEmail($email)) {
            $messages[] = 'email déjà utilisé';
            $valide = false;
        }
    }
    if (empty($password)) {
        $messages[] = "veuillez saisir un mot de passe";
        $valide = false;
    }
    if (empty($name)) {
        $messages[] = "veuillez saisir votre nom";
        $valide = false;
    }
    if (empty($prenom)) {
        $messages[] = "veuillez saisir votre prenom";
        $valide = false;
    }
    if (empty($_POST['radio'])) {
        $messages[] = "veuillez choisir un genre";
        $valide = false;
    }
    // on protege l'inscription en vérifiant que les données sont valides
    if ($valide) {
        $insertU = new User($dbh);
        // si l'insertion retourne vrai alors l'inscription est réussie
        if ($insertU->insert($name, $prenom, $email, $password)) {
            rediriger('index.php?page=connexion', 'inscription réussie, vous pouvez vous connecter');
        } else {
            $messages[] = "echec de l'inscription";
        }
    }
}

echo $twig->render('signup.html.twig', [
    'messages' => $messages,
    'email' => $email,
    'name' => $name,
    'prenom' => $prenom,
]);

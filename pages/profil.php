<?php
if (!isset($_SESSION['login'])) {
    $messages[] = "vous n'avez pas les droits";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $co = new User($dbh);
    // on récupère les informations de l'utilisateur connecté grâce à son email
    $row = $co->connexion($_SESSION['login']);
    if (!$row) {
        $messages[] = "il y a un problème d'identifiant";
        echo $twig->render('message.html.twig', ['messages' => $messages]);
    } else {
        // Formulaire pour modifier le mot de passe
        if (isset($_POST['modifier'])) {
            $password = $_POST['password'];
            if (empty($password)) {
                $messages[] = 'saisir le mot de passe';
            } elseif ($password != $_POST['confirmation']) {
                $messages[] = 'les mots de passe ne sont pas identiques';
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                if ($co->upPass($password)) {
                    $messages[] = "mot de passe modifié";
                } else {
                    $messages[] = "echec de la modification";
                }
            }
        }
        // Fin Formulaire pour modifier le mot de passe

        //formulaire pour modifier  l'email
        if (isset($_POST['envoyer'])) {
            $email = $_POST['email'];
            if (empty($email)) {
                $messages[] = 'saisir un email';
            } elseif ($co->selectEmail($email)) {
                $messages[] = 'email déjà utilisé';
            } elseif ($co->upEmail($email, $row['id'])) {
                // l'email sert d'identifiant de connexion : on met à jour la session
                $_SESSION['login'] = $email;
                rediriger('index.php?page=profil', 'email modifié');
            } else {
                $messages[] = "echec de la modification";
            }
        }
        //fin  de formulaire

        //formulaire de  modification de photo
        if (isset($_POST['envoyerfile'])) {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $image = enregistrerImage($_FILES['image'], $dossierImages, array("png", "jpg", "jpeg"), $messages);
                if ($image != null) {
                    // on supprime l'ancienne photo du dossier puis on enregistre la nouvelle
                    supprimerImage($row['image'], $dossierImages);
                    $co->upImage($image);
                    rediriger('index.php?page=profil', 'photo modifiée');
                }
            } else {
                $messages[] = 'veuillez choisir une image';
            }
        }
        //fin de formulaire

        echo $twig->render('profil.html.twig', ['user' => $row, 'messages' => $messages]);
    }
}

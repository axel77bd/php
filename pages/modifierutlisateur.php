<?php
// comme la liste des utilisateurs, cette page est réservée aux administrateurs
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} elseif ($_SESSION['role'] != 'admin') {
    $messages[] = "vous n'êtes pas administrateur";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $modif = new User($dbh);

    // le formulaire a été envoyé : on enregistre la modification
    if (isset($_POST['valider'])) {
        $name = $_POST['name'];
        $prenom = $_POST['prenom'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        if (!empty($password)) {
            // le mot de passe n'est pas vide : on le hashe et on le modifie aussi
            $password = password_hash($password, PASSWORD_DEFAULT);
            $modif->up2($name, $prenom, $id, $password);
        } else {
            // sinon on modifie seulement le nom et le prénom
            $modif->up3($name, $prenom, $id);
        }
        rediriger('index.php?page=listeutilisateurs', 'utilisateur modifié');
    }

    $row = null;
    //verifie si il est existe dans le tableau $_GET(url) l'utilisateur
    if (isset($_GET['user'])) {
        // on récupère la ligne de l'utilisateur (false s'il n'existe pas)
        $row = $modif->selectUser($_GET['user']);
    }

    if (!$row) {
        $messages[] = "l'utilisateur n'existe pas";
        echo $twig->render('message.html.twig', ['messages' => $messages]);
    } else {
        echo $twig->render('modifierutlisateur.html.twig', ['user' => $row, 'messages' => $messages]);
    }
}

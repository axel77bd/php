<?php
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} elseif ($_SESSION['role'] != 'admin') {
    $messages[] = "vous n'êtes pas administrateur";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $ut = new User($dbh);

    // suppression de plusieurs utilisateurs avec les cases à cocher
    if (isset($_POST['valider']) && isset($_POST['users'])) {
        foreach ($_POST['users'] as $user) {
            $ut->delete($user);
        }
        $messages[] = 'utilisateurs supprimés';
    }
    // clic sur le rôle : on passe de admin à user ou de user à admin
    if ((isset($_GET['role'])) && (isset($_GET['user']))) {
        if ($_GET['role'] == 'admin') {
            $r = 'user';
        } else {
            $r = 'admin';
        }
        $ut->update($r, $_GET['user']);
        rediriger('index.php?page=listeutilisateurs', 'rôle modifié');
    }
    // suppression d'un utilisateur avec le bouton supprimer
    if ((isset($_GET['user'])) && (isset($_GET['action']))) {
        if ($_GET['action'] == 'supprimer') {
            $ut->delete($_GET['user']);
            rediriger('index.php?page=listeutilisateurs', 'utilisateur supprimé');
        }
    }

    $uts = $ut->select();

    echo $twig->render('listeutilisateurs.html.twig', ['users' => $uts, 'messages' => $messages]);
}

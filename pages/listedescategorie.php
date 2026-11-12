<?php
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} elseif ($_SESSION['role'] != 'admin') {
    $messages[] = "vous n'êtes pas administrateur";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $ca = new Categorie($dbh);

    // suppression d'une catégorie avec le bouton supprimer
    if ((isset($_GET['categorie'])) && (isset($_GET['action']))) {
        if ($_GET['action'] == 'supprimer') {
            $ca->delete($_GET['categorie']);
            rediriger('index.php?page=listedescategorie', 'catégorie supprimée');
        }
    }
    // suppression de plusieurs catégories avec les cases à cocher
    if (isset($_POST['valider']) && isset($_POST['categories'])) {
        foreach ($_POST['categories'] as $categorie) {
            $ca->delete($categorie);
        }
        $messages[] = 'catégories supprimées';
    }

    $categories = $ca->select();

    echo $twig->render('listedescategorie.html.twig', ['categories' => $categories, 'messages' => $messages]);
}

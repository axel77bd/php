<?php
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} elseif ($_SESSION['role'] != 'admin') {
    $messages[] = "vous n'êtes pas administrateur";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $modif = new Categorie($dbh);

    // le formulaire a été envoyé : on enregistre la modification
    if (isset($_POST['valider'])) {
        $categorie = $_POST['categorie'];
        $id = $_POST['id'];
        if (empty($categorie)) {
            rediriger('index.php?page=modifiercategorie&categorie=' . urlencode($id), 'veuillez saisir une categorie');
        }
        $modif->update($id, $categorie);
        rediriger('index.php?page=listedescategorie', 'catégorie modifiée');
    }

    $row = null;
    //verifie si il est existe dans le tableau $_GET(url) la categorie
    if (isset($_GET['categorie'])) {
        // on récupère la ligne de la catégorie (false si elle n'existe pas)
        $row = $modif->selectCategorie($_GET['categorie']);
    }

    if (!$row) {
        $messages[] = "la categorie n'existe pas";
        echo $twig->render('message.html.twig', ['messages' => $messages]);
    } else {
        echo $twig->render('modifiercategorie.html.twig', ['categorie' => $row, 'messages' => $messages]);
    }
}

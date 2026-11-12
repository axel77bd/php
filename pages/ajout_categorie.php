<?php
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} elseif ($_SESSION['role'] != 'admin') {
    $messages[] = "vous n'êtes pas administrateur";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    if (isset($_POST['valider'])) {
        $categorie = $_POST['categorie'];
        if (empty($categorie)) {
            $messages[] = "veuillez saisir une categorie";
        } else {
            $ajoutca = new Categorie($dbh);
            if ($ajoutca->ajoutcate($categorie)) {
                $messages[] = "catégorie ajoutée";
            } else {
                $messages[] = "pas de catégorie ajoutée";
            }
        }
    }

    echo $twig->render('ajout_categorie.html.twig', ['messages' => $messages]);
}

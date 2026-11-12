<?php
if (!isset($_SESSION['login'])) {
    $messages[] = 'connectez vous';
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    $idArticle = null;
    //verifie si il est existe dans le tableau $_GET(url) l'article
    if (isset($_GET['Article'])) {
        $idArticle = $_GET['Article'];
    }

    $row = null;
    if ($idArticle) {
        $cato = new Article($dbh);
        $row = $cato->selectArticle($idArticle);
    }

    if (!$row) {
        $messages[] = "l'article n'existe pas";
        echo $twig->render('message.html.twig', ['messages' => $messages]);
    } else {
        if (isset($_POST['modifier'])) {
            $sujet = $_POST['sujet'];
            $contenu = $_POST['contenu'];
            $annuler = false;
            // par défaut on garde l'image actuelle de l'article
            $image = $row['image'];

            if (empty($sujet) || empty($contenu)) {
                $messages[] = 'veuillez saisir un sujet et un contenu';
                $annuler = true;
            }

            // si une nouvelle image a été envoyée
            if (!$annuler && isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $nouvelle = enregistrerImage($_FILES['image'], $dossierImages, array("png", "jpg", "jpeg"), $messages);
                if ($nouvelle == null) {
                    $annuler = true;
                } else {
                    // on supprime l'ancienne image du dossier et on garde la nouvelle
                    supprimerImage($row['image'], $dossierImages);
                    $image = $nouvelle;
                }
            }

            if (!$annuler) {
                $art = new Article($dbh);
                $art->update($image, $row['id'], $sujet, $contenu);
                rediriger('index.php?page=home', 'article modifié');
            }
        }

        echo $twig->render('modifierarticle.html.twig', ['article' => $row, 'messages' => $messages]);
    }
}

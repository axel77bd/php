<?php
if (isset($_POST['valider'])) {
    $sujet = $_POST['sujet'];
    $contenu = $_POST['contenu'];
    $valide = true;

    if (empty($sujet)) {
        $messages[] = "veuillez saisir un sujet";
        $valide = false;
    } elseif (strlen($sujet) > 50) {
        $messages[] = "veuillez diminuer la taille de votre sujet";
        $valide = false;
    }
    if (empty($contenu)) {
        $messages[] = "veuillez saisir un contenu";
        $valide = false;
    }

    // on protege l'ajout en vérifiant que les données ne sont pas vides
    if ($valide) {
        $image = null;
        $anciennom = null;
        // si une image a été envoyée avec le formulaire
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $anciennom = $_FILES['image']['name'];
            $image = enregistrerImage($_FILES['image'], $dossierImages, array("png", "jpg", "jpeg", "webp"), $messages);
            // si l'image est refusée on annule l'ajout de l'article
            if ($image == null) {
                $valide = false;
            }
        }

        if ($valide) {
            $article = new Article($dbh);
            if ($article->insert($sujet, $contenu, $image, $anciennom)) {
                $messages[] = "ajout réussi";
            } else {
                $messages[] = "echec de l'ajout";
            }
        }
    }
}

// la liste des catégories pour les cases à cocher du formulaire
$cates = new Categorie($dbh);
$categories = $cates->select();

echo $twig->render('article.html.twig', ['categories' => $categories, 'messages' => $messages]);

<?php
if (isset($_POST['valider'])) {
    $sujet = $_POST['sujet'];
    $contenu = $_POST['contenu'];
    $valide = true;

    if (empty($sujet)) {
        $messages[] = "veuillez saisir un titre";
        $valide = false;
    } elseif (strlen($sujet) > 50) {
        $messages[] = "veuillez diminuer la taille de votre titre";
        $valide = false;
    }
    if (empty($contenu)) {
        $messages[] = "veuillez saisir un contenu";
        $valide = false;
    }

    // on protege l'ajout en vérifiant que les données ne sont pas vides
    if ($valide) {
        $com = new Commentaire($dbh);
        if ($com->insert($sujet, $contenu)) {
            $messages[] = "ajout réussi";
        } else {
            $messages[] = "echec de l'ajout";
        }
    }
}

echo $twig->render('commentaire.html.twig', ['messages' => $messages]);

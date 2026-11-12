<?php
if (isset($_POST['valider'])) {
    // plus besoin de htmlentities : Twig protège automatiquement tout ce qu'il affiche avec {{ }}
    $sujet = $_POST['sujet'];
    $email = $_POST['email'];
    $contenu = $_POST['contenu'];
    $valide = true;

    if (empty($sujet)) {
        $messages[] = "veuillez saisir un sujet";
        $valide = false;
    } elseif (strlen($sujet) > 50) {
        $messages[] = "veuillez diminuer la taille de votre sujet";
        $valide = false;
    }
    if (empty($email)) {
        $messages[] = "veuillez saisir un email";
        $valide = false;
    }
    if (empty($contenu)) {
        $messages[] = "veuillez saisir un contenu";
        $valide = false;
    }

    // on protege l'envoi en vérifiant que les données ne sont pas vides
    if ($valide) {
        $conct = new Contact($dbh);
        if ($conct->insert($sujet, $email, $contenu)) {
            $messages[] = "message envoyé";
        } else {
            $messages[] = "echec de l'envoi";
        }
    }
}

echo $twig->render('contact.html.twig', ['messages' => $messages]);

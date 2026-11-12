<?php
// Fonctions utilisées par plusieurs pages

// redirige vers une autre page et arrête le script.
// $message (facultatif) sera affiché sur la page d'arrivée
function rediriger($url, $message = null)
{
    if ($message != null) {
        $_SESSION['flash'][] = $message;
    }
    header('Location:' . $url);
    exit;
}

// vérifie puis enregistre une image envoyée par un formulaire.
// $fichier : la case de $_FILES (ex : $_FILES['image'])
// $dossier : le dossier où ranger l'image
// $extensions : les extensions acceptées
// $messages : le tableau des messages, on y ajoute l'erreur s'il y en a une
// retourne le nouveau nom de l'image, ou null si l'image est refusée
function enregistrerImage($fichier, $dossier, $extensions, &$messages)
{
    $ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $extensions)) {
        $messages[] = "l'extension n'est pas acceptée";
        return null;
    }
    if ($fichier['error'] != UPLOAD_ERR_OK || $fichier['size'] > 500000) {
        $messages[] = 'fichier trop volumineux';
        return null;
    }
    // on donne un nom unique à l'image pour ne pas écraser une autre image
    $image = uniqid() . '.' . $ext;
    //on recupère le nom temporaire du fichier et on le déplace dans le dossier
    if (!move_uploaded_file($fichier['tmp_name'], $dossier . $image)) {
        $messages[] = "l'image n'a pas pu être enregistrée";
        return null;
    }
    return $image;
}

// supprime une ancienne image du dossier si elle existe
function supprimerImage($image, $dossier)
{
    if (!empty($image) && file_exists($dossier . $image)) {
        unlink($dossier . $image);
    }
}

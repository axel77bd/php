<?php
$idArticle = null;
if (isset($_GET['Article'])) {
    //je récupère l'id de l'article dans la variable
    $idArticle = $_GET['Article'];
}

$row = null;
if ($idArticle) {
    $cato = new Article($dbh);
    $row = $cato->selectArticle($idArticle);
}

if (!$row) {
    // l'article n'existe pas
    $messages[] = "l'article n'existe pas";
    echo $twig->render('message.html.twig', ['messages' => $messages]);
} else {
    // formulaire pour commenter l'article
    if (isset($_POST['envoyer'])) {
        if (!isset($_SESSION['login'])) {
            $messages[] = 'connectez vous pour commenter';
        } else {
            $sujet = $_POST['sujet'];
            $contenu = $_POST['contenu'];
            $datedepublication = date('Y-m-d H:i:s');
            if (empty($sujet) || empty($contenu)) {
                $messages[] = 'veuillez saisir un titre et un contenu';
            } else {
                $coms = new Commentaire($dbh);
                $coms->insertCom($sujet, $contenu, $datedepublication, $idArticle);
                // on recharge la page : le nouveau commentaire apparaît et
                // actualiser la page ne renvoie pas le formulaire une deuxième fois
                rediriger('index.php?page=lirearticle&Article=' . $row['id'], 'commentaire ajouté');
            }
        }
    }

    $com = new Commentaire($dbh);
    $comments = $com->comArticle($idArticle);

    echo $twig->render('lirearticle.html.twig', ['article' => $row, 'comments' => $comments, 'messages' => $messages]);
}

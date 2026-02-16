
<?php

$Article = null;
if (isset($_GET['Article'])) {
    //je récupère la valeur catégorie dans la variable
    $Article = $_GET['Article'];
}

if ($Article) {
    $cato = new Article($dbh);
    $row = $cato->selectArticle($Article);
}


$com = new Commentaire($dbh);
$comments = $com->comArticle($Article);

if (isset($_SESSION['login'])) {

    if (isset($_POST['envoyer'])) {
        $sujet = $_POST['sujet'];
        $contenu = $_POST['contenu'];
        $datedepublication = date('Y-m-d H-i-s');
        if (empty($sujet) && empty($contenu)) {
            echo 'veuillez saisir un champ';
        } else {
            $coms = new Commentaire($dbh);
            $coms->insertCom($sujet, $contenu, $datedepublication, $Article);
        }

    }
    echo $twig->render('lirearticle.html.twig', ['article' => $row,'comments'=>$comments]);
}
?>

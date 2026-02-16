<div class="container text-center">
<div class="row justify-content-center">
    <div class="col-12 col-md-8 text-center">
<?php

$Article = null;
if (isset($_GET['Article'])) {
    //je récupère la valeur catégorie dans la variable
    $Article = $_GET['Article'];
}

if ($Article) {
    $cato = new Article($dbh);
    $row = $cato->selectArticle($Article);
    if (($row == null)) {
        echo "l'article  n\'existe pas ";
    } else {
        echo '<div class="card" style="">
  <img src="images/' . $row['image'] . '" class="card-img-top" alt="...">


  <div class="card-body">
  <div class="card-footer">
  ' . $row['datedepublication'] . '
  </div>
  <a class="btn btn-info"href="index.php?page=modifierarticle&Article=' . $row['id'] . '"> modifier l\'article</a>


  </div>';

    }
$com= new Commentaire($dbh);
$comments=$com->comArticle($Article);

    if (isset($_SESSION['login'])) {

        if (isset($_POST['envoyer'])) {
            $sujet = $_POST['sujet'];
            $contenu = $_POST['contenu'];
            $datedepublication = date('Y-m-d H-i-s');
            if (empty($sujet) && empty($contenu)) {
                echo 'veuillez saisir un champ';
            } else {
                $coms= new Commentaire($dbh);
                $coms->insertCom($sujet,$contenu,$datedepublication, $Article);
            }

        }
        echo '

    <button class="btn btn-primary" name="envoyer" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
    Commenter cet article
  </button>
  <div style="min-height: 120px;">
  <div class="collapse collapse-horizontal" id="collapseWidthExample">
    <div class="card card-body" style="width: 300px;">
    <form action="index.php?page=lirearticle&Article=' . $Article . '" method="post">
    <div class="row">
 <div class="col-12 col-md-6">
 <div>
   <label for="exampleInputSujet" class="form-label mt-4"> TITRE</label>
   <input name="sujet" type="text" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="ENTRER LE TITRE ">
 </div>
 <div>
   <label for="exampleTextarea" class="form-label mt-4">Contenu</label>
   <textarea name="contenu" class="form-control" id="exampleTextarea" rows="3"></textarea>
 </div>
 <div>
    <button name=envoyer type="submit" class="btn btn-primary mt-4">valider</button>
</div>


   </div>
   </div>
  </form>
  </div>
  </div>
       ';

    }

}
foreach ($comments as $comment) {
    echo '<img width="200px" class="img-thumbnail" src="images/' . $comment['image'] . '" />';
    echo $comment['titre'];
    echo $comment['contenu'];
    echo $comment['nom'];
    echo $comment['prenom'];
    echo ' <div>
    </div>';

}
?>
</div>
<div class="col-12 col-md-4 text-center">
    pub
</div>

</div>
<div>

<?php
if (isset($_POST['valider'])) {
    //var_dump($_POST);
    // permet d'empêcher d'ecrire du code à l'interieur (htmlentities)
    $sujet = htmlentities($_POST['sujet']);
    $email = htmlentities($_POST['email']);
    //
    $contenu = nl2br($_POST['contenu']);
    if (empty($sujet)) {
        echo "veuillez saisir un sujet ";
        $valideSujet = false;
    } else {
        if (strlen($sujet) > 50) {
            echo "veuillez dimunier la taille de votre sujet ";
            $valideSujet = false;
        } else {
            echo "$sujet";
            $valideSujet = true;
        }

        if (empty($contenu)) {
            echo "veuillez saisir un contenu";
        } else {
            echo "$contenu";

        }

        // on protege l'inscription en vérifiant que les données ne sont pas vides
        if ((!empty($sujet)) && (!empty($email)) && (!empty($contenu))) {

            $conct = new Contact($dbh);
            $conct->insert($sujet, $email, $contenu);
        }
    }

    // on prépare  une requête  d'insertion qui associe une colonne de la table avec une donnée

}
?>
 <h1 class="text-dark text-center">Conctact</h1>
<form action="index.php?page=contact" method="post">
    <div class="row">
      <div class="col-12 col-md-6">
    <div>
      <label for="exampleInputSujet" class="form-label mt-4"> Sujet</label>
      <input name="sujet" type="text" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="Enter le Sujet">
    </div>
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div>
      <label for="exampleTextarea" class="form-label mt-4">Contenu</label>
      <textarea name="contenu" class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
  <div>
    <button name=valider type="submit" class="btn btn-primary mt-4">valider</button>
  </div>
</form>

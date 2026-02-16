<?php
if (isset($_POST['valider'])) {
    //var_dump($_POST);
    $sujet =htmlentities($_POST['sujet']) ;
    $contenu =nl2br($_POST['contenu']);
    if (empty($sujet)) {
        echo "veuillez saisir un sujet ";
        $valideSujet=false;
    } else {
      if(strlen($sujet)>50){
        echo "veuillez dimunier la taille de votre sujet ";
        $valideSujet=false;
      }else{
         echo "$sujet";
         $valideSujet=true;
      }
       
    }
    if (empty($contenu)) {
        echo "veuillez saisir un contenu";
    } else {
        echo "$contenu";

    }
    
    // on protege l'inscription en vérifiant que les données ne sont pas vides 
    if ($valideSujet && (!empty($contenu))) {
       $com= new Commentaire ($dbh);
       $com->insert($sujet,$contenu,$datedepublication);
    }
}
?>
<h1 class="text-dark text-center">Commentaire </h1>
<form action="index.php?page=commentaire" method="post">
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
    <button name=valider type="submit" class="btn btn-primary mt-4">valider</button>
</div>
</form>
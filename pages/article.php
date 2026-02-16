<?php
if (isset($_POST['valider'])) {
    //var_dump($_FILES);
    $sujet = htmlentities($_POST['sujet']);
    $contenu = nl2br($_POST['contenu']);
   // $categories= $_POST['categories'];
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

    }
    if (empty($contenu)) {
        echo "veuillez saisir un contenu";
    } else {
        echo "$contenu";

    }
    $annuler = false;
    // on protege l'inscription en vérifiant que les données ne sont pas vides
    if ($valideSujet && (!empty($contenu))) {

        if (isset($_FILES['image'])) {
            if (!empty($_FILES['image']['name'])) {
                //var_dump($_FILES);

                //on recupère le nom temporaire du fichier
                $tmp = $_FILES['image']['tmp_name'];
                $name = $_FILES['image']['name'];
                $image = uniqid() . substr($name, -5);
                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                $ok = array("png", "jpg", "pdf", "jpeg", "webp");
              
                $anciennom = $name;
                if (!in_array($ext, $ok)) {
                    echo 'l\'extension n\'est pas accepté ';
                    $image = null;
                    $anciennom = null;
                    $annuler = true;
                } 
                  
               
                if($_FILES['image']['size']>500000){
                  
                  echo'fichier volumineux ';
                  $annuler=true;

                }
               
                if(!$annuler){
                  move_uploaded_file($tmp, 'images/' . $image);
                }
                
            } else {
                $image = null;
                $anciennom = null;
            }

        }
        

        
        if (!$annuler) {
            $article = new Article($dbh);
           $article->insert($sujet,$contenu,$image,$anciennom);
        }
    }


}
$cates= new Categorie($dbh);
$ca=$cates->select();
    
                
                

 echo'<h1 class="text-dark text-center">Article </h1>';
  //<!-- enctype permet de preciser comment on envoie les données , quand envoie un fichier il faut mettre multipart/form-data -->
echo'<form action="index.php?page=article" method="post" enctype="multipart/form-data">';
  echo'<div class="row">
    <div class="col-12 col-md-6">
    <div>
      <label for="exampleInputSujet" class="form-label mt-4">  Sujet</label>
      <input name="sujet" type="text" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="Enter le Sujet">
    </div>
    <div>
      <label for="exampleTextarea" class="form-label mt-4">Contenu</label>
      <textarea name="contenu" class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
    <div>
      <input name="image" class="form-control" type="file"/>
    </div>
    
    <div>';
    foreach ($ca as $c) {
echo'<input value=" '.$c['id'].' " class= "form-check-input" name="categories[]" type="checkbox" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">'.$c['nom'].' </label>';

    }
   echo' <button name=valider type="submit" class="btn btn-primary mt-4">valider</button>
</div>
</form>';
// 
?>
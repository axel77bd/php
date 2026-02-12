<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        if(isset($_POST['valider'])){
            $categorie =htmlentities($_POST['categorie']) ;
            if (empty($categorie)) {
                echo "veuillez saisir une categorie ";
                $validecategoriet=false;
              
              }else{
                 echo "$categorie";
                 $validecategoriet=true;
              }
             if ($validecategoriet){
                $sql = $dbh->prepare("INSERT INTO categorie(`nom`) values(:categorie)");
                $sql->bindParam(':categorie', $categorie, PDO::PARAM_STR);
                $r = $sql->execute();
                if($r){
                    echo "catégorie ajouter ";
                  }
                  else{
                    echo "pas de catégorie ajouter ";
                  }
             }
        }           
        
       echo '<form action="index.php?page=ajout_categorie" method="post">
        <div class="row">
          <div class="col-12 col-md-6">
          <div>
            <label for="exampleInputSujet" class="form-label mt-4"> categorie</label>
            <input name="categorie" type="text" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="ENTRER LA CATEGORIE ">
          </div>
      <div>
          <button name="valider" type="submit" class="btn btn-primary mt-4">valider</button>
      </div>
      </form> ';
        
    } else {
        echo 'vous êtes pas administrateur ';
    }
} else {
    echo 'connectez vous';
}


?>


<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        echo '<h1>modifier categorie </h1>';
        $categorie = null;
//verifie si il est existe dans le tableau $_GET(url) la categorie
        if (isset($_GET['categorie'])) {
            //je récupère la valeur catégorie dans la variable $categorie
            $categorie = $_GET['categorie'];
        }

//si $categorie n'est pas null
        if ($categorie) {
          $cate= new Commentaire($dbh);
          $row=$cate->selectCategorie( $categorie);
            // si la ligne est null c'est que la categorie n'existe pas
            if (($row == null)) {
                echo "il y a un problèmme d'identifiant, la categorie n\'existe pas ";
            } else {
                echo '<form action="index.php?page=modifiercategorie" method="post">
        <div class="row">
          <div class="col-12 col-md-6">
          <div>
            <label for="exampleInputSujet" class="form-label mt-4"> categorie</label>
            <input name="categorie" value="' . $row['nom'] . '" type="text" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="ENTRER LA CATEGORIE ">
            <input name="id" value="' . $row['id'] . '" type="hidden"/>          </div>
      <div>
          <button name="valider" type="submit" class="btn btn-primary mt-4">valider</button>
      </div>
      </form> ';
            }

        } else {
            if (isset($_POST['valider'])) {
                $categorie = $_POST['categorie'];
                $id = $_POST['id'];
                echo $id;
                echo $categorie;
               $modif= new Categorie($dbh);
               $modif->update($id,$categorie);
                header('Location:index.php?page=listedescategorie');

                echo 'formulaire envoyé ';

            } else {
                echo 'la categorie n\'existe pas';
            }

        }
    } else {
        echo 'vous êtes pas administrateur ';
    }
} else {
    echo 'connectez vous';
}

?>
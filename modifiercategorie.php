
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
            // nous ecrivons la requête permettant d'identifier une catégorie
            $sql = "select id,nom from categorie where id=:id";
            //on prepare la requête en protégeant les  paramètres et en verifiant les types
            $sql = $dbh->prepare($sql);
            // on a associe la variable php avec la variable sql
            $sql->bindParam(':id', $categorie, PDO::PARAM_INT);
            // on execute la requête
            $sql->execute();
            //on récupère la ligne correspondant a la reponse de la requête ou la valeur null
            $row = $sql->fetch();
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
                $sql = "update categorie set nom=:nom where id=:id";
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':id', $id, PDO::PARAM_INT);
                $sql->bindParam(':nom', $categorie, PDO::PARAM_STR);
                $sql->execute();
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
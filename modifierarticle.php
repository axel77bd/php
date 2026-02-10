<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['id']) {
        echo '<h1>modifier article </h1>';
        $article = null;
//verifie si il est existe dans le tableau $_GET(url) la categorie
        if (isset($_GET['Article'])) {
            //je récupère la valeur catégorie dans la variable $categorie
            $article = $_GET['Article'];
        }

//si $categorie n'est pas null
        if ($article) {
            // nous ecrivons la requête permettant d'identifier une catégorie
            $sql = " SELECT id,sujet,image, contenu, datedepublication FROM Article where id=:id";
            //on prepare la requête en protégeant les  paramètres et en verifiant les types
            $sql = $dbh->prepare($sql);
            // on a associe la variable php avec la variable sql
            $sql->bindParam(':id', $article, PDO::PARAM_INT);
            // on execute la requête
            $sql->execute();
            //on récupère la ligne correspondant a la reponse de la requête ou la valeur null
            $row = $sql->fetch();
            // si la ligne est null c'est que la categorie n'existe pas
            if (isset($_POST['modifier'])) {
                $sujet = $_POST['sujet'];
                $contenu = $_POST['contenu'];
                $annuler = false;
                if (isset($_FILES['image'])) {
                    if (!empty($_FILES['image']['name'])) {

                        //on recupère le nom temporaire du fichier
                        $tmp = $_FILES['image']['tmp_name'];
                        $name = $_FILES['image']['name'];
                        $image = uniqid() . substr($name, -5);
                        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                        $ok = array("png", "jpg", "jpeg");

                        if (!in_array($ext, $ok)) {
                            echo 'l\'extension n\'est pas accepté ';
                            $image = null;
                            $anciennom = null;
                            $annuler = true;
                        }

                        if ($_FILES['image']['size'] > 500000) {

                            echo 'fichier volumineux ';
                            $annuler = true;

                        }

                        if (!$annuler) {
                            $anciennom = 'images/' . $image;
                            if (!empty($row['image']) && file_exists($anciennom)) {
                                unlink($anciennom);
                            }

                            move_uploaded_file($tmp, 'images/' . $image);
                            $sql = "update Article set image=:image, sujet=:sujet,contenu=:contenu where id=:id";
                            $sql = $dbh->prepare($sql);
                            $sql->bindParam(':image', $image, PDO::PARAM_STR);
                            $sql->bindParam(':id', $article, PDO::PARAM_INT);
                            $sql->bindParam(':sujet', $sujet, PDO::PARAM_STR);
                            $sql->bindParam(':contenu', $contenu, PDO::PARAM_STR);
                            $sql->execute();
                            echo $image . ' ' . $article . ' ' . $sujet . ' ' . $contenu;
                            echo 'reussi';

                            header('Location:index.php?page=home');
                        }

                    } else {
                        $image = null;
                        $anciennom = null;
                    }}
                }
                if (($row == null)) {
                    echo "il y a un problèmme d'identifiant, la categorie n\'existe pas ";
                } else {
                    echo '<form action="index.php?page=modifierarticle&Article=' . $row['id'] . '" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-12 col-md-6">
    <div>
    <div>
    <label for="exampleInputSujet" class="form-label mt-4">  Sujet</label>
    <input name="sujet" type="text" value="' . $row['sujet'] . '" class="form-control" id="exampleInputSujet" aria-describedby="sujetHelp" placeholder="Enter le Sujet">
  </div>
  <div>
    <label for="exampleTextarea" class="form-label mt-4">Contenu</label>
    <textarea name="contenu" class="form-control" id="exampleTextarea" rows="3">' . $row['contenu'] . '</textarea>
  </div>
      <input name="image" value="' . $row['image'] . '"class="form-control" type="file"/>
      <div>
      <input name="id" value="' . $row['id'] . '" type="hidden"/>
      </div>
      <div>
                <button name="modifier" type="submit" class="btn btn-primary mt-4">modifier</button>
      </div>
    </div>
    </div>
    </div>
    </form>

    ';
                }   
            } else {

                echo 'l\'article n\'existe pas';
            }

        }
    }


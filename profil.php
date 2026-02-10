<?php
if (isset($_SESSION['login'])) {
    $sql = 'SELECT id,nom, prenom, password, email,role,image FROM user where email= :email ';
    // on prépare la requête
    $sql = $dbh->prepare($sql);
    // on associe la variable $email à la variable :email (cela protege des codes malveillants)
    $sql->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
    // il execute la requete
    $sql->execute();
    //on récupère la ligne de résultat
    $row = $sql->fetch();
    if (($row == null)) {
        echo "il y a un problèmme d'identifiant";
    } else {

        // Formulaire pour modifier le mot de passe
        if (isset($_POST['modifier'])) {
            $password = $_POST['password'];

            if (empty($password)) {
                echo 'saisir le mot de passe ';
            } else {

                $confirmation = $_POST['confirmation'];
                if ($password == $confirmation) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "update user set password=:password where email=:email";
                    $sql = $dbh->prepare($sql);
                    $sql->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
                    $sql->bindParam(':password', $password, PDO::PARAM_STR);
                    $r = $sql->execute();
                    // si $r=vrai alors l'inscription est réussie
                    if ($r) {
                        echo "mot de passe modifie";
                    } else {
                        echo "echec de la modification ";
                    }

                } else {
                    echo 'les mots de passe ne sont pas identiques ';
                }
            }
        }
        // Fin Formulaire pour modifier le mot de passe

        //formulaire pour modifier  l'email 
        if (isset($_POST['envoyer'])) {
            $email = $_POST['email'];
            if (empty($email)) {

            } else {
                $sql = "select email from user where email=:email";
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':email', $email, PDO::PARAM_STR);
                $sql->execute();
                $row2 = $sql->fetch();
                if ($row2 == null) {

                    $sql = "update user set email=:email where id=:id";
                    $sql = $dbh->prepare($sql);
                    $sql->bindParam(':email', $email, PDO::PARAM_STR);
                    $sql->bindParam(':id', $row['id'], PDO::PARAM_INT);
                    $r = $sql->execute();
                    // si $r=vrai alors l'inscription est réussie
                    if ($r) {
                        echo "email modifie";
                        $_SESSION['login'] = $email;
                        header('Location:index.php?page=profil');
                    } else {
                        echo "echec de la modification ";
                    }
                } else {
                    echo 'email déjà utilisé ';
                }

            }
            //fin  de formulaire 

        }
        $annuler = false;
        //formulaire de  modification de photo 
        //var_dump($_FILES);

        if (isset($_POST['envoyerfile'])) {

            if (isset($_FILES['image'])) {
                if (!empty($_FILES['image']['name'])) {

                    //var_dump($_FILES);
                   
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
                        $anciennom= 'images/' . $image;
                        if(!empty($row['image'])&& file_exists($anciennom))
                        unlink($anciennom);
                    
                        move_uploaded_file($tmp, 'images/' . $image);
                        $sql="update user set image =:image where id=:id";
                        $sql = $dbh->prepare($sql);
                        $sql->bindParam(':image', $image, PDO::PARAM_STR);
                        $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
                        $sql->execute();

                        header('Location:index.php?page=profil');
                    }
    
                } else {
                    $image = null;
                    $anciennom = null;
                }
            }

        }
        //fin de formulaire 


        echo '<br/><h3> NOM : ' . $row['nom'] . '</h2><br/> <h3>PRENOM : ' . $row['prenom'] . '</h3><br/> EMAIL :' . $row['email'];
        echo '<img width="200px" class="img-thumbnail" src="images/'.$row['image'].'" />';
        echo '
        <button class="btn btn-primary" name="envoyer" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
        modifier vos information
      </button>
      <div style="min-height: 120px;">
      <div class="collapse collapse-horizontal" id="collapseWidthExample">
        <div class="card card-body" style="width: 300px;">

        <form action="index.php?page=profil" method="post" >
        mot de passe : <input type="password" name="password"/>
        confirmation : <input type="password" name="confirmation"/>
        <button name="modifier" type="submit" class="btn btn-primary mt-4">modifier le mot de passe </button>
        </form>';
        echo '<form action="index.php?page=profil" method="post">
        EMAIL : <input type="email" name="email"/>
        <button name="envoyer" type="submit" class="btn btn-primary mt-4">modifie l\'email</button>
        </form>
        <form action="index.php?page=profil" method="post" enctype="multipart/form-data">
        profil : <input type="file"  class="form-control" name="image"/>
        <button name="envoyerfile" type="submit" class="btn btn-primary mt-4">modifier votre profil</button>
        </form>


        </div>';

    }

} else {
    echo 'vous n\'avez pas les droit';
}

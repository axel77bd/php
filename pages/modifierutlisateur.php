<h1>modifier utlisateurs </h1>
<?php
$user = null;
//verifie si il est existe dans le tableau $_GET(url) la categorie
if (isset($_GET['user'])) {
    //je récupère la valeur catégorie dans la variable $categorie
    $user = $_GET['user'];
}
if ($user) {
    // nous ecrivons la requête permettant d'identifier une catégorie
    $select2= new User($dbh);
    $row=$select2->select($user);
    // si la ligne est null c'est que la categorie n'existe pas
    if (($row == null)) {
        echo "il y a un problèmme d'identifiant, l'utilisateur n\'existe pas ";
    } else {
        echo ' <h1 class="text-dark text-center">Inscription </h1>
<form action="index.php?page=modifierutlisateur" method="post">
  <div class="row">
    <div class="col-12 col-md-6">
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" type="email" value="' . $row['email'] . '" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input name="password" type="password"   class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <div>
      <label for="exampleInputName" class="form-label mt-4">Nom</label>
      <input name="name"type="text" value="' . $row['nom'] . '"class="form-control" id="exampleInputPassword1" placeholder="Nom" autocomplete="off">
    </div>
    <div>
      <label for="exampleInputFirstName" class="form-label mt-4">Prénom</label>
      <input name="prenom" type="text" value="' . $row['prenom'] . '" class="form-control" id="exampleInputPassword1" placeholder="Prénom" autocomplete="off">
      <input name="id" value="' . $row['id'] . '" type="hidden"/>
    </div>
</div>

      </div>
</div>
    <button name=valider type="submit" class="btn btn-primary mt-4">valider</button>
</div>
</form>';
    }
} else {
    if (isset($_POST['valider'])) {
        //var_dump($_POST);
        $name = $_POST['name'];
        $prenom = $_POST['prenom'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        echo $name;
        echo $prenom;
        if (!empty($password)) {
            echo 'le mot de passe n\'est pas vide ';
            $password = password_hash($password, PASSWORD_DEFAULT);
           $modif2= new User($dbh);
           $modif2->up2($name,$prenom,$id,$password);
        } else {
           $modif3=new User($dbh);
           $modif3->$sql = "update user set nom=:nom,prenom=:prenom where id=:id";
        }
       
      

        $sql->execute();
        //header('Location:index.php?page=listeutilisateurs');

        echo 'utlisateur modifier  ';

    } else {
        echo 'utlisateur non existant';
    }

}
?>

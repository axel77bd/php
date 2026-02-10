<?php
if (isset($_POST['valider'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        echo "veuillez saisir un email ";
        $valideemail = false;
    } else {
        $valideemail = true;

    }
    if (empty($password)) {
        $validepassword = false;
        echo "veuillez saisir un mot de passe ";
    } else {
        $validepassword = true;
    }
    // si l'email et le mot passe sont saisis
    if (($valideemail) && (($validepassword))) {
        // on ecrit la requête qui va retouner les information de l'utilisateur qui possède cet email
        $sql = 'SELECT nom, prenom, password, email,id,role FROM user where email= :email ';
        // on prépare la requête
        $sql = $dbh->prepare($sql);
        // on associe la variable $email à la variable :email (cela protege des codes malveillants)
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        // il execute la requete
        $sql->execute();
        //on récupère la ligne de résultat
        $row = $sql->fetch();
        // si la ligne est null c'est que l'utlisateur n'existe pas
        if (($row == null)) {
            echo "il y a un problèmme d'identifiant";
        } else {
            if (password_verify($password, $row['password'])) {
                // la connexion a reussie et nous stockons l'email de la personne dans  $_SESSION  en créant  la clé  login
                $_SESSION['login'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['id']=$row['id'];
                header('Location:index.php');

            } else {
                echo "il y a un problèmme d'identifiant";

            }
        }

    }
}

?>
<div>
<form action="index.php?page=connexion" method="post">
  <label class="form-label mt-4">CONNEXION</label>
  <div class="form-floating mb-3">
    <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating">
    <input name="password"type="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
    <label for="floatingPassword">Password</label>
  </div>
</div>

    <button name="valider" type="submit" class="btn btn-primary mt-4">VALIDER</button>
    </form>
</div>
</div>

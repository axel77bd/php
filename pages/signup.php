<?php
if (isset($_POST['valider'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $radio = $_POST['radio'];
    if (empty($email)) {
        echo "veuillez saisir un email ";
    } else {
        
      $selectE= new User($dbh);
      $row2=$selectE->selectEmail( $email);
                if ($row2 == null) {
                  echo "$email";
                } else {
                    echo 'email déjà utilisé ';
                }

            }
          
    }
  
    if (empty($password)) {
        echo "veuillez saisir un mot de passe ";
    } else {
        echo "$password";

    }
    if (empty($name)) {
        echo "veuillez saisir votre nom ";
    } else {
        echo "$name";
    }
    if (empty($prenom)) {
        echo "veuillez saisir votre prenom ";
    } else {
        echo "$prenom";
    }
    if (empty($radio)) {
        echo "veuillez choisir un genre   ";
    } else {
        echo "$radio";
    }
    // on protege l'inscription en vérifiant que les données ne sont pas vides 
    if ((!empty($email)) && (!empty($password)) && (!empty($name)) && (!empty($prenom))&&(($row2==null))) {
      $insertU= new User ($dbh);
      $r=$insertU->insert( $name, $prenom, $email,$password);
        // si $r=vrai alors l'inscription est réussie 
        if($r){
          echo "inscription réussie ";
        }
        else{
          echo "echec de l'inscription";
        }
      
    }
  

?>
 <h1 class="text-dark text-center">Inscription </h1>
<form action="index.php?page=signup" method="post">
  <div class="row">
    <div class="col-12 col-md-6">
    <div>
      <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div>
      <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
      <input name="password"type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
    </div>
    <div>
      <label for="exampleInputName" class="form-label mt-4">Nom</label>
      <input name="name"type="text" class="form-control" id="exampleInputPassword1" placeholder="Nom" autocomplete="off">
    </div>
    <div>
      <label for="exampleInputFirstName" class="form-label mt-4">Prénom</label>
      <input name="prenom" type="text" class="form-control" id="exampleInputPassword1" placeholder="Prénom" autocomplete="off">
    </div>
</div>
<div class="col-12 col-md-6">
      <legend class="mt-4">Genre</legend>
      <div class="form-check">
        <input name="radio" class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
        <label class="form-check-label" for="optionsRadios1">
            Homme
        </label>
      </div>
      <div class="form-check">
        <input name="radio" class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
        <label class="form-check-label" for="optionsRadios2">
          Femme
        </label>
      </div>
      <div class="form-check disabled">
        <input name="radio"class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios3" value="option3" >
        <label class="form-check-label" for="optionsRadios3">
          Autre
        </label>
      </div>
</div>
    <button name=valider type="submit" class="btn btn-primary mt-4">valider</button>
</div>
</form>

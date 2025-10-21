<?php
if (isset($_POST['valider'])) {
    //var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(empty($email)){
      echo "veuillez saisir un email ";
    }
    else{
      echo "$email";
    }
    if(empty($password)){
      echo "veuillez saisir un mot de passe ";
    }
    else{
      echo "$password";
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
  <div>

    <button name="valider" type="submit" class="btn btn-primary mt-4">VALIDER</button>
    </form>
</div>
</div>


<div class="container text-center ">
<div class="row justify-content-center">
    <div class="col-12 col-md-10  text-center">
        <div>
        <h1>liste des utilisateurs </h1>
<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        if (isset($_POST['valider'])) {
            $users = $_POST['users'];
            //var_dump($users);
            foreach ($users as $user) {
                //echo $user . ' ';
                $sql = 'delete from user where id=:id';
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':id', $user, PDO::PARAM_INT);
                $sql->execute();

            }

        }
        if ((isset($_GET['role'])) && (isset($_GET['user']))) {

            if ($_GET['role'] == 'admin') {
                $r = 'user';

            } else {
                $r = 'admin';
            }

            $sql = $dbh->prepare(" update user set role= :role where id=:id ");
            //j'associe une variable de la requete avec une variable php en precisant sont type
            $sql->bindParam(':role', $r, PDO::PARAM_STR);
            $sql->bindParam(':id', $_GET['user'], PDO::PARAM_INT);
            $r = $sql->execute();
        }
        if ((isset($_GET['user'])) && (isset($_GET['action']))) {
            if ($_GET['action'] == 'supprimer') {
                $sql = 'delete from user where id=:id';
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':id', $_GET['user'], PDO::PARAM_INT);
                $r = $sql->execute();
            }
        }
        $sql = 'SELECT nom, prenom, email, datedepublication,role,id FROM user ORDER BY datedepublication desc';
        echo '<form action="index.php?page=listeutilisateurs" method="post">';
        echo "<table> <tr> <th>nom</th> <th>prenom</th> <th>email</th> <th>datedepublication</th><th>role</th><th>suppression</th> <th>modifier</th><th></th> </tr>";
        foreach ($dbh->query($sql) as $row) {
            echo "<tr> <td>";
            echo $row['nom'];
            echo "</td> <td>";
            echo $row['prenom'];
            echo "</td><td>";
            echo $row['email'];
            echo "</td><td>";
            echo $row['datedepublication'];
            echo "</td><td><a href=\"index.php?page=listeutilisateurs&user=" . $row['id'] . "&role=" . $row['role'] . "\">";
            echo $row['role'];
            echo "</a></td><td><a class=\"btn btn-danger\" href=\"index.php?page=listeutilisateurs&user=" . $row['id'] . "&action=supprimer\">supprimer</a></td>
            <td><a class=\"btn btn-primary\" href=\"index.php?page=modifierutlisateur&user=" . $row['id'] . "\">modifier</a></td><td>
             <input value=\"" . $row['id'] . "\" class=\"form-check-input\" name=\"users[]\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">
            <label class=\"form-check-label\" for=\"flexCheckDefault\">

            </label></td>
            </tr>";
        }
        echo "</table>";
        echo '<button name=valider type="submit" class="btn btn-primary mt-4 ">valider</button>';
        echo '</form>';
    } else {
        echo 'vous êtes pas administrateur ';
    }
} else {
    echo 'connectez vous';
}
?>
</div>
</div>
</div>
</div>
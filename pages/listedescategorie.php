<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        echo '<h1>Liste des catégories </h1>';
        if ((isset($_GET['categorie'])) && (isset($_GET['action']))) {
            if ($_GET['action'] == 'supprimer') {
                $sql = 'delete from categorie where id=:id';
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':id', $_GET['categorie'], PDO::PARAM_INT);
                $r = $sql->execute();
            }
        }
        if (isset($_POST['valider'])) {
            $categories = $_POST['categories'];
            //var_dump($users);
            foreach ($categories as $categorie) {
                //echo $user . ' ';
                $sql = 'delete from categorie where id=:id';
                $sql = $dbh->prepare($sql);
                $sql->bindParam(':id', $categorie, PDO::PARAM_INT);
                $sql->execute();

            }

        }
        $sql = 'SELECT nom ,id FROM categorie ORDER BY nom asc';
        echo '<form action="index.php?page=listedescategorie" method="post">';
        echo "<table> <tr> <th>nom</th> <th>modifier</th><th>suppression</th> </tr>";
        foreach ($dbh->query($sql) as $row) {
            echo "<tr> <td>";
            echo $row['nom'] . "\t";

            echo '</td><td><a class="btn btn-primary" href="index.php?page=modifiercategorie&categorie=' . $row['id'] . '">modifier</a>';
            echo '</td><td> <a class="btn btn-danger "href="index.php?page=listedescategorie&categorie=' . $row['id'] . '&action=supprimer">supprimer</a></td>
           <td><input value=" ' . $row['id'] . ' " class= "form-check-input" name="categories[]" type="checkbox" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault"> </label></td>';
            echo "</td></tr>";
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

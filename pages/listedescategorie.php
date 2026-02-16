<?php
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] == 'admin') {
        echo '<h1>Liste des catégories </h1>';
        if ((isset($_GET['categorie'])) && (isset($_GET['action']))) {
            if ($_GET['action'] == 'supprimer') {
               $ca= new Categorie($dbh);
               $ca->delete($_GET['categorie']);
            }
        }
        if (isset($_POST['valider'])) {
            $categories = $_POST['categories'];
            //var_dump($users);
            foreach ($categories as $categorie) {
                //echo $user . ' ';
                $ca= new Categorie($dbh);
               $ca->delete($categorie);

            }

        }
        $cates= new Categorie($dbh);
$ca=$cates->select();
        echo '<form action="index.php?page=listedescategorie" method="post">';
        echo "<table> <tr> <th>nom</th> <th>modifier</th><th>suppression</th> </tr>";
        foreach ($ca as $row) {
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

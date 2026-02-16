<?php
class Categorie
{
    private $dbh;
    //constructeur qui permet de relier la variable de connexion afin la class la conserve
    public function __construct($dbh)
    {
        //on stoke la variable de connexion dans la propriete definir a l4
        $this->dbh = $dbh;
    }
    public function ajoutcate($categorie){
        $sql = $dbh->prepare("INSERT INTO categorie(`nom`) values(:categorie)");
                $sql->bindParam(':categorie', $categorie, PDO::PARAM_STR);
                $sql->execute();
    }
    public function select(){
        $cate = 'SELECT nom ,id FROM categorie ORDER BY nom asc';
        $cate = $this->dbh->prepare($cate);
        $cate->execute();
        return $cate->fetchAll();


    }
    public function delete($categorie) {
        $sql = 'delete from categorie where id=:id';
                $sql = $this->dbh->prepare($sql);
                $sql->bindParam(':id', $categorie, PDO::PARAM_INT);
                $r = $sql->execute();
    }
    public function selectCategorie( $categorie){
        // nous ecrivons la requête permettant d'identifier une catégorie
        $sql = "select id,nom from categorie where id=:id";
        //on prepare la requête en protégeant les  paramètres et en verifiant les types
        $sql = $this->dbh->prepare($sql);
        // on a associe la variable php avec la variable sql
        $sql->bindParam(':id', $categorie, PDO::PARAM_INT);
        // on execute la requête
        $sql->execute();
        //on récupère la ligne correspondant a la reponse de la requête ou la valeur null
       return $sql->fetch();
    }
    public function update($id,$categorie){
        $sql = "update categorie set nom=:nom where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':nom', $categorie, PDO::PARAM_STR);
        $sql->execute();

    } 
       


}
?>
<?php
class Article
{
    //la propriété $dbh conserve la connexion
    private $dbh;
    //constructeur qui permet de relier la variable de connexion afin la class la conserve
    public function __construct($dbh)
    {
        //on stoke la variable de connexion dans la propriete definir a l4
        $this->dbh = $dbh;
    }
    public function select()
    {
        $sql = 'SELECT id,sujet,image, contenu, datedepublication FROM Article ORDER BY datedepublication desc';
        $sql = $this->dbh->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }
    // retourne vrai si l'ajout a réussi (c'est la page qui choisit le message à afficher)
    public function insert($sujet, $contenu, $image, $anciennom)
    {
        $datedepublication = date("Y-m-d H:i:s");
        // on prépare  une requête  d'insertion qui associe une colonne de la table avec une donnée
        $sql = $this->dbh->prepare("INSERT INTO Article(`sujet`, `contenu`, `datedepublication`,`image`,`anciennom`) VALUES (:sujet, :contenu, :datedepublication,:image,:anciennom)");
        //j'associe une variable de la requete avec une variable php en precisant sont type
        $sql->bindParam(':sujet', $sujet, PDO::PARAM_STR);
        $sql->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $sql->bindParam(':datedepublication', $datedepublication, PDO::PARAM_STR);
        $sql->bindParam(':image', $image, PDO::PARAM_STR);
        $sql->bindParam(':anciennom', $anciennom, PDO::PARAM_STR);
        // j'execute la requête prépare et je retourne le resultat
        return $sql->execute();
    }
    public function update($image, $article, $sujet, $contenu)
    {
        $sql = "update Article set image=:image, sujet=:sujet,contenu=:contenu where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':image', $image, PDO::PARAM_STR);
        $sql->bindParam(':id', $article, PDO::PARAM_INT);
        $sql->bindParam(':sujet', $sujet, PDO::PARAM_STR);
        $sql->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        return $sql->execute();
    }

    public function selectArticle($Article)
    {
        $sql = " SELECT id,sujet,image, contenu, datedepublication FROM Article where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':id', $Article, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch();
    }
}

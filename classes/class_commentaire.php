<?php
class Commentaire
{
    private $dbh;
    //constructeur qui permet de relier la variable de connexion afin la class la conserve
    public function __construct($dbh)
    {
        //on stoke la variable de connexion dans la propriete definir a l4
        $this->dbh = $dbh;
    }
    public function insert($sujet,$contenu,$datedepublication){
        $datedepublication=date("Y-m-d H:i:s");
      // on prépare  une requête  d'insertion qui associe une colonne de la table avec une donnée 
        $sql = $this->dbh->prepare("INSERT INTO commentaire(`sujet`, `contenu`, `datedepublication`) VALUES (:sujet, :contenu, :datedepublication)");
        //j'associe une variable de la requete avec une variable php en precisant sont type 
        $sql->bindParam(':sujet', $sujet, PDO::PARAM_STR);
        $sql->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $sql->bindParam(':datedepublication', $datedepublication, PDO::PARAM_STR);
      // j'execute la requête prépare et je met le resultat dans $r 
        $r = $sql->execute();
        // si $r=vrai alors l'inscription est réussie 
        if($r){
          echo "ajout réussie ";
          
        }
        else{
          echo "echec de l'ajout ";
        };
    }
    public function comArticle($Article){
        $sqlcomment = "SELECT commentaire.contenu, commentaire.titre, user.image,user.nom,user.prenom  from commentaire inner join user on commentaire.iduser = user.id  where idarticle = :idarticle";
    $sqlcomment = $this->dbh->prepare($sqlcomment);
    $sqlcomment->bindParam(':idarticle', $Article, PDO::PARAM_INT);
    $sqlcomment->execute();
    return $sqlcomment->fetchAll();

    }
    public function insertCom($sujet,$contenu,$datedepublication, $Article){
        $sqlinsert = "insert into commentaire (titre, contenu,datedepublication,moderer,idarticle,iduser) values(:titre, :contenu, :datedepublication,false,:idarticle,:iduser)";
        $sqlinsert = $this->dbh->prepare($sqlinsert);
        $sqlinsert->bindParam(':titre', $sujet, PDO::PARAM_STR);
        $sqlinsert->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $sqlinsert->bindParam(':datedepublication', $datedepublication, PDO::PARAM_STR);
        $sqlinsert->bindParam(':idarticle', $Article, PDO::PARAM_INT);
        $sqlinsert->bindParam(':iduser', $_SESSION['id'], PDO::PARAM_INT);
        $sqlinsert->execute();
    } 
    
}
?>
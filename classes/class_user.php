<?php
class User
{
    private $dbh;
    //constructeur qui permet de relier la variable de connexion afin la class la conserve
    public function __construct($dbh)
    {
        //on stoke la variable de connexion dans la propriete definir a l4
        $this->dbh = $dbh;
    }
    public function delete($user)
    {

        $sql = 'delete from user where id=:id';
        $sql = $dbh->prepare($sql);
        $sql->bindParam(':id', $user, PDO::PARAM_INT);
        $sql->execute();
    }
public function connexion($email ){
    // on ecrit la requête qui va retouner les information de l'utilisateur qui possède cet email
    $sql = 'SELECT nom, prenom, password, email,id,role FROM user where email= :email ';
    // on prépare la requête
    $sql = $this->dbh->prepare($sql);
    // on associe la variable $email à la variable :email (cela protege des codes malveillants)
    $sql->bindParam(':email',$email, PDO::PARAM_STR);
    // il execute la requete
    $sql->execute();
    //on récupère la ligne de résultat
    return $sql->fetch();

}
public function update($r,$user){
    $sql = $this->dbh->prepare(" update user set role= :role where id=:id ");
            //j'associe une variable de la requete avec une variable php en precisant sont type
            $sql->bindParam(':role', $r, PDO::PARAM_STR);
            $sql->bindParam(':id', $user, PDO::PARAM_INT);
             $sql->execute();

}
public function select(){
    $sql = 'SELECT nom, prenom, email, datedepublication,role,id FROM user ORDER BY datedepublication desc';
    $sql = $this->dbh->prepare($sql);
    // on a associe la variable php avec la variable sq
    // on execute la requête
    $sql->execute();
    //on récupère la ligne correspondant a la reponse de la requête ou la valeur null
    return $sql->fetchAll();

}
public function up2($name,$prenom,$id,$password){
    $sql = "update user set nom=:nom,prenom=:prenom, password=:password where id=:id";
    $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        if (!empty($password)) {
            $sql->bindParam(':password', $password, PDO::PARAM_STR);
        }

        $sql->execute();

}
public function up3($name,$prenom,$id){
    $sql = "update user set nom=:nom,prenom=:prenom where id=:id";
    $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        
        $sql->execute();

}
public function upPass($password){
    $sql = "update user set password=:password where email=:email";
    $sql = $this->dbh->prepare($sql);
    $sql->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $sql->bindParam(':password', $password, PDO::PARAM_STR);
     $sql->execute();

}
public function upEmail( $email,$id){
    $sql = "update user set email=:email where id=:id";
    $sql = $this->dbh->prepare($sql);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $r = $sql->execute();

}
public function upImage($image){
    $sql="update user set image =:image where id=:id";
                        $sql = $dbh->prepare($sql);
                        $sql->bindParam(':image', $image, PDO::PARAM_STR);
                        $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
                        $sql->execute();


}
public function selectEmail( $email){
    $sql = "select email from user where email=:email";
                $sql = $this->dbh->prepare($sql);
                $sql->bindParam(':email', $email, PDO::PARAM_STR);
                $sql->execute();
                 $sql->fetch();

}
public function insert( $name, $prenom, $email,$password){
    $datedepublication=date("Y-m-d H:i:s");
      // nous hashons le mot de passe avec l'algo choisi par php. nous avons une longue chaine de caractère à la place du mp
       $password =password_hash($password, PASSWORD_DEFAULT);

      // on prépare  une requête  d'insertion qui associe une colonne de la table avec une donnée 
        $sql = $this->dbh->prepare("INSERT INTO user(`nom`, `prenom`, `email`, `password`,`datedepublication`,`role`) VALUES (:nom, :prenom, :email,:password , :datedepublication,'user')");
        //j'associe une variable de la requete avec une variable php en precisant sont type 
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom',  $prenom, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->bindParam(':datedepublication', $datedepublication, PDO::PARAM_STR);
      // j'execute la requête prépare et je met le resultat dans $r 
         $sql->execute();

}
}
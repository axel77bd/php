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
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':id', $user, PDO::PARAM_INT);
        return $sql->execute();
    }
    public function connexion($email)
    {
        // on ecrit la requête qui va retouner les information de l'utilisateur qui possède cet email
        $sql = 'SELECT nom, prenom, password, email,id,role,image FROM user where email= :email ';
        // on prépare la requête
        $sql = $this->dbh->prepare($sql);
        // on associe la variable $email à la variable :email (cela protege des codes malveillants)
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        // il execute la requete
        $sql->execute();
        //on récupère la ligne de résultat
        return $sql->fetch();
    }
    // retourne un seul utilisateur à partir de son id
    public function selectUser($id)
    {
        $sql = 'SELECT nom, prenom, email, role, id FROM user where id=:id';
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch();
    }
    public function update($r, $user)
    {
        $sql = $this->dbh->prepare(" update user set role= :role where id=:id ");
        //j'associe une variable de la requete avec une variable php en precisant sont type
        $sql->bindParam(':role', $r, PDO::PARAM_STR);
        $sql->bindParam(':id', $user, PDO::PARAM_INT);
        return $sql->execute();
    }
    public function select()
    {
        $sql = 'SELECT nom, prenom, email, datedepublication,role,id FROM user ORDER BY datedepublication desc';
        $sql = $this->dbh->prepare($sql);
        // on execute la requête
        $sql->execute();
        //on récupère toutes les lignes correspondant a la reponse de la requête
        return $sql->fetchAll();
    }
    // modifie le nom, le prénom et le mot de passe (déjà hashé)
    public function up2($name, $prenom, $id, $password)
    {
        $sql = "update user set nom=:nom,prenom=:prenom, password=:password where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        return $sql->execute();
    }
    // modifie seulement le nom et le prénom
    public function up3($name, $prenom, $id)
    {
        $sql = "update user set nom=:nom,prenom=:prenom where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        return $sql->execute();
    }
    // modifie le mot de passe de l'utilisateur connecté
    public function upPass($password)
    {
        $sql = "update user set password=:password where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        return $sql->execute();
    }
    public function upEmail($email, $id)
    {
        $sql = "update user set email=:email where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        return $sql->execute();
    }
    // modifie la photo de l'utilisateur connecté
    public function upImage($image)
    {
        $sql = "update user set image =:image where id=:id";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':image', $image, PDO::PARAM_STR);
        $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        return $sql->execute();
    }
    // retourne la ligne si l'email est déjà utilisé, sinon false
    public function selectEmail($email)
    {
        $sql = "select email from user where email=:email";
        $sql = $this->dbh->prepare($sql);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetch();
    }
    public function insert($name, $prenom, $email, $password)
    {
        $datedepublication = date("Y-m-d H:i:s");
        // nous hashons le mot de passe avec l'algo choisi par php. nous avons une longue chaine de caractère à la place du mp
        $password = password_hash($password, PASSWORD_DEFAULT);

        // on prépare  une requête  d'insertion qui associe une colonne de la table avec une donnée
        $sql = $this->dbh->prepare("INSERT INTO user(`nom`, `prenom`, `email`, `password`,`datedepublication`,`role`) VALUES (:nom, :prenom, :email,:password , :datedepublication,'user')");
        //j'associe une variable de la requete avec une variable php en precisant sont type
        $sql->bindParam(':nom', $name, PDO::PARAM_STR);
        $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->bindParam(':datedepublication', $datedepublication, PDO::PARAM_STR);
        // j'execute la requête prépare et je retourne le resultat
        return $sql->execute();
    }
}

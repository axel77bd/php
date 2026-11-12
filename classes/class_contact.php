<?php
class Contact
{
    private $dbh;
    //constructeur qui permet de relier la variable de connexion afin la class la conserve
    public function __construct($dbh)
    {
        //on stoke la variable de connexion dans la propriete definir a l4
        $this->dbh = $dbh;
    }
    public function insert($sujet, $email, $contenu)
    {
        $sql = $this->dbh->prepare("INSERT INTO conctact(`sujet`, `email`, `contenu`) VALUES (:sujet, :email, :contenu)");
        //j'associe une variable de la requete avec une variable php en precisant sont type
        $sql->bindParam(':sujet', $sujet, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        // j'execute la requête prépare et je retourne le resultat
        return $sql->execute();
    }
    public function select()
    {
        $sql = 'SELECT sujet, email ,contenu FROM conctact';
        $sql = $this->dbh->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }
}

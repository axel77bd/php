<?php
// essaie de faire le code qui dans le bloc try 
try {
    // se connecte à la base de données et stocke la connexion dans $dbh 
    $dbh = new PDO('mysql:host=localhost;dbname=phpcours', 'login4447', 'jvFWROneSUahYII');
} catch (PDOException $e) {
    // comme la connexionn n'a pas fonctionné je stocke null dans $dbh 
    $dbh= null ;
}

?>
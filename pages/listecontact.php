<h1>Liste des contact</h1>
<?php
$sql = 'SELECT sujet, email ,contenu FROM conctact';
echo "<table> <tr> <th>Sujet</th> <th>email</th> </tr>";
foreach ($dbh->query($sql) as $row) {
    echo "<tr><td>";
   echo  $row['sujet'] . "\t";
   echo "</td><td>";
    echo  $row['email'] . "\t";
    echo "</td></tr>";
}
echo "</table>";
?>
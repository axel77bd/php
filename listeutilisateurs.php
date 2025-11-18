<h1>liste des utilisateurs </h1>
<?php
$sql = 'SELECT nom, prenom, email, datedepublication FROM user ORDER BY datedepublication desc';
echo "<table> <tr> <th>nom</th> <th>prenom</th> <th>email</th> <th>datedepublication</th> </tr>";
foreach ($dbh->query($sql) as $row) {
    echo "<tr> <td>";
   echo  $row['nom'];
   echo "</td> <td>";
   echo  $row['prenom'];
   echo "</td><td>";
   echo  $row['email'];
   echo "</td><td>";
    echo  $row['datedepublication'];
    echo "</td></tr>";
}
echo "</table>";
?>
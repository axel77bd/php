<h1>Liste des Articles</h1>
<?php
$sql = 'SELECT sujet, contenu, datedepublication FROM Article ORDER BY datedepublication desc';
echo "<table> <tr> <th>Sujet</th> <th>datedepublication</th> </tr>";
foreach ($dbh->query($sql) as $row) {
    echo "<tr> <td>";
   echo  $row['sujet'] . "\t";
   echo "</td><td>";
    echo  $row['datedepublication'] . "\t";
    echo "</td></tr>";
}
echo "</table>";
?>
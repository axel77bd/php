<h1>Liste des Articles</h1>
<?php
$sql = 'SELECT sujet, contenu, datedepublication,image,id FROM Article ORDER BY datedepublication desc';
echo '<table> <tr> <th>Sujet</th> <th>datedepublication</th> <th>modifier</th></tr>';
foreach ($dbh->query($sql) as $row) {
    echo '<tr> <td>';
   echo  $row['sujet'] . "\t";
   echo '</td><td>';
    echo  $row['datedepublication'] . "\t";
    echo'<td><a class="btn btn-info"href="index.php?page=modifierarcticle&Article='.$row['id'].'"> modifier </a> </td>';
    echo '</td></tr>';
}
echo '</table>';
?>
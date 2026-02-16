<h1>Liste des Articles</h1>
<?php
echo '<table> <tr> <th>Sujet</th> <th>datedepublication</th> <th>modifier</th></tr>';
$article = new Article($dbh);
$articles = $article->select();
foreach ($articles as $row) {
    echo '<tr> <td>';
   echo  $row['sujet'] . "\t";
   echo '</td><td>';
    echo  $row['datedepublication'] . "\t";
    echo'<td><a class="btn btn-info"href="index.php?page=modifierarticle&Article='.$row['id'].'"> modifier </a> </td>';
    echo '</td></tr>';
}
echo '</table>';
?>
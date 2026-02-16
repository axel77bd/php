<h1>Liste des contact</h1>
<?php
$contact= new Contact($dbh);
$contacts=$contat->select();
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
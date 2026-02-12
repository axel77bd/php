<div class="container text-center">
<div class="row justify-content-center">
    <div class="col-12 col-md-10  text-center">
<h1>BIENVENUE SUR MON SITE </h1>
<div class="row row-cols-1 row-cols-md-4 g-4">
<?php
$article = new Article($dbh);
$articles = $article->select();
foreach ($articles as $row) {
   echo' <div class="col">';
    echo '<div class="card " style=" ">
  <img src="images/' . $row['image'] . '" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $row['sujet'] . '</h5>
    <p class="card-text">' . substr($row['contenu'], 0, 100) . '...</p>
    <a href="index.php?page=lirearticle&Article=' . $row['id'] . '" class="btn btn-primary">lire la suite </a>

  </div>
  <div class="card-footer">
  ' . $row['datedepublication'] . '
  </div>
  </div>
</div>';
}

?>
</div>
</div>
</div>
</div>
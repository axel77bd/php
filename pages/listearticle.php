
<?php

$article = new Article($dbh);
$articles = $article->select();
echo $twig->render('listearticle.html.twig',['articles'=>$articles]);

?>
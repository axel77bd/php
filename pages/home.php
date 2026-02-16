
<?php
$article = new Article($dbh);
$articles = $article->select();
echo $twig->render('home.html.twig',['articles'=>$articles]);



?>

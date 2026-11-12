<?php
// la page demandée n'existe pas : on répond avec le code 404
http_response_code(404);
echo $twig->render('error404.html.twig', ['messages' => $messages]);

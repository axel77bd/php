<?php
// la base de données n'est pas disponible : on répond avec le code 503 (service indisponible)
http_response_code(503);
echo $twig->render('maintenance.html.twig', ['messages' => $messages]);

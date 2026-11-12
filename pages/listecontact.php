<?php
$contact = new Contact($dbh);
$contacts = $contact->select();
echo $twig->render('listecontact.html.twig', ['contacts' => $contacts, 'messages' => $messages]);

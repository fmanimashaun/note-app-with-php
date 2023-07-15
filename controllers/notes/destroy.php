<?php

use Core\Database;

$config = require base_path('config.php');

$db = new DataBase($config['database']);

$currentUser = 1;

// get the id from the url
$id = $_POST['id'];

// get the note from the database
$note = $db->query(
  'SELECT * FROM notes where id = :id',
  [
    'id' => $id
  ]
)->findOrFail();

// check if the user is the owner of the note
$isUser = $note['user_id'] === $currentUser;

// if not, abort and show 403 page
authorize($isUser);

// if yes, delete the note
$db->query(
  'DELETE FROM notes WHERE id = :id',
  [
    'id' => $id
  ]
);

// redirect to the notes page
header('Location: /notes');
exit();
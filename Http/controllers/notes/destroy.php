<?php

use Core\Database;
use Core\App;

// resolve the database class from the container
$db = App::resolve(Database::class);

$currentUser = $_SESSION['user']['user_id'];

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
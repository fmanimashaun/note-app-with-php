<?php

use Core\Database;
use Core\Validator;
use Core\App;

require base_path('Core/validator.php');

// resolve the database class from the container
$db = App::resolve(Database::class);

$currentUser = $_SESSION['user']['user_id'];
$errors = [];

// find the note
$note = $db->query(
  'SELECT * FROM notes where id = :id',
  [
    'id' => $_POST['id']
  ]
)->findOrFail();

// check if the user is the owner of the note
$isUser = $note['user_id'] === $currentUser;

// if not, abort and show 403 page
authorize($isUser);


// validate the body
if (!Validator::string($_POST['body'], 1, 1000)) {
  $error['body'] = 'Note body of no more than 1,000 characters is required';

  view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note
  ]);

} else {
  $db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
  ]);

  // redirect to the notes page
  header('Location: /notes');
  exit();
}
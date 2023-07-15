<?php

use Core\Database;
use Core\Validator;
use Core\App;

require base_path('Core/validator.php');

// resolve the database class from the container
$db = App::resolve(Database::class);

$currentUser = 1;
$errors = [];


if (!Validator::string($_POST['body'], 1, 1000)) {
  $error['body'] = 'Note body of no more than 1,000 characters is required';

  view('notes/create.view.php', [
    'heading' => 'Add Note',
    'errors' => $errors,
  ]);
  
} else {
  $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => $currentUser
  ]);

  // redirect to the notes page
  header('Location: /notes');
  exit();
}
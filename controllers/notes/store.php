<?php

use Core\Database;
use Core\Validator;

require base_path('Core/validator.php');

$config = require base_path('config.php');

$db = new DataBase($config['database']);

$currentUser = 1;
$error = [];


if (!Validator::string($_POST['body'], 1, 1000)) {
  $error['body'] = 'Note body of no more than 1,000 characters is required';

  view('notes/add.view.php', [
    'heading' => 'Add Note',
    'error' => $error,
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
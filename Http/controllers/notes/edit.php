<?php

// reference the DataBase class namespace
use Core\Database;
use Core\App;

// resolve the database class from the container
$db = App::resolve(Database::class);

// get the current user id
$currentUser = $_SESSION['user']['user_id'];

// get the id from the url
$id = $_GET['id'];

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

view('notes/edit.view.php', [
  'heading' => 'Edit Note',
  'error' => [],
  'note' => $note,
]);
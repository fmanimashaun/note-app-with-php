<?php

// reference the DataBase class namespace
use Core\DataBase;

// gett the config file
$config = require base_path('config.php');

// create a new instance of the DataBase class
$db = new DataBase($config['database']);

// get the current user id
$currentUser = 1;


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

// show the note
view('notes/show.view.php', [
  'heading' => 'Note',
  'note' => $note,
]);
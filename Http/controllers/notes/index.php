<?php

use Core\Database;
use Core\App;

// resolve the database class from the container
$db = App::resolve(Database::class);

$currentUser = $_SESSION['user']['user_id'];


$notes = $db->query('SELECT * FROM notes where user_id = :id', [
  'id' => $currentUser
])->get();

view('notes/index.view.php', [
  'heading' => 'My Note List',
  'notes' => $notes,
]);
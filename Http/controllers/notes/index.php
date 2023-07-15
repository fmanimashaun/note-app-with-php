<?php

use Core\Database;
use Core\App;

// resolve the database class from the container
$db = App::resolve(Database::class);

$notes = $db->query('SELECT * FROM notes where user_id = 1')->get();

view('notes/index.view.php', [
  'heading' => 'My Note List',
  'notes' => $notes,
]);
<?php

use Core\DataBase;

$config = require base_path('config.php');

$db = new DataBase($config['database']);

$notes = $db->query('SELECT * FROM notes where user_id = 1')->get();

view('notes/index.view.php', [
  'heading' => 'My Note List',
  'notes' => $notes,
]);
<?php

// imporrt core classes
use Core\Validator;
use Core\App;
use Core\Database;

// get email and password from request
$email = $_POST['email'];
$password = $_POST['password'];

// initialize errors array
$errors = [];

// Validate email
if (!Validator::email($email) || !Validator::string($password, 8, 255)) {
  if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email';
  } else {
    $errors['password'] = 'password must be at least 8 characters long';
  }
  view('registration/create.view.php', [
    'errors' => $errors
  ]);
} else {

  // resolve the database class from the container
  $db = App::resolve(Database::class);

  // check if email exists
  $user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
  ])->find();

  // if email exists, show error
  if ($user) {
    $errors['email'] = 'Email already exists';
    view('registration/create.view.php', [
      'errors' => $errors
    ]);
  } else {
    // create user
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark user as logged in
    login([
      'email' => $email
    ]);

    header('Location: /');
    exit();

  }

}
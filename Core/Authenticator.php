<?php

namespace Core;

use Core\APP;
use Core\Database;
use Core\Session;

class Authenticator
{
  public function attempt($email, $password)
  {
    // resolve the database class from the container
    $db = App::resolve(Database::class);

    // check if email exists
    $user = $db->query('SELECT * FROM users WHERE email = :email', [
      'email' => $email
    ])->find();

    // if email exists, check if password is correct
    if ($user) {
      if (password_verify($password, $user['password'])) {
        // mark user as logged in
        $this->login($user);

        return true;
      }

      return false;
    }
  }


  public function register($email, $password)
  {
    // resolve the database class from the container
    $db = App::resolve(Database::class);

    // check if email exists
    $user = $db->query('SELECT * FROM users WHERE email = :email', [
      'email' => $email
    ])->find();

    // if email exists, check if password is correct
    if (!$user) {
      // create user
      $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
      ]);

      // fetch the newly created user
      $user = $db->query('SELECT * FROM users WHERE email = :email', [
        'email' => $email
      ])->find();

      // mark user as logged in
      $this->login($user);

      return true;
    }

    return false;
  }

  public function login($user)
  {
    $_SESSION['user'] = [
      'email' => $user['email'],
      'user_id' => $user['id'],
    ];

    session_regenerate_id(true);
  }

  public function logout()
  {
    Session::destroy();
  }
}
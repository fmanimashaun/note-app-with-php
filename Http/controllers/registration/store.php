<?php

// imporrt core classes
use Core\Authenticator;
use Http\Forms\RegistrationForm;

// validate email and password
$form = RegistrationForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);

$register = (new Authenticator)->register($attributes['email'], $attributes['password']);

// if email or password is incorrect, show error message
if (!$register) {
  $form->error('message', 'The email is registered already, please login')->throw();
}

// redirect to home page if sign in is successful
return redirect('/');


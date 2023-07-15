<?php

// imporrt core classes
use Core\Authenticator;
use Http\Forms\LoginForm;

// validate email and password
$form = LoginForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);

// attempt to sign in user
$signIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

// if email or password is incorrect, show error message
if (!$signIn) {
  $form->error('message', 'Email or password is incorrect')->throw();
}

// redirect to home page if sign in is successful
return redirect('/');
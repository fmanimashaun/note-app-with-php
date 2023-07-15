<?php
use Core\Authenticator;

// logout user
(new Authenticator)->logout();

// redirect to home page
redirect('/');
<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

// define the base path of the project
const BASE_PATH = __DIR__ . '/../';

// automatically load classes that are not explicitly defined
require BASE_PATH . 'vendor/autoload.php';

// start the session
session_start();

// load the helper functions
require BASE_PATH . 'Core/functions.php';

// load the environment variables
require base_path('bootstrap.php');

// instantiate the router
$router = new Router();

// load the routes
$routes = require base_path('routes.php'); 

// define the routes
$url = parse_url($_SERVER['REQUEST_URI'])['path'];

// define the request method
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// try to route the request
try {
  $router->route($url, $method);
} catch (ValidationException $exception) {
  Session::flash('errors', $exception->errors);
  Session::flash('old', $exception->old);

  // if email or password is incorrect, show error message
  return redirect($router->previousUrl());
}

// clear the flash messages
Session::unflash();

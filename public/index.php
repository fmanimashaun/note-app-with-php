<?php

session_start();

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

// automatically load classes that are not explicitly defined

spl_autoload_register(function ($class) {

  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  
  require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('routes.php'); 

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



try {
  $router->route($url, $method);
} catch (ValidationException $exception) {
  Session::flash('errors', $exception->errors);
  Session::flash('old', $exception->old);

  // if email or password is incorrect, show error message
  return redirect($router->previousUrl());
}

Session::unflash();

<?php

use Core\Response;
use Core\Session;

function dd($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}

function urlIs($page)
{
  return $_SERVER['REQUEST_URI'] === $page;
}

function abort ($code = 404)
{
  http_response_code($code);
  require base_path("controllers/{$code}.php");
  die();
}

function routeToControlleer($pageUrl, $routesArray) {
  if (array_key_exists($pageUrl, $routesArray)) {
    require base_path($routesArray[$pageUrl]);
  } else {
    abort();
  }
}

function authorize($condition)
{
  if (!$condition) {
    abort(Response::HTTP_FORBIDDEN);
  }
}

function base_path($path)
{
  return BASE_PATH . $path;
}

function view($path, $attribute = [])
{
  extract($attribute);

  require base_path('views/' . $path);
}

function redirect($path)
{
  header("Location: {$path}");
  exit();
}

function old($key)
{
  return Session::get('old')[$key] ?? '';
}
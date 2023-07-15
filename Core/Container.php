<?php

namespace Core;
use Exception;

class Container
{

  protected $bindings = [];
  public function bind($key, $func)
  {
    $this->bindings[$key] = $func;
  }

  public function resolve($key)
  {
    if (!array_key_exists($key, $this->bindings)) {
      var_dump($key);
      var_dump($this->bindings);
      throw new Exception("No {$key} is bound in the container.");
    }
    return call_user_func($this->bindings[$key]);
  }
}
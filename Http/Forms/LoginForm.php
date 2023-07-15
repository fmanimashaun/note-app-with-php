<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class LoginForm
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    // Validate email and password
    if (!Validator::email($attributes['email'])) {
      $this->errors['email'] = 'Please enter a valid email';

    } else if (!Validator::string($attributes['password'])) {
      $this->errors['password'] = 'Please enter a valid password';
    }
  }
  public static function validate($attributes)
  {
    $instance = new static($attributes);

    return $instance->failed() ? $instance->throw() : $instance;
    
  }

  public function  failed()
  {
    return count($this->errors);
  }

  public function throw ()
  {
    ValidationException::throw($this->errors(), $this->attributes);
  }

  public function errors()
  {
    return $this->errors;
  }

  public function error ($key, $value)
  {
    $this->errors[$key] = $value;

    return $this;
  }
}
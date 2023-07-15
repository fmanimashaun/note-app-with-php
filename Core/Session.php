<?php

namespace Core;

class Session
{
  public static function put($key, $value)
  {
    $_SESSION[$key] = $value;
  }
  
  public static function get($key)
  {
    return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? null;
  }

  public static function flash($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }

  public static function unflash()
  {
    unset($_SESSION['_flash']);
  }

  public static function has($key)
  {
    return (bool) static::get($key);
  }

  public static function flush()
  {
    $_SESSION = [];
  }

  public static function destroy()
  {
    static::flush();

    session_destroy();

    // get session cookie params
    $params = session_get_cookie_params();

    // unset session cookie
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params['path'],
      $params['domain'],
      $params['secure'],
      $params['httponly']
    );

  }
}
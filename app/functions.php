<?php

if (!function_exists('PDO')) {
  function PDO(): PDO
  {
    global $PDO;
    return $PDO;
  }
}

if (!function_exists('AUTHGUARD')) {
  function AUTHGUARD(): App\SessionGuard
  {
    global $AUTHGUARD;
    return $AUTHGUARD;
  }
}

if (!function_exists('dd')) {
  function dd($var)
  {
    var_dump($var);
    exit();
  }
}

if (!function_exists('redirect')) {
  function redirect($location, array $data = [])
  {
    foreach ($data as $key => $value) {
      $_SESSION[$key] = $value;
    }

    header('Location: ' . $location, true, 302);
    exit();
  }
}

if (!function_exists('session_get_once')) {
  function session_get_once($name, $default = null)
  {
    $value = $default;
    if (isset($_SESSION[$name])) {
      $value = $_SESSION[$name];
      unset($_SESSION[$name]);
    }
    return $value;
  }
}

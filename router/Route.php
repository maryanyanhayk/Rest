<?php

class Route
{
  public $method;

  public function add($route, $file)
  {
    if (!empty($_SERVER["REQUEST_URI"])) {
      $route = preg_replace("/(^\/)|(\/$)/", "", $route);
      $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $_SERVER["REQUEST_URI"]);
    } else {
      $reqUri = "/";
    }

    if ($reqUri == $route) {

      //on match include the file.
      include($file);

      //exit because route address matched.
      exit();
    }
  }

  public function getMethod()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    return $this->method;
  }
}

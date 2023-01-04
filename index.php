<?php
define('BASE_PATH', rtrim(preg_replace('#[/\\\\]{1,}#', '/', __DIR__), '/') . '/');
require(BASE_PATH.'/router/Route.php');

$route = new Route;

$route->add("/rooms", BASE_PATH."/rest-api/models/room/listRooms.php");
$route->add("/filter-rooms", BASE_PATH."/rest-api/models/room/listRooms.php");

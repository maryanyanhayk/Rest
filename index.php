<?php
define('BASE_PATH', rtrim(preg_replace('#[/\\\\]{1,}#', '/', __DIR__), '/') . '/');
require(BASE_PATH . '/router/Route.php');

$route = new Route;
/**
 * Routing for rooms
 */
$route->add("/create-room", BASE_PATH . "/rest-api/models/room/createRoom.php");
$route->add("/rooms", BASE_PATH . "/rest-api/models/room/listRooms.php");
$route->add("/update-room", BASE_PATH . "/rest-api/models/room/updateRoom.php");
$route->add("/delete-room", BASE_PATH . "/rest-api/models/room/deleteRoom.php");
$route->add("/filter-rooms", BASE_PATH . "/rest-api/models/room/listRooms.php");

/**
 * Routing for reservations
 */
$route->add("/create-reservation", BASE_PATH . "/rest-api/models/reservation/createReservation.php");
$route->add("/update-reservation", BASE_PATH . "/rest-api/models/reservation/updateReservation.php");
$route->add("/delete-reservation", BASE_PATH . "/rest-api/models/reservation/deleteReservation.php");
$route->add("/move-reservation", BASE_PATH . "/rest-api/models/reservation/moveReservation.php");
$route->add("/resize-reservation", BASE_PATH . "/rest-api/models/reservation/resizeReservation.php");

$route->add("/reservations", BASE_PATH . "/rest-api/models/reservation/listReservations.php");


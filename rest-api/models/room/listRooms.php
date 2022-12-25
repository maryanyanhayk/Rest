<?php

header("Content-type: application/json; charset=UTF-8");
require_once('../../config.php');
require_once('../../autoload.php');
/* set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handlerExeption"); */

$json = file_get_contents('php://input');
$params = json_decode($json);

$database = new Database(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASS_);
$searchRoom = new SearchRoom($database);
$RoomController = new RoomController($searchRoom);

$capacity = isset($params->capacity) ? $params->capacity : '0';
$options = isset($params->options) ? $params->options : '0';
$hotels = isset($params->hotels) ? $params->hotels : '0';
$hoptions = isset($params->hoptions) ? $params->hoptions : '0';

$parts = explode("/", $_SERVER["REQUEST_URI"]);
$method = $_SERVER['REQUEST_METHOD'];

$RoomController->processRequest($method, $capacity, $options, $hotels, $hoptions);

<?php

header("Content-type: application/json; charset=UTF-8");
require_once(BASE_PATH . '/rest-api/config.php');
require_once(BASE_PATH . '/rest-api/autoload.php');

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handlerExeption");

$json = file_get_contents('php://input');
$params = json_decode($json);

$database = new Database(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASS_);

$searchRoom = new SearchRoom($database);
$RoomController = new RoomController($searchRoom);

$conn = $database->getConnection();

$stmt = $conn->prepare("UPDATE reservations SET name = :name, start = :start, end = :end, room_id = :room, status = :status, paid = :paid WHERE id = :id");

$stmt->bindParam(':id', $params->id);
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':room', $params->resource);
$stmt->bindParam(':status', $params->status);
$stmt->bindParam(':paid', $params->paid);
$stmt->execute();

$response = new Response;
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);

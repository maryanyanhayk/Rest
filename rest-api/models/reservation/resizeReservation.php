<?php

header("Content-type: application/json; charset=UTF-8");
require_once('../../config.php');
require_once('../../autoload.php');
set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handlerExeption");

$json = file_get_contents('php://input');
$params = json_decode($json);

$database = new Database(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASS_);

$searchRoom = new SearchRoom($database);
$RoomController = new RoomController($searchRoom);

$conn = $database->getConnection();

$stmt = $conn->prepare("UPDATE reservations SET start = :start, end = :end WHERE id = :id");
$stmt->bindParam(':start', $params->newStart);
$stmt->bindParam(':end', $params->newEnd);
$stmt->bindParam(':id', $params->id);
$stmt->execute();

class Result
{
}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);

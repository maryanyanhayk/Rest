<?php

header("Content-type: application/json; charset=UTF-8");
require_once('../../config.php');
require_once('../../autoload.php');
set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handlerExeption");

$json = file_get_contents('php://input');
$params = json_decode($json);

$database = new Database(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASS_);

$conn = $database->getConnection();

$stmt = $conn->prepare("INSERT INTO reservations (name, start, end, room_id, status, paid) VALUES (:name, :start, :end, :room, 'New', 0)");
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':room', $params->resource);
$stmt->execute();

class Result
{
}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: ' . $conn->lastInsertId();

$response->id = $conn->lastInsertId();
$response->status = "New";
$response->paid = 0;

header('Content-Type: application/json');
echo json_encode($response);

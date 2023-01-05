<?php

header("Content-type: application/json; charset=UTF-8");
require_once(BASE_PATH . '/rest-api/config.php');
require_once(BASE_PATH . '/rest-api/autoload.php');

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handlerExeption");

$json = file_get_contents('php://input');
$params = json_decode($json);

$database = new Database(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASS_);

$conn = $database->getConnection();
try {
    $stmt  = $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO rooms (name, capacity, status, hotel_id) VALUES (:name, :capacity, 'Ready', :hotel_id)");
    $stmt->bindValue(':name', $params->name);
    $stmt->bindParam(':capacity', $params->capacity);
    $stmt->bindParam(':hotel_id', $params->hotels);
    $stmt->execute();

    $lastInserId = $conn->lastInsertId();
    $stmt = $conn->prepare("INSERT INTO room_to_options (room_id, option_id) VALUES (:room_id, :option_id)");
    $stmt->bindParam(':option_id', $params->options);
    $stmt->bindParam(':room_id', $lastInserId);
    $stmt->execute();
    $conn->commit();
} catch (PDOException $ex) {
    $conn->rollBack();
    throw $ex;
}

$response = new Response;

$response->result = 'OK';
$response->message = 'Created with id: ' . $lastInserId;
$response->id = $lastInserId;
$response->status = "Ready";

header('Content-Type: application/json');
echo json_encode($response);

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

$start = $_GET['start'];
$end = $_GET['end'];

$stmt = $conn->prepare("SELECT * FROM reservations WHERE NOT ((end <= :start) OR (start >= :end))");
$stmt->bindParam(':start', $start);
$stmt->bindParam(':end', $end);
$stmt->execute();
$result = $stmt->fetchAll();

class Event
{
}
$events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);

foreach ($result as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['start'];
    $e->end = $row['end'];
    $e->resource = $row['room_id'];
    $e->bubbleHtml = "Reservation details: <br/>" . $e->text;

    // additional properties
    $e->status = $row['status'];
    $e->paid = intval($row['paid']);
    $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);

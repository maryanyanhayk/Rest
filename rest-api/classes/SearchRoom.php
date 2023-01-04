<?php

class SearchRoom
{
    private $conn;
    private $rooms;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }


    public function getAll(string $capacity, string $options, string $hotels, string $hoptions): array
    {
        $result = [];
        if ($capacity == '0' && $options == '0' && $hotels == '0' && $hoptions == '0') {
            $stmt = $this->conn->prepare("
            select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
            hotels.name as hname, rooms.id, rooms.name, capacity, status, 
            (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
            join room_to_options on rooms.id = room_to_options.room_id 
            join room_options on room_options.id = room_to_options.option_id 
            join hotels on rooms.hotel_id = hotels.id 
            join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
            join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
            group by rooms.id");
        }

        $stmt->execute();
        $this->rooms =  $stmt->fetchAll();

        foreach ($this->rooms as $room) {
            $r = [];
            $r['id'] = $room['id'];
            $r['name'] = $room['name'];
            $r['capacity'] = intval($room['capacity']);
            $r['status'] = $room['status'];
            $r['options'] = $room['options'];
            $r['hotels'] = $room['hname'];
            $r['hoptions'] = $room['hoptions'];
            $result[] = $r;
        }

        return $result;
    }


    public function filterRoom(string $capacity, string $options, string $hotels, string $hoptions): array
    {
        $result = [];
        if ($hoptions == '0') {
            if ($capacity == '0' && $options == '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("
                select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, 
                (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                group by rooms.id");
            } elseif ($capacity == '0' && $options != '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) AS hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, 
                (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE room_options.id = :options AND hotels.id = :hotels group by rooms.id");
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hotels', $hotels);
            } elseif ($capacity != '0' && $options == '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) AS hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status,
                (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND hotels.id = :hotels group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':hotels', $hotels);
            } elseif ($capacity == '0' && $options == '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) AS hoptions,
                hotels.name as hname, rooms.id, rooms.name, capacity, status,
                (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE hotels.id = :hotels group by rooms.id");
                $stmt->bindValue(':hotels', $hotels);
            } elseif ($capacity == '0' && $options != '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE room_options.id = :options group by rooms.id");
                $stmt->bindValue(':options', $options);
            } elseif ($capacity != '0' && $options == '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions,
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
            } elseif ($capacity != '0' && $options != '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND room_options.id = :options group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':options', $options);
            } else {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND room_options.id = :options AND hotels.id = :hotels group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hotels', $hotels);
            }
        } else {
            if ($capacity == '0' && $options == '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE hotel_options.id = :hoptions group by rooms.id");
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity == '0' && $options != '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE room_options.id = :options AND hotels.id = :hotels AND hotel_options.id = :hoptions group by rooms.id");
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hotels', $hotels);
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity != '0' && $options == '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND hotels.id = :hotels AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':hotels', $hotels);
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity == '0' && $options == '0' && $hotels != '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE hotels.id = :hotels AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':hotels', $hotels);
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity == '0' && $options != '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE room_options.id = :options AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity != '0' && $options == '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':hoptions', $hoptions);
            } elseif ($capacity != '0' && $options != '0' && $hotels == '0') {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions,
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND room_options.id = :options AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hoptions', $hoptions);
            } else {
                $stmt = $this->conn->prepare("select GROUP_CONCAT(DISTINCT hotel_options.name) as hoptions, 
                hotels.name as hname, rooms.id, rooms.name, capacity, status, (GROUP_CONCAT(DISTINCT opname SEPARATOR ', ')) AS options from rooms 
                join room_to_options on rooms.id = room_to_options.room_id 
                join room_options on room_options.id = room_to_options.option_id 
                join hotels on rooms.hotel_id = hotels.id 
                join hotel_to_options on hotels.id = hotel_to_options.hotels_id 
                join hotel_options on hotel_to_options.hotel_option_id = hotel_options.id 
                WHERE capacity = :capacity AND room_options.id = :options AND hotels.id = :hotels AND hotel_options.id= :hoptions group by rooms.id");
                $stmt->bindValue(':capacity', $capacity);
                $stmt->bindValue(':options', $options);
                $stmt->bindValue(':hotels', $hotels);
                $stmt->bindValue(':hoptions', $hoptions);
            }
        }

        $stmt->execute();
        $this->rooms =  $stmt->fetchAll();

        foreach ($this->rooms as $room) {
            $r = [];
            $r['id'] = $room['id'];
            $r['name'] = $room['name'];
            $r['capacity'] = intval($room['capacity']);
            $r['status'] = $room['status'];
            $r['options'] = $room['options'];
            $r['hotels'] = $room['hname'];
            $r['hoptions'] = $room['hoptions'];
            $result[] = $r;
        }

        return $result;
    }
}

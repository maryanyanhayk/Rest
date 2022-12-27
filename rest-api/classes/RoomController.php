<?php

class RoomController
{
    public function __construct(private SearchRoom $searchRoom)
    {
    }

    public function processRequest($method, $capacity, $options, $hotels, $hoptions)
    {
        $this->processCollectionRequest($method, $capacity, $options, $hotels, $hoptions);
    }


    private function processCollectionRequest($method, $capacity, $options, $hotels, $hoptions): void
    {
        switch ($method) {
            case "GET":
                $data = json_encode($this->searchRoom->getAll($capacity, $options, $hotels, $hoptions));
                echo  $data;
                break;

            case "POST":
                $data = json_encode($this->searchRoom->filterRoom($capacity, $options, $hotels, $hoptions));
                echo  $data;
                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST, PUT, DELETE");
        }
    }
}

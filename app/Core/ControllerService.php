<?php

namespace App\Core;

class ControllerService {

    public function json($data)
    {
        echo json_encode($data);
    }

}
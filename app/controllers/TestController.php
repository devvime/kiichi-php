<?php

namespace App\Controllers;

use App\Core\ControllerService;
use App\Core\HttpService;

class TestController extends ControllerService {

    public function index() {
        $this->json([
            "status"=>200,
            "data"=>"GET..."
        ]);
    }

    public function store() {
        $request = HttpService::request();
        $this->json([
            "status"=>200,
            "data"=>$request
        ]);
    }

    public function update() {
        $request = HttpService::request();
        $this->json([
            "status"=>200,
            "data"=>$request
        ]);
    }

    public function destroy() {
        $request = HttpService::request();
        $this->json([
            "status"=>200,
            "data"=>$request
        ]);
    }

}

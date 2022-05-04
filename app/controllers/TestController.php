<?php

namespace App\Controllers;

use App\Core\ControllerService;
use App\Core\HttpService;
use App\Controllers\Sql;

class TestController extends ControllerService {

    private static $usersModel;

    public function __construct()
    {
        self::$usersModel = new Sql('user');
    }

    public function index() {
        $result = self::$usersModel->select('id, name, email');
        $this->json([
            "status"=>200,
            "data"=>$result
        ]);
    }

    public function store() {
        $request = HttpService::request();
        $result = self::$usersModel->create($request);
        if ($result) {
            $this->index();
        }
    }

    public function update() {
        $request = HttpService::request();
        $result = self::$usersModel->update($request, "WHERE id = {$request['id']}");
        if ($result) {
            $this->index();
        }
    }

    public function destroy() {
        $request = HttpService::request();
        $result = self::$usersModel->destroy($request['id']);
        if ($result) {
            $this->index();
        }
    }

}

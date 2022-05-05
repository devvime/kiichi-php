<?php

namespace App\Controllers;

use App\Core\ControllerService;
use App\Core\HttpService;
use App\Core\SqlService;

class UserController extends ControllerService {

    private static $usersModel;

    public function __construct()
    {
        self::$usersModel = new SqlService('user');
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
        HttpService::validate($request, 'name', 'required');
        HttpService::validate($request, 'name', 'minValue', 4);
        HttpService::validate($request, 'name', 'maxValue', 100);
        HttpService::validate($request, 'email', 'required');
        HttpService::validate($request, 'email', 'isEmail');
        HttpService::validate($request, 'password', 'required');
        $result = self::$usersModel->create($request);
        if ($result) {
            $this->index();
        }
    }

    public function update() {
        $request = HttpService::request();
        HttpService::validate($request, 'id', 'required');
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

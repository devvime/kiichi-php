<?php

namespace App\Controllers;

use App\Core\ControllerService;
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

    public function find($request)
    {
        echo json_encode($request);
    }

    public function store($request) {
        $this->validate($request, 'name', 'required');
        $this->validate($request, 'name', 'minValue', 4);
        $this->validate($request, 'name', 'maxValue', 100);
        $this->validate($request, 'email', 'required');
        $this->validate($request, 'email', 'isEmail');
        $this->validate($request, 'password', 'required');
        $result = self::$usersModel->create($request);
        if ($result) {
            $this->index();
        }
    }

    public function update($request) {
        $this->validate($request, 'id', 'required');
        $result = self::$usersModel->update($request, "WHERE id = {$request['id']}");
        if ($result) {
            $this->index();
        }
    }

    public function destroy($request) {
        $this->validate($request, 'id', 'required');
        $result = self::$usersModel->destroy($request['id']);
        if ($result) {
            $this->index();
        }
    }

}

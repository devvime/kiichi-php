<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use Devvime\Kiichi\Models\UserModel;

class UserController extends ControllerService {

    private static $userModel;

    public function __construct()
    {
        self::$userModel = new UserModel();
    }

    public function index($req, $res) {
        $result = self::$userModel->all();
        $res->json([
            "status"=>200,
            "data"=>$result
        ]);
    }

    public function find($req, $res)
    {
        $result = UserModel::find($req->params->id);
        if ($result == null) {
            $res->json(["status"=>404, "error"=>"Register Not Found..."]);
            exit;
        }
        $res->json([
            "staus"=>200,
            "data"=>$result
        ]);
    }

    public function store($req, $res) {
        $data = $this->bindValues($req->body, self::$userModel);        
        $result = $data->save();        
        if ($result) {
            $this->index($req, $res);
        }
    }

    public function update($req, $res) {
        $data = UserModel::find($req->params->id);
        if ($data == null) {
            $res->json(["status"=>404, "error"=>"Register Not Found..."]);
            exit;
        }
        $data = $this->bindValues($req->body, $data);
        $result = $data->save();
        if ($result) {
            $this->find($req, $res);
        }
    }

    public function destroy($req, $res) {
        $data = UserModel::find($req->params->id);
        if ($data == null) {
            $res->json(["status"=>404, "error"=>"Register not found!"]);
            exit;
        }
        $result = $data->delete();
        if ($result) {
            $this->index($req, $res);
        }
    }
}

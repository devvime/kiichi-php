<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use Devvime\Kiichi\Models\UserModel;

class UserController extends ControllerService
{

  private static $userModel;

  public function __construct()
  {
    self::$userModel = new UserModel();
  }

  public function index($req, $res)
  {
    $result = $this->paginate($req, self::$userModel->select('id', 'name', 'email', 'createdAt'));
    $res->json($result);
  }

  public function find($req, $res)
  {
    $result = UserModel::find($req->params->id, ['id', 'name', 'email']);
    if ($result == null) {
      $res->json(["status" => 404, "error" => "Register Not Found..."]);
      exit;
    }
    $res->json([
      "status" => 200,
      "success" => true,
      "data" => $result
    ]);
  }

  public function store($req, $res)
  {
    $this->validate($req->body, 'name', 'required');
    $this->validate($req->body, 'email', 'required');
    $this->validate($req->body, 'email', 'isEmail');
    $this->validate($req->body, 'password', 'required');
    $existData = UserModel::select('id')->where('email', $req->body->email)->first();
    if ($existData === null) {
      $req->body->password = $this->jwtEncrypt($req->body->password);
      $data = $this->bindValues($req->body, self::$userModel);
      $result = $data->save();
      if ($result) {
        $this->index($req, $res);
      }
    } else {
      $res->json([
        "status" => 400,
        "error" => true,
        "message" => "This email already registered!",
      ]);
    }
  }

  public function update($req, $res)
  {
    $data = UserModel::find($req->params->id);
    if ($data == null) {
      $res->json(["status" => 404, "error" => true, "message" => "Register Not Found..."]);
      exit;
    }
    if (isset($req->body->password)) {
      $data->password = $this->jwtEncrypt($req->body->password);
    }
    $data = $this->bindValues($req->body, $data);
    $result = $data->save();
    if ($result) {
      $this->find($req, $res);
    }
  }

  public function destroy($req, $res)
  {
    $data = UserModel::find($req->params->id);
    if ($data == null) {
      $res->json(["status" => 404, "error" => true, "message" => "Register not found!"]);
      exit;
    }
    $result = $data->delete();
    if ($result) {
      $this->index($req, $res);
    }
  }
}

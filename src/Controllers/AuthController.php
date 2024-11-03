<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use Devvime\Kiichi\Models\AuthModel;

class AuthController extends ControllerService
{

  private static $authModel;

  public function __construct()
  {
    self::$authModel = new AuthModel();
  }

  public function index($req, $res)
  {
    $user = AuthModel::select('id', 'name', 'email')
      ->where('email', $req->body->email)
      ->where('password', $this->jwtEncrypt($req->body->password))->first();
    if ($user !== null) {
      $token = $this->jwtEncrypt($user);

      session_set_cookie_params([
        'lifetime' => 0,
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
      ]);
      session_regenerate_id(true);

      $_SESSION['token'] = $token;

      $res->json([
        "status" => 200,
        "success" => true,
        "message" => "Login success!",
      ]);
    } else {
      $res->json([
        "status" => 401,
        "error" => true,
        "message" => "Email or password incorrect!"
      ]);
    }
  }
}

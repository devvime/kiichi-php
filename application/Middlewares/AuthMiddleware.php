<?php

namespace Devvime\Kiichi\Middlewares;

use Devvime\Kiichi\Engine\HttpService;
use Devvime\Kiichi\Engine\ControllerService;
use Firebase\JWT\JWT;

class AuthMiddleware
{

  private $httpService;
  private $controllerService;

  public function __construct()
  {
    $this->httpService = new HttpService;
    $this->controllerService = new ControllerService;
  }

  public function index($req, $res)
  {
    if (isset($_SESSION['token'])) {
      $token = JWT::decode($_SESSION['token'], SECRET, array('HS256'));
      if ($token) {
        return true;
      } else {
        $res->json([
          "status" => 401,
          "error" => true,
          "message" => "Token is invalid"
        ]);
      }
    } else {
      $res->json([
        "status" => 401,
        "error" => true,
        "message" => "You are not logged in!"
      ]);
      exit;
    }
  }

  public function verify($req, $res)
  {
    $token = $this->httpService->verifyAuthToken();
    $res->json([
      "status" => 200,
      "result" => $this->controllerService->jwtEncrypt($token)
    ]);
    exit;
  }
}

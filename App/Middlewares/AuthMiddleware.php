<?php

namespace Devvime\Kiichi\Middlewares;

use Devvime\Kiichi\Engine\HttpService;
use Devvime\Kiichi\Engine\ControllerService;

class AuthMiddleware {

    private $httpService;
    private $controllerService;

    public function __construct()
    {
        $this->httpService = new HttpService;
        $this->controllerService = new ControllerService;
    }

    public function index($req, $res)
    {
        $this->httpService->verifyAuthToken();
    }

    public function verify($req, $res)
    {
        $token = $this->httpService->verifyAuthToken();
        $res->json([
            "status"=>200,
            "result"=>$this->controllerService->jwtEncrypt($token)
        ]);
        exit;
    }

}
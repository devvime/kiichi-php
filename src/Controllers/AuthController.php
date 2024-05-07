<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use Devvime\Kiichi\Models\AuthModel;

class AuthController extends ControllerService {

    private static $authModel;

    public function __construct()
    {
        self::$authModel = new AuthModel();
    }

    public function index($req, $res) 
    {
        $user = AuthModel::select('id','name','email')
        ->where('email', $req->body->email)
        ->where('password', $this->jwtEncrypt($req->body->password))->first();
        if ($user !== null) {
            $token = $this->jwtEncrypt($user);
            $res->json([
                "status"=>200,
                "token"=>$token
            ]);
        } else {
            $res->json([
                "status"=>401,
                "error"=>"Email or password incorrect!"
            ]);
        }
    }
    
}
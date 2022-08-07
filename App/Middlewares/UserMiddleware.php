<?php

namespace App\Middlewares;

class UserMiddleware {

    public function logged($req, $res)
    {
        if (!isset($req->query->test)) {
            $res->json(["message"=>"UserMiddleware is running..."]);
            exit;
        }
    }

}
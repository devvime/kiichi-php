<?php

namespace App\Core;

use App\Core\ViewService;
use Firebase\JWT\JWT;

class ControllerService {

    public function json($data)
    {
        echo json_encode($data);
    }

    public function validate($request, $type, $rule = '')
    {
        switch($type) {
            case('maxValue'):
                if (strlen($request) > $rule) {
                    echo json_encode(['error'=>"Input: '{$request}' exceeded the maximum character limit. Limit = {$rule}"]);
                    exit;
                }
            break;
            case('minValue'):
                if (strlen($request) < $rule) {
                    echo json_encode(['error'=>"Input: '{$request}' has not reached the minimum characters required. minimum characters = {$rule}"]);
                    exit;
                }
            break;
            case('required'):
                if (!isset($request) || $request === '' || $request === null) {
                    echo json_encode(['error'=>"Input: '{$request}' is required!"]);
                    exit;
                }
            break;
            case('isEmail'):
                if(!filter_var($request, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(['error'=>"this email '{$request}' is not valid."]);
                }
            break;
        }
    }

    public function render($file, $data = [])
    {
        header('Content-type: text/html; charset=utf-8');
        $viewService = new ViewService($data);
        $viewService->render($file, $data);
    }

    public function jwtEncrypt($value)
    {
        return JWT::encode($value, SECRET, 'HS256');
    }

    public function jwtDecrypt($value)
    {
        return JWT::decode($value, SECRET, array('HS256'));
    }

}
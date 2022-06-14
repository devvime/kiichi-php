<?php

namespace App\Core;

class ControllerService {

    public function json($data)
    {
        echo json_encode($data);
    }

    public function validate($request, $name, $type, $rule = '')
    {
        switch($type) {
            case('maxValue'):
                if (strlen($request[$name]) > $rule) {
                    echo json_encode(['error'=>"Input: '{$name}' exceeded the maximum character limit. Limit = {$rule}"]);
                    exit;
                }
            break;
            case('minValue'):
                if (strlen($request[$name]) < $rule) {
                    echo json_encode(['error'=>"Input: '{$name}' has not reached the minimum characters required. minimum characters = {$rule}"]);
                    exit;
                }
            break;
            case('required'):
                if (!isset($request[$name]) || $request[$name] === '' || $request[$name] === null) {
                    echo json_encode(['error'=>"Input: '{$name}' is required!"]);
                    exit;
                }
            break;
            case('isEmail'):
                if(!filter_var($request[$name], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(['error'=>"this email '{$request[$name]}' is not valid."]);
                }
            break;
        }
    }

}
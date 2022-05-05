<?php

namespace App\Core;

use App\Core\HttpService;

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
                    $this->json(['error'=>"Input: '{$name}' exceeded the maximum character limit. Limit = {$rule}"]);
                    exit;
                }
            break;
            case('minValue'):
                if (strlen($request[$name]) < $rule) {
                    $this->json(['error'=>"Input: '{$name}' has not reached the minimum characters required. minimum characters = {$rule}"]);
                    exit;
                }
            break;
            case('required'):
                if ($request[$name] === '' || $request[$name] === null) {
                    $this->json(['error'=>"Input: {$name} is required!"]);
                    exit;
                }
            break;
        }
    }

}
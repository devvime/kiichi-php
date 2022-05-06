<?php

if ($argv[2] === '' || $argv[2] === null) {
    echo "\033[01;31m==========================================ERROR======================================================= \033[0m \n";
    echo "\033[01;31mNeed to inform the name of the database table! EX: composer create-controller ControllerName TableName \033[0m \n";
    echo "\033[01;31m====================================================================================================== \033[0m \n";
    exit;
}

$conteudo = strval('<?php

namespace App\Controllers;

use App\Core\ControllerService;
use App\Core\HttpService;
use App\Core\SqlService;

class '.$argv[1].' extends ControllerService {

    private static $'.$argv[2].'Model;

    public function __construct()
    {
        self::$'.$argv[2].'Model = new SqlService("'.$argv[2].'");
    }

    public function index() {
        $result = self::$'.$argv[2].'Model->select("*");
        $this->json([
            "status"=>200,
            "data"=>$result
        ]);
    }

    public function store() {
        $request = HttpService::request();
        $result = self::$'.$argv[2].'Model->create($request);
        if ($result) {
            $this->index();
        }
    }

    public function update() {
        $request = HttpService::request();
        HttpService::validate($request, "id", "required");
        $result = self::$'.$argv[2].'Model->update($request, "WHERE id = {$request["id"]}");
        if ($result) {
            $this->index();
        }
    }

    public function destroy() {
        $request = HttpService::request();
        HttpService::validate($request, "id", "required");
        $result = self::$'.$argv[2].'Model->destroy($request["id"]);
        if ($result) {
            $this->index();
        }
    }
}
');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "app/Controllers/{$argv[1]}.php")) {
    echo "\033[03;33m======================================WARNING=========================================== \033[0m \n";
    echo "\033[03;33mThe controller '".$argv[1]."' already exists in 'app/Controllers/".$argv[1].".php' \033[0m \n";
    echo "\033[03;33m======================================================================================== \033[0m \n";
    exit;
} else {
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "app/Controllers/{$argv[1]}.php","wb");
    fwrite($fp,$conteudo);
    fclose($fp);
    echo "\033[02;32m===========================SUCCESS========================= \033[0m \n";
    echo "\033[02;32mController created in 'app/Controllers/".$argv[1].".php' \033[0m \n";
    echo "\033[02;32m=========================================================== \033[0m \n";
}

?>
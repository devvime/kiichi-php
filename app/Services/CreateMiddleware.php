<?php

if ($argv[1] === '' || $argv[1] === null) {
    echo "\033[01;31m==========================================ERROR========================================= \033[0m \n";
    echo "\033[01;31mNeed to inform the name of the middleware! EX: composer new-middleware NameMiddleware \033[0m \n";
    echo "\033[01;31m======================================================================================== \033[0m \n";
    exit;
}

$content = strval('<?php

namespace App\Middlewares;

class '.$argv[1].' {

    public function index($req, $res) {
        // 
    }
}
');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "App/Middlewares/{$argv[1]}.php")) {
    echo "\033[03;33m======================================WARNING========================================= \033[0m \n";
    echo "\033[03;33mThe controller '".$argv[1]."' already exists in 'app/Middlewares/".$argv[1].".php' \033[0m \n";
    echo "\033[03;33m====================================================================================== \033[0m \n";
    exit;
} else {
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "App/Middlewares/{$argv[1]}.php","wb");
    fwrite($fp, $content);
    fclose($fp);
    echo "\033[02;32m===========================SUCCESS======================== \033[0m \n";
    echo "\033[02;32mMiddleware created in 'App/Middlewares/".$argv[1].".php' \033[0m \n";
    echo "\033[02;32m========================================================== \033[0m \n";
}

?>
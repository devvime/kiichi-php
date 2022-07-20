<?php

if ($argv[1] === '' || $argv[1] === null) {
    echo "\033[01;31m==========================================ERROR=================================================== \033[0m \n";
    echo "\033[01;31mNeed to inform the name of the emailController! EX: composer new-mail NameController \033[0m \n";
    echo "\033[01;31m================================================================================================== \033[0m \n";
    exit;
}

$content = strval('<?php

namespace App\Controllers;

use App\Core\EmailService;

class '. $argv[1] .' extends EmailService {

    public $mail;

    public function __construct()
	{       
        $this->mail = new EmailService();
    }

    public function index()
    {
        $subject = "Email Subject";
        $altbody = "Eamil AltBody";

        $body = "
            <h1>Hello World!</h1>
            <p>Lorem Ipsum</p>
        ";

        try {
            $this->mail->set("sender@email.com.br", "Sender Name");
            $this->mail->add("recipient@email.com.br", "Recipient Name");
            $this->mail->content($subject,$body,$altbody);
            $this->mail->send();
            return true;

        } catch (\Exception $e) {
            echo "Error sending email!: {$this->mail->ErrorInfo}";
        }
    }

}
');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "App/Controllers/{$argv[1]}.php")) {
    echo "\033[03;33m======================================WARNING========================================= \033[0m \n";
    echo "\033[03;33mThe controller '".$argv[1]."' already exists in 'app/Controllers/".$argv[1].".php' \033[0m \n";
    echo "\033[03;33m====================================================================================== \033[0m \n";
    exit;
} else {
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "App/Controllers/{$argv[1]}.php","wb");
    fwrite($fp, $content);
    fclose($fp);
    echo "\033[02;32m===========================SUCCESS=========================== \033[0m \n";
    echo "\033[02;32mController created in 'App/Controllers/".$argv[1].".php' \033[0m \n";
    echo "\033[02;32m============================================================= \033[0m \n";
}

?>
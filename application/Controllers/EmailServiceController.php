<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailServiceController extends ControllerService
{

  public $mail;

  public function __construct()
  {
    $this->mail = new PHPMailer();
    $this->mail->isSMTP();
    $this->mail->Host = EMAIL_HOST;
    $this->mail->Port = EMAIL_PORT;
    $this->mail->SMTPAuth = true;
    $this->mail->Username = EMAIL_USER;
    $this->mail->Password = EMAIL_PASSWORD;
    $this->mail->setFrom(EMAIL_USER, 'SUSUMO Recover Password');
  }

  public function send($data = [])
  {
    $this->mail->Subject = $data['subject'];
    $this->mail->AltBody = $data['altbody'];
    foreach ($data['recipients']  as $recipient) {
      $this->mail->addAddress($recipient['email'], $recipient['name']);
    }
    $this->mail->msgHTML($data['msgHTML']);
    try {
      return $this->mail->send();
    } catch (\Throwable $th) {
      echo json_encode([
        'status' => 400, 
        'error' => true,
        'message' => $th->getMessage()
      ]);
      exit;
    }
  }
}

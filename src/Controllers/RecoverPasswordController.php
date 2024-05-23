<?php

namespace Devvime\Kiichi\Controllers;

use Devvime\Kiichi\Engine\ControllerService;
use Devvime\Kiichi\Models\RecoverPasswordModel;
use Devvime\Kiichi\Models\UserModel;
use Devvime\Kiichi\Controllers\EmailServiceController;

class RecoverPasswordController extends ControllerService
{

  public $mailTemplate;
  public $url;
  private static $recoverPasswordModel;

  public function __construct()
  {
    $this->url = "https://app.susumo.com.br/recover-password/";
    self::$recoverPasswordModel = new RecoverPasswordModel();
    $this->mailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/public/components/recover-password-email.html');
  }

  public function index($req, $res)
  {
    $user = UserModel::select('id', 'name', 'email')
      ->where('email', $req->body->email)->first();
    if ($user !== null) {
      $token = $this->jwtEncrypt([
        "user" => [
          "id" => $user->id,
          "email" => $user->email
        ],
        "date" => date("Y-m-d h:i:s")
      ]);
      $recover = self::$recoverPasswordModel::where('userId', $user->id)->first();
      if ($recover !== null) {
        $recover->token = $token;
        $recover->isValid = true;
        $recover->updatedAt = date("Y-m-d h:i:s");
        $recover->save();
      } else if ($recover === null) {
        $recover = self::$recoverPasswordModel;
        $recover->userId = $user->id;
        $recover->token = $token;
        $recover->isValid = true;
        $recover->save();
      }
      $this->mailTemplate = str_replace('${link}', $this->url . base64_encode($token), $this->mailTemplate);
      $mailData = [
        "subject" => "Recover Password",
        "altbody" => "Password recovery instructions.",
        "msgHTML" => $this->mailTemplate,
        "recipients" => [
          ["name" => $user->name, "email" => $user->email]
        ]
      ];
      try {
        $mail = new EmailServiceController();
        if ($mail->index($mailData)) {
          $res->json([
            "status" => 200,
            "success" => "Password recovery instructions sent to {$user->email}"
          ]);
        }
      } catch (\Exception $err) {
        $res->json([
          "status" => 400,
          "error" => $err
        ]);
      }
    } else {
      $res->json([
        "status" => 404,
        "error" => "Unregistered email."
      ]);
    }
  }

  public function store($req, $res)
  {
    $existToken = self::$recoverPasswordModel::where('userId', $req->body->token->user->id)->first();
    if ($existToken !== null && $existToken->isValid) {
      $existToken->updatedAt = date('Y-m-d h:i:s');
      $existToken->isValid = false;
      $existToken->save();
      $user = UserModel::find($req->body->token->user->id)->first();
      if (UserModel::find($req->body->token->user->id)->first() !== null) {
        if ($req->body->data->newPassword !== $req->body->data->confirmNewPassword) {
          $res->json([
            "status" => 401,
            "error" => "Passwords not Match."
          ]);
          exit;
        }
        $user = UserModel::where('id', $req->body->token->user->id)->first();
        $user->password = $this->jwtEncrypt($req->body->data->confirmNewPassword);
        $user->updatedAt = date('Y-m-d h:i:s');
        $user->save();
        $res->json([
          "status" => 200,
          "success" => "Password changed successfully!"
        ]);
      }
    } else {
      $res->json([
        "status" => 401,
        "error" => "This token is invalid!"
      ]);
      exit;
    }
  }
}

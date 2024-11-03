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
  private static $userModel;

  public function __construct()
  {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $current_url = $protocol . $_SERVER['HTTP_HOST'];
    $this->url = "{$current_url}/recover-password/";
    self::$recoverPasswordModel = new RecoverPasswordModel();
    self::$userModel = new UserModel();
    $this->mailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/views/recover-password-email.html");
  }

  public function index($req, $res)
  {
    try {
      $user = self::$userModel::select('id', 'name', 'email')->where('email', $req->body->email)->first();
      if ($user !== null) {
        $token = $this->jwtEncrypt([
          "user" => [
            "id" => $user->id,
            "email" => $user->email
          ],
          "date" => date("Y-m-d h:i:s")
        ]);
        $recover = self::$recoverPasswordModel::select('*')->where('userId', $user->id)->first();
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
        $mail = new EmailServiceController();
        if ($mail->send($mailData)) {
          $res->json([
            "status" => 200,
            "success" => true,
            "message" => "Password recovery instructions sent to {$user->email}"
          ]);
        } else {
          $res->json([
            "status" => 400,
            "error" => true,
            "message" => "Error sending email."
          ]);
        }
      } else {
        $res->json([
          "status" => 404,
          "error" => true,
          "message" => "Unregistered email."
        ]);
      }
    } catch (\Throwable $th) {
      $res->json([
        "status" => 404,
        "error" => true,
        "message" => $th
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
            "error" => true,
            "message" => "Passwords not Match."
          ]);
          exit;
        }
        $user = UserModel::where('id', $req->body->token->user->id)->first();
        $user->password = $this->jwtEncrypt($req->body->data->confirmNewPassword);
        $user->updatedAt = date('Y-m-d h:i:s');
        $user->save();
        $res->json([
          "status" => 200,
          "success" => true,
          "message" => "Password changed successfully!"
        ]);
      }
    } else {
      $res->json([
        "status" => 401,
        "error" => true,
        "message" => "This token is invalid!"
      ]);
      exit;
    }
  }
}

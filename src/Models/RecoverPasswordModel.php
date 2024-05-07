<?php

namespace Devvime\Kiichi\Models;

use Illuminate\Database\Eloquent\Model;

class RecoverPasswordModel extends Model
{
    protected $table = "recoverPasswords";
    protected $fillable = ['userId', 'token', 'isValid', 'createAt', 'updatedAt'];
    public $timestamps = false;
}
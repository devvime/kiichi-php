<?php

namespace Devvime\Kiichi\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $fillable = ["name", "email", "password"];
    public $timestamps = false;
}
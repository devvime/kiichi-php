<?php

namespace Devvime\Kiichi\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $fillable = ["name", "email", "password", 'createdAt', 'updatedAt'];
    public $timestamps = false;
}
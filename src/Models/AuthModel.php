<?php

namespace Devvime\Kiichi\Models;

use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    protected $table = "users";
    protected $fillable = [];
    public $timestamps = false;
}
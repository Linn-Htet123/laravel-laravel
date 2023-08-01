<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','email','password','verify_code','email_verified_at','user_token'
    ];
    protected $hidden = ['password','user_token','verify_code','api_token'];
    use HasFactory;
}

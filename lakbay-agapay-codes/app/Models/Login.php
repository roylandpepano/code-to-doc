<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'remember_token',
        'user_email',
        'user_password'
    ];
}

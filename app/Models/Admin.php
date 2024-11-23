<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $guard = 'admin';

    // Admin has many messages as a receiver
    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'Alamat',
        'profile_photo',
        'Role',
    ];

    protected $attributes = [
        'Role' => 'User', // Nilai default untuk Role
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rules($id = null)
    {
        return [
            'Username' => 'required|string|unique:users,Username,' . $id . ',UserID',
            'Password' => 'required|string|min:6',
            'Email' => 'required|email|unique:users,Email,' . $id . ',UserID',
            'NamaLengkap' => 'required|string',
            'Alamat' => 'required|string',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'nomor_telepon', 'birth_place', 
        'birth_date', 'address', 'religion', 'ktp', 'kk', 'photo', 
        'join_date', 'last_login'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'join_date' => 'date',
    ];


    public function riwayatpekerjaan() {
        return $this->hasMany(RiwayatPekerjaan::class);
    }
    

    public function pendidikan()
{
    return $this->hasMany(Pendidikan::class);
}

}
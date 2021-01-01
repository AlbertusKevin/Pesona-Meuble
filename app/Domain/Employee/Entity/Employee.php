<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Employee\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ! Ubah configurasi di config/auth.php, lalu ubah users menjadi nama model yang ingin digunakan
// ! import ini pada model yang ingin dijadikan sebagai pengganti tabel defaul user agar bisa menggunakan fitur auth
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//! untuk OAuth2
use Laravel\Passport\HasApiTokens;

// !ganti extends model menjadi Authenticatable
class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'employee';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'password',
        'raiseIteration',
        'role',
        'status',
        'salary'
    ];

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }
}

<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Employee\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
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

<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\CustomerManagement\Entity;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'member'
    ];

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function members()
    {
        return $this->hasOne(Member::class);
    }
}

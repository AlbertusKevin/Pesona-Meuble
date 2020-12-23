<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Finance\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'code',
        'description',
        'percentDisc',
        'responsibleEmployee',
        'statusActive',
        'from',
        'to',
        'discountFor'
    ];

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }
}

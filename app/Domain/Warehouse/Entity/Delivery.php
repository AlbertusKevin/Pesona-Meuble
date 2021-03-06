<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Warehouse\Entity;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    public $timestamps = false;
    protected $fillable = [
        'numSO',
        'shippingPoint',
        'status',
        'dateDelivery',
        'dateReceived',
        'notes'
    ];

    public function invoicesales()
    {
        return $this->hasMany(InvoiceSales::class);
    }
}

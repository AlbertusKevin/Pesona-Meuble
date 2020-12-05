<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Entity;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $table = 'sales_order_line';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'numSO',
        'modelType',
        'price',
        'discountMeuble',
        'quantity'
    ];

    public function salesorder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function meuble()
    {
        return $this->belongsTo(Meuble::class);
    }
}

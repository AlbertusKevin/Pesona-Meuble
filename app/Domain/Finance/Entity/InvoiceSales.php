<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Finance\Entity;

use Illuminate\Database\Eloquent\Model;

class InvoiceSales extends Model
{
    protected $table = 'invoice_sales';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = ['numSO', 'responsibleEmployee', 'date', 'isSent', 'isComplete'];

    public function salesorder()
    {
        return $this->hasOne(SalesOrder::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}

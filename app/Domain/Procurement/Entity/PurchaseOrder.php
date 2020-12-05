<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Entity;

use Illuminate\Database\Eloquent\Model;
// use App\Domain\Employee\Entity\Employee;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'numPO',
        'vendor',
        'responsibleEmployee',
        'transactionStatus',
        'date',
        'validTo',
        'totalItem',
        'freightIn',
        'totalPrice',
        'totalDiscount',
        'totalPayment'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function purchaseorderlines()
    {
        return $this->hasMany(PurchaseOrderLine::class);
    }

}

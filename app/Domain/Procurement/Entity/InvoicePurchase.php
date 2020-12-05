<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Procurement\Entity;

use Illuminate\Database\Eloquent\Model;

class InvoicePurchase extends Model
{
    protected $table = 'invoice_purchase';
    public $timestamps = false;
    protected $keyType = 'string';

    public function purchaseorder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}

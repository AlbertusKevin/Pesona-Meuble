<?php

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

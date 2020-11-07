<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePurchase extends Model
{
    use HasFactory;
    protected $table = 'invoice_purchase';
    public $timestamps = false;
    protected $keyType = 'string';

    public function purchaseorder() { 
        return $this->belongsTo(PurchaseOrder::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_line';
    public $timestamps = false;
    protected $keyType = 'string';

    public function purchaseorder() { 
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function meuble() { 
        return $this->belongsTo(Meuble::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'purchase_order';
    public $timestamps = false;
    protected $keyType = 'string';

    public function vendor() { 
        return $this->belongsTo(Vendor::class); 
    }

    public function purchaseorderlines() { 
        return $this->hasMany(PurchaseOrder::class);
    }

    public function employee() { 
        return $this->belongsTo(Employee::class);
    }

    public function invoicepurchases() { 
        return $this->hasMany(InvoicePurchase::class);
    }


}

<?php

namespace App\Domain\Procurement\Entity;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
{
    protected $table = 'purchase_order_line';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'numPO',
        'modelType',
        'price',
        'quantity'
    ];
    public function purchaseorder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function meuble()
    {
        return $this->hasOne(Meuble::class);
    }
}

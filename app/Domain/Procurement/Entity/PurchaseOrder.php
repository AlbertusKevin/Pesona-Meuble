<?php

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

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class);
    // }

    // public function invoicepurchases()
    // {
    //     return $this->hasMany(InvoicePurchase::class);
    // }
}

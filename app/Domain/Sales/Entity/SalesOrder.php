<?php

namespace App\Domain\Sales\Entity;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = 'sales_order';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'numSO',
        'responsibleEmployee',
        'customer',
        'date',
        'validTo',
        'transactionStatus',
        'totalItem',
        'totalMeubleDiscount',
        'totalPrice', 
        'paymentDiscount', 
        'totalDiscount', 
        'totalPayment'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salesorderlines()
    {
        return $this->hasMany(SalesOrderLine::class);
    }

    public function invoicesales()
    {
        return $this->belongsTo(InvoiceSales::class);
    }
}

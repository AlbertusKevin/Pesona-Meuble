<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSales extends Model
{
    protected $table = 'invoice_sales';
    public $timestamps = false;
    protected $keyType = 'string';

    public function salesorder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}

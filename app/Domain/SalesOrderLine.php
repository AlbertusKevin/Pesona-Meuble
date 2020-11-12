<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    protected $table = 'sales_order_line';
    public $timestamps = false;
    protected $keyType = 'string';

    public function salesorder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function meuble()
    {
        return $this->belongsTo(Meuble::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
{
    use HasFactory;
    protected $table = 'pruchase_order_line';
    public $timestamps = false;
    protected $keyType = 'string';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderLine extends Model
{
    use HasFactory;
    protected $table = 'sales_order_line';
    public $timestamps = false;
    protected $keyType = 'string';
}

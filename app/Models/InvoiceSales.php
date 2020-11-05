<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSales extends Model
{
    use HasFactory;
    protected $table = 'invoice_sales';
    public $timestamps = false;
    protected $keyType = 'string';
}

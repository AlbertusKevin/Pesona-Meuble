<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    public $timestamps = false;

    public function invoicesales()
    {
        return $this->hasMany(InvoiceSales::class);
    }
}

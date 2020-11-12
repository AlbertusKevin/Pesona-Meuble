<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    public $timestamps = false;

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    // public function purchaseorders()
    // {
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}

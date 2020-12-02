<?php

namespace App\Domain\Employee\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address', 
        'password', 
        'raiseIteration', 
        'role', 
        'status', 
        'salary'
    ];

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    // public function purchaseorders()
    // {
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}

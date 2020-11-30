<?php

namespace App\Domain\CustomerManagement\Entity;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address', 
        'memberId'
    ];

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function members()
    {
        return $this->hasOne(Member::class);
    }
}

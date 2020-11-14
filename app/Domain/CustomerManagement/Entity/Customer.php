<?php

namespace App\Domain\Vendor\Entity;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    public $timestamps = false;

    public function salesorders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function members()
    {
        return $this->hasOne(Member::class);
    }
}

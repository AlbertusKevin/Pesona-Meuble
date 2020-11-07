<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    public $timestamps = false;

    public function salesorders() { 
        return $this->hasMany(SalesOrder::Class);
    }

    public function members() { 
        return $this->hasMany(Member::Class);
    }
}

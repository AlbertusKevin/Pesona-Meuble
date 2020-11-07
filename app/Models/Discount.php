<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    public $timestamps = false;
    protected $keyType = 'string';

    public function salesorders() { 
        return $this->hasMany(SalesOrder::class);
    }
}

<?php

namespace App\Domain\Vendor\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    public $timestamps = false;
    protected $keyType = 'string';

    // public function meubles()
    // {
    //     return $this->hasMany(Meuble::class);
    // }

    // public function purchaseorders()
    // {
    //     return $this->hasMany(PurchaseOrder::class);
    // }
}

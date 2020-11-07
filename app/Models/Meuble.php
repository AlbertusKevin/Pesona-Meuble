<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meuble extends Model
{
    use HasFactory;
    protected $table = 'meuble';
    public $timestamps = false;
    protected $keyType = 'string';

    public function meublecategory() { 
        return $this->belongsTo(MeubleCategory::class); 
    }

    public function vendor() { 
        return $this->belongsTo(Vendor::class); 
    }

    public function salesorderlines() { 
        return $this->hasMany(SalesOrderLine::class);
    }

    public function purchaseorderlines() { 
        return $this->hasMany(PruchaseOrderLines::class);
    }
}

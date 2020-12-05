<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Procurement\Entity;

use Illuminate\Database\Eloquent\Model;

class Meuble extends Model
{
    protected $table = 'meuble';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        "modelType",
        "image",
        "name",
        "description",
        "price",
        "category",
        "warantyPeriodeMonth",
        "size",
        "stock",
        "vendor",
        "color"
    ];

    public function meublecategory()
    {
        return $this->belongsTo(MeubleCategory::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function salesorderlines()
    {
        return $this->hasMany(SalesOrderLine::class);
    }

    public function purchaseorderlines()
    {
        return $this->hasMany(PruchaseOrderLines::class);
    }
}

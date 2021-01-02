<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Warehouse\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeubleCategory extends Model
{
    protected $table = 'meuble_category';
    public $timestamps = false;

    public function meubles()
    {
        return $this->hasMany(Meuble::class);
    }
}

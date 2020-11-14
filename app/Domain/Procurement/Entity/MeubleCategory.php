<?php

namespace App\Domain\Procurement\Entity;

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

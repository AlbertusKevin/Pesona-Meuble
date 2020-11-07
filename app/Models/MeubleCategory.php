<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeubleCategory extends Model
{
    use HasFactory;
    protected $table = 'meuble_category';
    public $timestamps = false;

    public function meubles() { 
        return $this->hasMany(Meuble::class); 
    }
}

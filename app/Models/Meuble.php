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
}

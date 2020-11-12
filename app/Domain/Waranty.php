<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waranty extends Model
{
    use HasFactory;
    protected $table = 'warranty';
    public $timestamps = false;
    protected $keyType = 'string';
}

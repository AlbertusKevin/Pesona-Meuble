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
    protected $fillable = [
        'companyCode',
        'name',
        'email',
        'telephone',
        'address', 
    ];

}

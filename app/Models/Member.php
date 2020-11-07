<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    public $timestamps = false;

    public function customer() { 
        return $this->belongsTo(Employee::class);
    }
}

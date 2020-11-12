<?php

namespace App\Domain\CustomerManagement\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Employee::class);
    }
}

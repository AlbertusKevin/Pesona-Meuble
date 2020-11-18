<?php

namespace App\Domain\Finance\Dao;

use App\Domain\Finance\Entity\Discount;

class DiscountDB
{
    public function showAll()
    {
        return Discount::all();
    }

}

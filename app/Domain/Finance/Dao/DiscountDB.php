<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Finance\Dao;

use App\Domain\Finance\Entity\Discount;

class DiscountDB
{
    public function showAll()
    {
        return Discount::all();
    }

}

<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\Delivery;
use Carbon\Carbon;

class DeliveryDao extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    public function listOfDelivery()
    {
        return Delivery::all();
    }
}

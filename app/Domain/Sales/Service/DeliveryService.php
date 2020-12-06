<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Service;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Dao\DeliveryDao;
use Illuminate\Http\Request;

class DeliveryService extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */

    private $delivery;

    public function __construct()
    {
        $this->delivery = new DeliveryDao();
    }

    public function listOfDelivery()
    {
        $this->delivery->listOfDelivery();
    }
}

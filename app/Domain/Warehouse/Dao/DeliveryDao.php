<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, December 2020
 */

namespace App\Domain\Warehouse\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Warehouse\Entity\Delivery;
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
    public function deliveryByNum($num)
    {
        return Delivery::where('deliveryNum', $num)->first();
    }
    public function updateStatus($num)
    {
        return Delivery::where('deliveryNum', $num)->update([
            'status' => 1
        ]);
    }
    public function store($num, $request)
    {
        return Delivery::create([
            'deliveryNum' => 1,
            'numSO' => $num,
            'shippingPoint' => $request->shippingPoint,
            'status' => $request->status,
            'dateDelivery' => Carbon::parse($request->shipDate)->format('Y-m-d'),
            'dateReceived' => Carbon::parse($request->deliveredDate)->format('Y-m-d'),
            'notes' => $request->notes
        ]);
    }
}

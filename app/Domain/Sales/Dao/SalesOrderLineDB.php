<?php

/* Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Code's Author by Albertus Kevin, Chris Christian, December 2020
 */

namespace App\Domain\Sales\Dao;

use App\Http\Controllers\Controller;
use App\Domain\Sales\Entity\SalesOrderLine;

class SalesOrderLineDB extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function store_line($line)
    {
        SalesOrderLine::create([
            'numSO' => $line->numSO,
            'modelType' => $line->modelType,
            'price' => $line->price,
            'discountMeuble' => $line->discountMeuble,
            'quantity' => $line->quantity
        ]);
    }

    public function show_line($numSO)
    {
        return SalesOrderLine::where('numSO', $numSO)
            ->join('meuble', 'sales_order_line.modelType', '=', 'meuble.modelType')->get();
    }

    public function show_item($request)
    {
        return SalesOrderLine::where('numSO', $request->numSO)->where('modelType', $request->modelType)->first();
    }

    public function delete_line($request)
    {
        SalesOrderLine::where('numSO', $request['numSO'])->delete();
    }
}
